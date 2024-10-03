<?php
    session_start();

    if (isset($_SESSION['id']) && isset($_SESSION['admin_username'])){

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="DashboardStyle_Page.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">  
        <title>Admin Dashboard Page | SIKHAY</title>

    </head>
    <body>
    <div class="main-container">    

            <!-----RIGHT SIDE CONTENT------>
            <div class="right-side">

                <div class="right-side-content">

                <!-----PROFILE ADMIN------>
                    <div class="top_content">

                        <div class="breadcrumb-content">
                            <ol class="breadcrumb">
                                <li><a href="Dashboard_Page.php"><i class='bx bxs-dashboard icon'></i> Home</a></li>
                                <li class="active" style="font-weight: lighter;" id="title-page"> <a href=""><i class='bx bxs-chevron-right'></i> Dashboard </a></li>
                              </ol>
                        </div>


                        <nav class="nav-burger">
                            <i class='bx bx-menu icon' onclick="toggleMenu()"></i>
                            <div class="menu-content">
                                <h2><i class='bx bxs-cog icon'></i> SETTINGS </h2>
                                <a href="View_UserProfile.php"><i class='bx bxs-user-detail icon' ></i> User Profile</a>
                                <a href="View_WebSetup.php"><i class='bx bx-window icon'></i> Web Setup</a>
                                <a style="border-radius: 0px 0px 15px 15px;" href="LogoutPage_Admin.php"><i class='bx bx-log-out icon'></i>Sign out</a>
                            </div>
                        </nav>
                        

                    </div>

                    <!----DASHBOARD---->
                        <div  class="dashboard-body">

                            <div class="dashboard-content">

                                <div class="notification" id="notification">
                                        <?php 
                                            if (isset($_GET['insert_msg'])) {
                                                echo "<div class='welcome-message'>";
                                                echo "<i style ='font-size:50px'class='bx bxs-check-circle'></i>";
                                                echo "<h2>Welcome back, " . $_SESSION['firstname'] . "!</h2>";  
                                                echo "<p>You have successfully logged in</p>";
                                                echo "</div>";
                                            }
                                            
                                        ?>
                                </div>

                                <!----DASHBOARD TITLE---->
                                <h2 style="font-weight: 550;" class="header" id="breadcrup-title">DASHBOARD</h2>
                                
                                <!----BUTTON MENU---->
                                <div class="button-container">

                                    <button class="btn">  
                                        <i class='bx bx-objects-horizontal-right icon'></i>   
                                    <div class="inner"> 
                                        <?php
                                            include "database_connect.php";
                                            $sql = "SELECT * FROM positions";
                                            $query = $conn->query($sql);
    
                                            echo "<h3 id=number-positions>".$query->num_rows."</h3>";   
                                        ?>        
                                        <p>No. Positions</p>    
                                    </div>    
                                    <a href="Position_Page_Admin.php" class="small-box-footer">More info <i class='bx bxs-right-arrow-circle'></i></a>    
                                    </button>


                                    <button class="btn">   
                                        <i class='bx bxs-user-account icon'> </i>             
                                    <div class="inner">     
                                         <?php
                                            include "database_connect.php";

                                            $sql = "SELECT * FROM candidates";
                                            $query = $conn->query($sql);
    
                                            echo "<h3 id=number-candidates>".$query->num_rows."</h3>";   
                                        ?>          
                                        <p>No. Candidates</p>   
                                    </div>    
                                    <a href="Candidates_Page_Admin.php" class="small-box-footer">More info <i class='bx bxs-right-arrow-circle'></i></a>    
                                    </button>


                                    <button class="btn">   
                                        <i class='bx bx-objects-horizontal-right icon'></i>   
                                    <div class="inner">     
                                        <?php
                                            include "database_connect.php";

                                            $sql = "SELECT * FROM sections";
                                            $query = $conn->query($sql);
    
                                            echo "<h3 id=number-sections>".$query->num_rows."</h3>";   
                                        ?>            
                                        <p>No. Sections</p>     
                                    </div>    
                                    <a href="Section_Page_Admin.php" class="small-box-footer">More info <i class='bx bxs-right-arrow-circle'></i></a>    
                                    </button>


                                    <button class="btn">   
                                        <i class='bx bx-group icon' ></i>                     
                                    <div class="inner">     
                                        <?php
                                            include "database_connect.php";

                                            $sql = "SELECT * FROM voters";
                                            $query = $conn->query($sql);
    
                                            echo "<h3 id=number-voters>".$query->num_rows."</h3>";   
                                        ?>               
                                        <p>Total Voters</p>     
                                    </div>    
                                    <a href="Voters_Page_Admin.php" class="small-box-footer">More info <i class='bx bxs-right-arrow-circle'></i></a>    
                                    </button>


                                    <button class="btn">   
                                        <i class='bx bx-box icon'></i>                        
                                    <div class="inner">    
                                        <?php
                                            include "database_connect.php";

                                            $sql = "SELECT * FROM votes";
                                            $query = $conn->query($sql);
    
                                            echo "<h3 id=total-voters-voted>".$query->num_rows."</h3>";   
                                        ?>         
                                        <p>Voters Voted</p>     
                                    </div>    
                                    <a href="Votes_Page_Admin.php" class="small-box-footer">More info <i class='bx bxs-right-arrow-circle'></i></a>    
                                    </button>


                                </div>


                                <!----VOTES PARTICIPATION---->
                                <div class="votes-participation">
                                    <h2 style="font-weight: 550;" class="header">VOTES PARTICIPATION</h2>
                                </div>
                                <!----VOTES BOX RESULT---->
                                <div class="votes-container">
                                    
                                </div>
                            </div>
                        </div>
                        
                </div>
                <!-----SIDE BAR------>
                <nav class="sidebar">

                    <!-----MENU BAR------>
                    <div class="menu-bar">

                            <?php
                                $sql = "SELECT * FROM `setup`";
                                $result = $conn->query($sql);

                                    if(!$result){
                                        die("Invalid query: " . $conn->error);
                                    }else{
                                            ($row = mysqli_fetch_assoc($result));
                                        }                
                            ?>

                        <!-----SIDEBAR TOP CONTENT-->
                        <div class="sidebar-content">
                            <div class="sidebar-top-content">

                                <!------SIKHAY LOGO-->
                                <div class="sikhay-logo">
                                    <img src="Organization/<?php echo $row ['logo']?>" alt="" width="78px">
                                    <div class="school-name">
                                        <p style="color: #4A4A4A; font-size: 16px;"><?php echo$row['organization_name'];?></p>
                                        <p style="font-weight: lighter; font-size: 13px; color: #9F9898;">Organization</p>
                                    </div>
                                </div>

                                  <!-----PROFILE ADMIN------>
                                <header class="sidebar-profile">
                                    <div class="image-text">
                                    <?php
                                    $sql = "SELECT * FROM `admin`";
                                        $result = $conn->query($sql);

                                            if(!$result){
                                                die("Invalid query: " . $conn->error);
                                                }
                                                else{
                                                ($row = mysqli_fetch_assoc($result)) 
                                                           
                                ?>
                                        <span class="image">
                                            <img id="picture-admin" src="Images/<?php echo $row ['admin_profile']?>" alt="">
                                        </span>
                                        <div class="text header-text">
                                            <p id="name-admin"><?php echo $row['firstname'];?> <?php echo $row['lastname']; ?></p>
                                            <span class="name">Online</span>
                                        </div>
                                            <?php
                                        }
                                    ?>
                                    </div>
                                </header>

                            </div>
                        </div>

                          <!-----MENU------>
                        <div class="menu">

                              <!-----MENU LINKS------>
                            <ul class="menu-links"> 

                                  <!-----DASHBOARD------>
                                <li class="nav-link">
                                    <a href="Dashboard_Page.php">
                                        <i class='bx bxs-dashboard icon'></i>
                                        <span class="text nav-text">DashBoard</span>
                                    </a>                            
                                </li>

                                  <!-----VOTES------>
                                <li class="nav-link">
                                    <a href="Votes_Page_Admin.php">
                                        <i class='bx bxs-box icon'></i>
                                        <span class="text nav-text">Votes</span>
                                    </a>                            
                                </li>

                                    <!-----Sections------>
                                <li class="nav-link">
                                    <a href="Section_Page_Admin.php">
                                        <i class='bx bxs-objects-horizontal-left icon'></i>
                                        <span class="text nav-text">Sections</span>
                                    </a>                            
                                </li>

                                  <!-----VOTERS------>
                                <li class="nav-link">
                                    <a href="Voters_Page_Admin.php">
                                        <i class='bx bxs-group icon'></i>
                                        <span class="text nav-text">Voters</span>
                                    </a>                            
                                </li>

                                  <!-----POSITIONS------>
                                <li class="nav-link">
                                    <a href="Position_Page_Admin.php">
                                        <i class='bx bxs-objects-horizontal-left icon'></i>
                                        <span class="text nav-text">Positions</span>
                                    </a>                            
                                </li>

                                  <!-----CANDIDATES------>
                                <li class="nav-link">
                                    <a href="Candidates_Page_Admin.php">
                                        <i class='bx bxs-user-account icon'></i>
                                        <span class="text nav-text">Candidates</span>
                                    </a>                            
                                </li>

                                  <!-----BALLOT POSITIONS------>
                                <li class="nav-link">
                                    <a href="BallotPosition_Page_Admin.php">
                                        <i class='bx bxs-detail icon'></i>
                                        <span class="text nav-text">Ballot Position</span>
                                    </a>                            
                                </li>
                            </ul>
                        </div>


                          <!-----BUTTON CONTENT------>
                        <div class="bottom-content">

                              <!-----LOG OUT------>
                            <li class="">
                                                     
                            </li>
      
                        </div>


                    </div>


                </nav>


            </div>
        </div>
        <script src="Election_Title.js"></script>
        <script src="hamburger-navbar.js"></script>
        <script src="displayPopUpMessage.js"></script>
    </body>
</html>

<?php
    }else{
        header("Location: Dashboard_Page.php");
        exit();
    }
?>