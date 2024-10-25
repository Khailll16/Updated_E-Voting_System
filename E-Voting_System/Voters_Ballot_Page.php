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
                    $row = mysqli_fetch_assoc($result);
                ?>
                    <h3 class="official-ballot" style="border-radius: 20px 20px 0px 0px;">OFFICIAL BALLOT</h3>
                    <div class="ballot-title">
                        <img src="Images/school-logo-1.png" alt="" width="120px">
                        <h1><?php echo $row['title']; ?></h1>
                    </div>
                <?php
                }
                ?>
                <form action="Voters_BallotPreview.php" method="post">
                    <?php
                    $sql_positions = "
                    SELECT positions.descrip AS position_name, candidates.*
                    FROM positions
                    LEFT JOIN candidates ON positions.id = CAST(candidates.position_id AS UNSIGNED)
                    ORDER BY positions.id, candidates.id";
                    $result_positions = $conn->query($sql_positions);

                    if (!$result_positions) {
                        die("Error in SQL query: " . $conn->error);
                    }

                    $current_position = '';

                    while ($row = mysqli_fetch_assoc($result_positions)) {
                        if ($current_position !== $row['position_name']) {
                            if ($current_position !== '') {
                                echo '</div>';
                            }
                            $current_position = $row['position_name'];
                            echo "<h3 style='text-transform: uppercase;'>" . htmlspecialchars($current_position) . "</h3>";
                            echo '<div class="grid-container">';
                        }
                    ?>
                        <div class="grid-item">
                            <?php if (!empty($row['candidate_firstname'])) { ?>
                                <div class="candidate">
                                    <div class="details-voter">
                                        <label>
                                            <input type="radio" name="<?php echo htmlspecialchars($current_position); ?>" value="<?php echo $row['candidate_firstname'] . ' ' . $row['candidate_lastname']; ?>">
                                            <img src="Candidates/<?php echo $row['candidate_profile']; ?>" alt="<?php echo htmlspecialchars($row['candidate_firstname']); ?>">
                                            <div class="candidate-info">
                                                <p><?php echo htmlspecialchars($row['candidate_firstname'] . ' ' . $row['candidate_lastname']); ?></p>
                                                <a class="ballot-openPopup" data-id="<?php echo $row['id']; ?>"><button type="button"><i class="bx bx-play"></i>View</button></a>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="no-candidates">
                                    <p>No candidates found for this position.</p>
                                </div>
                            <?php } ?>
                        </div>

                    <?php
                    }

                    if ($current_position !== '') {
                        echo '</div>';
                    }
                    ?>

                    <div class="form-group-button">
                        <button type="reset" class="reset_close-form-btn">
                            <svg fill="#24724D" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" style="fill: #24724D;" viewBox="0 0 512 512" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256c118.252,0,218.898-81.941,247.035-192h-67.912
                                            c-26.55,73.368-96.47,128-179.123,128c-105.869,0-192-86.131-192-192S150.131,64,256,64c63.013,0,118.685,29.652,154.629,76.106
                                            l-85.803,64.352H512V0l-86.65,64.928C374.073,24.008,317.339,0,256,0z"></path>
                                    </g>
                                </g>
                            </svg>
                            Reset
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
                            Submit
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