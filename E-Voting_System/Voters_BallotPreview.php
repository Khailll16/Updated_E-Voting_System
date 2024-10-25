<?php
session_start();
include "database_connect.php";

if (isset($_SESSION['id']) && isset($_SESSION['voters_id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Store the votes in the session
        $_SESSION['votes'] = array_map('trim', $_POST);
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
        <title>Voters Ballot Summary Page | SIKHAY</title>
        <link rel="stylesheet" href="VotersBallot_Page.css">
    </head>

    <body>
        <main>
            <div class="ballot-section" style="width: 51%;">
                <h3 class="official-ballot" style="border-radius: 20px 20px 0px 0px;">VOTE PREVIEW</h3>
                <div class="ballot-title">
                    <?php
                    $sql = "SELECT * FROM `ballot`";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    } else {
                        $row = mysqli_fetch_assoc($result);
                    ?>
                        <img src="Images/school-logo-1.png" alt="" width="120px">
                        <h1><?php echo $row['title']; ?></h1>
                    <?php
                    }
                    ?>
                </div>

                <form action="Add_Votes.php" method="post">
                    <?php
                    if (!empty($_SESSION['votes'])) {
                        foreach ($_SESSION['votes'] as $position => $candidate_name) {
                            // Convert underscores in position names to spaces for display
                            $position_display = str_replace('_', ' ', $position);

                            // Fetch candidate details based on the selected name
                            $candidate_query = "SELECT * FROM candidates WHERE CONCAT(candidate_firstname, ' ', candidate_lastname) = ?";
                            $stmt = $conn->prepare($candidate_query);
                            $stmt->bind_param("s", $candidate_name);
                            $stmt->execute();
                            $candidate_result = $stmt->get_result();

                            if ($candidate_row = $candidate_result->fetch_assoc()) {
                                $candidate_image = $candidate_row['candidate_profile'];
                                $candidate_full_name = $candidate_row['candidate_firstname'] . ' ' . $candidate_row['candidate_lastname'];
                            } else {
                                $candidate_image = "default.png"; // Fallback image if not found
                                $candidate_full_name = "Unknown Candidate";
                            }
                            $stmt->close();

                            // Display the position, candidate's name, and image in the requested layout
                            echo "<h3 style='text-transform: uppercase;'>" . htmlspecialchars($position_display) . "</h3>";
                            echo '<div class="grid-container">';
                            echo '<div class="grid-item">';
                            echo '<div class="candidate">';
                            echo '<div class="details-voter">';
                            echo '<label>';
                            echo '<input type="radio" name="' . htmlspecialchars($position_display) . '" value="' . htmlspecialchars($candidate_full_name) . '" checked>';
                            echo '<img src="Candidates/' . htmlspecialchars($candidate_image) . '" alt="' . htmlspecialchars($candidate_full_name) . '" width="80px" height="80px">';
                            echo '<div class="candidate-info">';
                            echo "<p>" . htmlspecialchars($candidate_full_name) . "</p>";
                            echo '<a class="ballot-openPopup" data-id="' . $candidate_row['id'] . '"><button type="button"><i class="bx bx-play"></i>View</button></a>';
                            echo '</div>';
                            echo '</label>';
                            echo '</div></div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "<div class='no-candidates'>";
                        echo "<p>No votes recorded. Please return to the ballot page to vote.</p>";
                        echo "</div>";
                    }
                    ?>

                    <div class="form-group-button">
                        <button type="button" onclick="window.location.href='Voters_Ballot_Page.php'" class="reset_close-form-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #24724D">
                                <path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path>
                                <path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path>
                            </svg>
                            Edit
                        </button>
                        <button type="submit" class="save-btn">
                            <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" style="fill: white;" viewBox="0 0 407.096 407.096" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M402.115,84.008L323.088,4.981C319.899,1.792,315.574,0,311.063,0H17.005C7.613,0,0,7.614,0,17.005v373.086
                                        c0,9.392,7.613,17.005,17.005,17.005h373.086c9.392,0,17.005-7.613,17.005-17.005V96.032
                                        C407.096,91.523,405.305,87.197,402.115,84.008z M300.664,163.567H67.129V38.862h233.535V163.567z"></path>
                                        <path d="M214.051,148.16h43.08c3.131,0,5.668-2.538,5.668-5.669V59.584c0-3.13-2.537-5.668-5.668-5.668h-43.08
                                        c-3.131,0-5.668,2.538-5.668,5.668v82.907C208.383,145.622,210.92,148.16,214.051,148.16z"></path>
                                    </g>
                                </g>
                            </svg>
                            Confirm
                        </button>
                    </div>

                    <div class="logo-sikhay-submit">
                        <img src="Images/sikhay-new-logo.png" alt="">
                        <p>Providing easier ways to VOTE and be HEARD.</p>
                    </div>

                    <div id="ballot-popup" class="ballot-popup" style="display: none;">
                        <div class="ballot_popup-content">
                            <?php
                            $sql = "SELECT * FROM ballot";
                            $result = $conn->query($sql);

                            if (!$result) {
                                die("Invalid query: " . $conn->error);
                            } else {
                                $row = mysqli_fetch_assoc($result);
                            ?>
                                <h3 class="official-ballot" style="border-radius: 20px 20px 0px 0px;">OFFICIAL BALLOT</h3>
                                <div class="ballot-title-popup">
                                    <img src="Images/school-logo-1.png" alt="" width="125px">
                                    <h2><?php echo $row['title']; ?></h2>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="ballot-popup-forms">
                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];

                                    // Updated query to join with positions and get description
                                    $sql = "SELECT candidates.*, positions.descrip 
                                    FROM candidates 
                                    LEFT JOIN positions ON candidates.position_id = positions.id 
                                    WHERE candidates.id = '$id'";
                                    $result = mysqli_query($conn, $sql);

                                    if (!$result) {
                                        die("Invalid query: " . $conn->error);
                                    } else {
                                        $row = mysqli_fetch_assoc($result);
                                    }
                                }
                                ?>
                                <p style="font-size: 24px; font-weight: bold; color: #4A4A4A; text-align: center; margin: 20px 20px 8px 20px;">PLATFORM</p>
                                <div class="container">
                                    <div class="profile-section">
                                        <div class="image-container">
                                            <img id="profile-picture" src="Candidates/<?php echo $row['candidate_profile'] ?>" alt="">
                                        </div>
                                        <!-- Display the firstname, lastname, and position description here in profile-section -->
                                        <p style="font-size: 24px; font-weight: bold; color: #4A4A4A; text-align: center;">
                                            <?php echo $row['candidate_firstname']; ?> <?php echo $row['candidate_lastname']; ?>
                                        </p>
                                        <p style="font-size: 20px; font-weight: lighter; color: #4A4A4A; text-align: center;">
                                            <?php echo $row['descrip']; ?>
                                        </p> <!-- Display position description -->
                                    </div>

                                    <!-- Form section: Changed to p tag for platform -->
                                    <div class="form-section">
                                        <p style="font-size: 18px; font-weight: lighter; color: #4A4A4A; text-align: justify;">
                                            <?php echo $row['platform']; ?>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </main>
    </body>
    <script src="displayPopUpForm.js"></script>

    </html>

<?php
} else {
    header("Location: Voters_Ballot_Page.php");
    exit();
}
?>