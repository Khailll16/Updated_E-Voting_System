<?php
session_start();
include "database_connect.php";

if (isset($_SESSION['id']) && isset($_SESSION['voters_id'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
        <title>Voters Ballot Page | SIKHAY</title>
        <link rel="stylesheet" href="VotersBallot_Page.css">
    </head>

    <body>
        <main>
            <div class="ballot-section">
                <?php
                $sql = "SELECT * FROM `ballot`";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Invalid query: " . $conn->error);
                } else {
                    ($row = mysqli_fetch_assoc($result))

                ?>
                    <h3 class="official-ballot" style="border-radius: 20px 20px 0px 0px;">OFFICIAL BALLOT</h3>
                    <div class="ballot-title">
                        <img src="Images/school-logo-1.png" alt="" width="120px">
                        <h1>
                            <?php echo $row['title']; ?>
                        </h1>
                    </div>
                <?php
                }
                ?>
                <form action="">
                    <?php
                    // SQL query to fetch distinct positions and their candidates using a LEFT JOIN
                    $sql_positions = "
                    SELECT positions.descrip AS position_name, candidates.*
                    FROM positions
                    LEFT JOIN candidates ON positions.id = candidates.position_id
                    ORDER BY positions.id";
                    $result_positions = $conn->query($sql_positions);

                    // Check if query succeeded
                    if (!$result_positions) {
                        die("Error fetching positions and candidates: " . $conn->error); // Debugging: check if query failed
                    }

                    // To keep track of the current position header and prevent repeating it
                    $current_position = '';

                    // Loop through each result and group candidates by position
                    while ($row = mysqli_fetch_assoc($result_positions)) {
                        // Check if the position has changed, then display a new header
                        if ($current_position !== $row['position_name']) {
                            $current_position = $row['position_name'];
                            echo "<h3>" . htmlspecialchars($current_position) . "</h3>"; // Display position as header
                        }
                    ?>
                        <div class="grid-container">
                            <?php if (!empty($row['candidate_firstname'])) { ?>
                                <!-- Display candidate details only if there is a candidate for the position -->
                                <div class="candidate">
                                    <div class="details-voter">
                                        <label>
                                            <!-- Radio button for selecting the candidate -->
                                            <input type="radio" name="<?php echo htmlspecialchars($current_position); ?>" value="<?php echo $row['candidate_firstname'] . ' ' . $row['candidate_lastname']; ?>">
                                            <!-- Display candidate image -->
                                            <img src="Candidates/<?php echo htmlspecialchars($row['candidate_profile']); ?>" alt="<?php echo htmlspecialchars($row['candidate_firstname']); ?>">
                                            <!-- Display candidate name and button -->
                                            <div class="candidate-info">
                                                <?php echo htmlspecialchars($row['candidate_firstname'] . ' ' . $row['candidate_lastname']); ?>
                                                <a href="Voters_BallotView.php?id=<?php echo $row['id']; ?>"><button type="button"><i class="bx bx-play"></i>View</button></a>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <!-- No candidates for this position -->
                                <p style="text-align: center; ">No candidates found for this position.</p>
                            <?php } ?>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="form-group-button">
                        <button type="reset" class="addCandidates_close-form-btn">
                            <svg fill="#24724D" version="1.1" xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 512 512">
                                <g>
                                    <g>
                                        <path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256c118.252,0,218.898-81.941,247.035-192h-67.912..."></path>
                                    </g>
                                </g>
                            </svg>
                            Reset
                        </button>

                        <button type="submit" class="save-btn">
                            <svg fill="#000000" version="1.1" xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 407.096 407.096">
                                <g>
                                    <g>
                                        <path d="M402.115,84.008L323.088,4.981C319.899,1.792,315.574,0,311.063,0H17.005C7.613,0,0,7.614,0,17.005v373.086..."></path>
                                    </g>
                                </g>
                            </svg>
                            Submit
                        </button>
                    </div>

                    <div class="logo-sikhay-submit">
                        <img src="Images/sikhay-new-logo.png" alt="">
                        <p>Providing easier ways to VOTE and be HEARD.</p>
                    </div>
                </form>



            </div>
        </main>
    </body>

    </html>

<?php
} else {
    header("Location: Voters_Ballot_Page.php");
    exit();
}
?>