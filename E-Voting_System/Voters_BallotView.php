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
                        <img src="Organization/<?php echo $row['logo_ballot'] ?>" alt="" width="120px">
                        <h1>
                            <?php echo $row['title']; ?>
                        </h1>
                    </div>
                <?php
                }
                ?>

                <div class="back-button">
                    <a href="Voters_Ballot_Page.php"><button><i class="bx bx-arrow-back"></i> Back</button></a>
                </div>

                <div id="addvoters-popup" class="addvoters-popup">

                    <div class="addvoters-popup-forms">
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
                            <div class="container">
                                <div class="profile-section">
                                    <div class="image-container">
                                        <img id="profile-picture" src="Candidates/<?php echo $row['candidate_profile'] ?>" alt="">
                                    </div>
                                    <p style="font-size: 24px; font-weight: bold; color: #4A4A4A; margin-top:10px;"><?php echo $row['candidate_firstname']; ?> <?php echo $row['candidate_lastname']; ?></p>
                                    <p style="font-size: 20px; font-weight: lighter; color: #4A4A4A; margin-top: -6px;"><?php echo $row['descrip']; ?></p> <!-- Display position description -->
                                </div>

                                <div class="form-section">

                                    <label for="">First Name
                                        <input style="border: 1px solid #24724D; color:black;" type="text" name="cfname" class="input-field" value="<?php echo $row['candidate_firstname'] ?>" disabled>
                                    </label>
                                    <label for="">Last Name
                                        <input style="border: 1px solid #24724D; color:black;" type="text" name="clname" class="input-field" value="<?php echo $row['candidate_lastname'] ?>" disabled>
                                    </label>
                                    <label for="">Position
                                        <input style="border: 1px solid #24724D; color:black;" type="text" name="position" class="input-field" value="<?php echo $row['descrip']; ?>" disabled> <!-- Display position description -->
                                    </label>
                                    <label style="display: flex; justify-content: end;" for="">Platform
                                        <textarea class="input-field" name="cplatforms" rows="7" style="resize: vertical; color:black; border: 1px solid #24724D" disabled><?php echo $row['platform']; ?></textarea>
                                    </label>
                                </div>

                            </div>
                    </div>

                </div>


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