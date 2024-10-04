<?php
    session_start();
    include "database_connect.php";

    if (isset($_SESSION['id']) && isset($_SESSION['voters_id'])){

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

                                            if(!$result){
                                                die("Invalid query: " . $conn->error);
                                                }
                                                else{
                                                ($row = mysqli_fetch_assoc($result)) 
                                                           
                                ?>
            <h3 class="official-ballot" style="border-radius: 20px 20px 0px 0px;">OFFICIAL BALLOT</h3>
            <div class="ballot-title">
                <img src="Organization/<?php echo $row['logo_ballot'] ?>" alt="" width="120px">
                <h1>
                    <?php echo $row['title'];?>
                </h1>
            </div>
                <?php
            }
        ?>

            <div class="back-button">
                <a href="Voters_Ballot_Page.php"><button><i class="bx bx-arrow-back"></i> Back</button></a>
            </div>

            <?php
                if (isset($_GET['id'])) {
                $id = $_GET['id'];


                    $sql = "SELECT * from `candidates` where `id` = '$id'";
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
                    <p style="font-size: 24px; font-weight: bold; color: #4A4A4A; margin-top: 10px;"><?php echo $row['candidate_firstname']; ?> <?php echo $row['candidate_lastname']; ?></p>
                    <p style="font-size: 20px; font-weight: lighter; color: #4A4A4A; margin-top: -10px;"><?php echo $row['position_id'] ?></p>
                </div>

                <div class="form-section">

                    <label for="">First Name
                        <input type="text" name="admin_fname" class="input-field" value="<?php echo $row['candidate_firstname']; ?>" disabled>
                    </label>
                    <label for="">Last Name
                        <input type="text" name="admin_lname" class="input-field" value="<?php echo $row['candidate_lastname']; ?>" disabled>
                    </label>
                    <label for="">Position
                        <input type="text" name="admin_username" class="input-field" value="<?php echo $row['position_id'] ?>" disabled>
                    </label>
                    <label for="">Platform
                        <input type="text" name="admin_pass" class="input-field" value="<?php echo $row['platform'] ?>" disabled>
                    </label>

                </div>
            </div>



        </div>
    </main>
</body>

</html>

<?php
    }else{
        header("Location: Voters_Ballot_Page.php");
        exit();
    }
?>