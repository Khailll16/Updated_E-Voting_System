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
        <title>Voters Ballot Summary Page | SIKHAY</title>
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
                <h3 class="official-ballot" style="border-radius: 20px 20px 0px 0px;">VOTE SUMMARY</h3>
                <div class="ballot-title">
                    <img src="Images/school-logo-1.png" alt="" width="120px">
                    <h1><?php echo $row['title'];?></h1>
                </div>
                        <?php
                    }
                ?>
                <h3>PRESIDENT</h3>
                <div class="candidate">
                    <div class="details-voter">
                        <label>
                            <input type="radio" name="president" value="Rhea Clarisse Esteban">
                            <img src="Images/rhea-removebg-preview.png" alt="Rhea Clarisse Esteban">
                            <div class="candidate-info">
                                Rhea Clarisse Esteban
                                <a href=""><button><i class="bx bx-play"></i>View</button></a>
                            </div>
                        </label>
                    </div>
                </div>
             

                <h3> VICE PRESIDENT</h3>
                <div class="candidate">
                    <div class="details-voter">
                        <label>
                            <input type="radio" name="president" value="Rhea Clarisse Esteban">
                            <img src="Images/jude-removebg-preview.png" alt="Rhea Clarisse Esteban">
                            <div class="candidate-info">
                                Jude Ramos
                                <a href=""><button><i class="bx bx-play"></i>View</button></a>
                            </div>
                        </label>
                    </div>
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