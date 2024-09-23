<?php 

include "database_connect.php";
include "Add_SetupOrg.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="SetUpStyle_Organization.css">
    <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
    <title>Set Up Organization Page | SIKHAY</title>
</head>
    <body>
        
        <div class="image-container">

            <div class="back-button">
                <a href="Starting_Page.php"><button><i class='bx bx-arrow-back'></i> Back</button></a>
            </div>

            <div id="circle2"></div>
            <div id="circle1"></div>
            <div id="circle3"></div>


            <div class="main-container">
                <div class="image-logo">
                    <img src="Images/new-logo.png" alt="">
                    <p>To customize your experience, please edit the sections below.</p>
                </div>

                <div class="setupform">
                    <form action="SetUp_Organization.php" autocomplete="off" enctype="multipart/form-data" method="POST">
                        <label for="schoool-name">Name of organization <br>
                            <input type="text" name="nameorg" placeholder="" required>
                        </label>
                        <br>
                        <label for="schoool-name">Address <br>
                            <input type="text" name="address" placeholder="" required>
                        </label>
                        <label for="schoool-name">Number <br>
                            <input type="text" name="phonenumber" placeholder="" required>
                        </label>
                        <label for="schoool-logo">Upload a logo file <br>
                            <span class="seondsentence">Select an image to feature as your logo.</span> <br>
                            <input class="school-logo" type="file" name="logo" required> <br>
                            <span class="seondsentence">Accepted file format: JPG, PNG & SVG. Recommended dimension: 300 x 300 pixels</span>
                        </label>

                        <div class="button-option">
                            <button name="submitbtn" type="submit">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="AnimationStartingPage.js"></script>
</html>
