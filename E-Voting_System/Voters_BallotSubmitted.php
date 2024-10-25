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
        <div class="ballot-section" style="width: 51%;">
            <?php
                $sql = "SELECT * FROM `ballot`";
                $result = $conn->query($sql);

                if(!$result){
                die("Invalid query: " . $conn->error);
                }
                else{
                ($row = mysqli_fetch_assoc($result)) 
                                                           
            ?>
            <h3 class="official-ballot" style="border-radius: 20px 20px 0px 0px;">VOTE SUBMITTED</h3>
            <div class="ballot-title">
                <img src="Images/school-logo-1.png" alt="" width="120px">
                <h1>
                    <?php echo $row['title'];?>
                </h1>
            </div>
            <?php
                    }
                ?>

                <div class="main-container">
                    <p>Thank you for taking the time to vote. Your voice has been heard and your vote received!</p>
                </div>
                <div class="summary-button">
                    <a href="Voters_BallotPreview.php"><button>View Summary</button></a>
                </div>    
                <div class="logo-sikhay-submit">
                    <img src="Images/sikhay-new-logo.png" alt="">
                    <p>Providing easier ways to VOTE and be HEARD.</p>
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