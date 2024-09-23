<?php 

include "database_connect.php";

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="LoginStyle_Admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
    <title>Voters Login Page | SIKHAY</title>
</head>
<body>
    <!-----Background----->

    <div class="image-container">

        <div id="circle2"></div>
        <div id="circle1"></div>
        <div id="circle3"></div>

        <div class="box">
            
            <div class="logo">
                    <?php
                        $sql = "SELECT * FROM `setup`";
                        $result = $conn->query($sql);

                            if(!$result){
                                die("Invalid query: " . $conn->error);
                            }else{
                                    ($row = mysqli_fetch_assoc($result));
                                }                
                    ?>
                <img src="Organization/<?php echo $row ['logo']?>" alt="" width="165px">
            </div>
            
            <div class="Login-box">
                <div class="login-content">
                    <form action="Login_Voters_connect.php" class="form-login-admin" method="post">
                        <!------header----->
                        <div class="heading-content">
                            <p style="color: #24724D; font-size: 29px; font-weight:600; margin-top: -1px;">Login to your Account</p>
                            <p style="color: #24724D; margin-top: -30px; margin-bottom: 23px;" class="text-login">Enter your valid credential for logging in</p>   
                        </div>

                        <!------Id and password--->
                        <div class="input-container">
                            <i class='bx bx-user'></i>
                            <input class="input-field" type="text" placeholder="Voters ID" name="voter_id">
                        </div>
                        <div class="input-container">
                            <i class='bx bx-lock-alt'></i>
                            <input class="input-field" type="password" placeholder="Password" name="voter_psw">
                        </div>
                        
                        <!-----Check box-----> 
                        <div class="checkbox">
                            <input type="checkbox" id="myCheckbox" name="myCheckbox">
                            <label for="myCheckbox">Remember me</label> <br>  
                        </div>

                        <?php if(isset($_GET['error'])) { ?>
                            <p class="error"><?php echo $_GET['error']; ?></p>    
                        <?php } ?>
                    
                        <!---Sumbit------>
                        <div class="submit">
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
    <script src="AnimationStartingPage.js"></script>
    <script src="LoginPageAnimation.js"></script>
</html>
