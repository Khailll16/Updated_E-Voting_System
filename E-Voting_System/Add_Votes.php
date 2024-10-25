<?php
session_start();
include "database_connect.php";

// Ensure the voter is logged in and votes are available
if (isset($_SESSION['id']) && isset($_SESSION['voters_id']) && !empty($_SESSION['votes'])) {
    $voter_id = $_SESSION['voters_id'];
    $votes = $_SESSION['votes']; // Retrieve the votes from session data

    // Debugging line to check session votes data
    echo '<pre>'; print_r($_SESSION['votes']); echo '</pre>';
    // Loop through each vote (position => candidate) and insert into the database
    foreach ($votes as $position => $candidate_name) {

        // Fetch candidate and position IDs based on the candidate name and position name
        $candidate_query = "SELECT candidates.id AS candidate_id, positions.id AS position_id
                            FROM candidates
                            INNER JOIN positions ON candidates.position_id = positions.id
                            WHERE CONCAT(candidates.candidate_firstname, ' ', candidates.candidate_lastname) = ?
                            AND positions.descrip = ?";
        
        $stmt = $conn->prepare($candidate_query);
        $stmt->bind_param("ss", $candidate_name, $position);
        $stmt->execute();
        $candidate_result = $stmt->get_result();

        if ($candidate_row = $candidate_result->fetch_assoc()) {
            $candidate_id = $candidate_row['candidate_id'];
            $position_id = $candidate_row['position_id'];

            // Check retrieved IDs before inserting
            echo "Inserting vote: Voter ID = $voter_id, Candidate ID = $candidate_id, Position ID = $position_id<br>";

            // Insert the vote into the `votes` table
            $insert_vote_query = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_vote_query);
            $insert_stmt->bind_param("iii", $voter_id, $candidate_id, $position_id);
            $insert_stmt->execute();
            $insert_stmt->close();
        } else {
            // Log or display an error if the candidate or position is not found
            echo "Error: Candidate '$candidate_name' or Position '$position' not found.<br>";
        }
        $stmt->close();
    }

    // Clear the session votes after saving to prevent resubmission
    unset($_SESSION['votes']);
    
    // Redirect to Voters_BallotSubmitted.php after successful submission
    header("Location: Voters_BallotSubmitted.php?ThankyouforVoting" . urlencode($row['voters_firstname']) . "" . urlencode($row['voters_lastname']) . "ID:" . urlencode($row['id']));
    exit();
} else {
    // If not logged in or no votes found, redirect back
    header("Location: Voters_Ballot_Page.php");
    exit();
}
?>
