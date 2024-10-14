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
                <form action="">

                    <?php
                    // SQL query to fetch positions and their corresponding candidates
                    $sql_positions = "
                    SELECT positions.descrip AS position_name, candidates.*
                    FROM positions
                    LEFT JOIN candidates ON positions.id = CAST(candidates.position_id AS UNSIGNED)
                    ORDER BY positions.id, candidates.id";

                    // Execute the query and check for errors
                    $result_positions = $conn->query($sql_positions);
                    if (!$result_positions) {
                        die("Error in SQL query: " . $conn->error);
                    }

                    // Check if any candidates are returned
                    if (mysqli_num_rows($result_positions) === 0) {
                        echo "No positions or candidates found.";
                    }

                    // Track the current position header to prevent repeating it
                    $current_position = '';

                    // Loop through each result and group candidates by position
                    while ($row = mysqli_fetch_assoc($result_positions)) {
                        // Check if the position has changed, then display a new header and reset the grid container
                        if ($current_position !== $row['position_name']) {
                            // Close the previous grid container if any
                            if ($current_position !== '') {
                                echo '</div>'; // Close previous grid-container
                            }

                            // Update the current position and display the header
                            $current_position = $row['position_name'];
                            echo "<h3>" . htmlspecialchars($current_position) . "</h3>";

                            // Start a new grid container for the candidates under this position
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
                                                <a href="Voters_BallotView.php?id=<?php echo $row['id']; ?>"><button type="button"><i class="bx bx-play"></i>View</button></a>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="grid-item no-candidates">
                                    <p>No candidates found for this position.</p>
                                </div>
                            <?php } ?>
                        </div>

                    <?php
                    }

                    // Close the last grid container
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
