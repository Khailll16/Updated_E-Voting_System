<?php
    session_start();
    include "database_connect.php";

    if (isset($_SESSION['id']) && isset($_SESSION['admin_username'])){

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="VotesStyle_Page.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
        <title>Admin Votes Page | SIKHAY</title>

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
                                    <li><a href="Votes_Page_Admin.php"><i class='bx bxs-dashboard icon'></i> Home</a></li>
                                    <li class="active" style="font-weight: lighter;" id="title-page"> <a href=""><i class='bx bxs-chevron-right'></i> Votes </a></li>
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

                            <!----DASHBOARD TITLE---->
                            <div class="second-content">

                                <div class="Voters-list-title">
                                    <h2 style="font-weight: 550;" class="header" id="breadcrup-title">VOTES LIST</h2>
                                </div>

                                <div class="add-button">
                                    <button id = "resetposition_openPopup" class="button-add"><i class='bx bx-reset'></i>Reset</button>
                                </div>

                            </div>
                            
                            <div class="voters-list-container">
                                <div class="voters-list-content">
                                    <table class="voters-table">
                                        

                                        <!--------ENTRIES SEARCH BAR CONTAINER-------->
                                        <div class="entries-search-bar-container">
                                            <div class="selector-entries">
                                                <label>Show</label>
                                                <select name="specialization" leng="">
                                                    <option>10</option>
                                                    <option>25</option>
                                                    <option>50</option>
                                                    <option>100</option>
                                                </select> 
                                                <label>Entries</label>
                                            </div>
                                        
                                            <div class="grade-section">
                                                <div class="grade-selection">
                                                    <select name="" id="">
                                                        <option>Position</option>
                                                        <?php
                                                            $sql = "SELECT * FROM positions";
                                                            $result = $conn->query($sql);

                                                                if(!$result){
                                                                    die("Invalid query: " . $conn->error);
                                                                }
                                                                else{

                                                                    while($row = mysqli_fetch_assoc($result)) {
                                                                        
                                                                        echo "<option value='".$row['descrip']."'>".$row['descrip']."</option>";
                                                                        
                                                                    }

                                                                }
                                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <!-- Moved search-bar to the end -->
                                            <div class="search-bar">
                                                <div class="search-container">
                                                    <i class="bx bx-search icon"></i>
                                                    <input type="text" class="search-input" placeholder="Search...">
                                                </div>
                                            </div>
                                        </div>

                                    


                                        <div class="table-container">
                                            <table class="voters-list">
                                                    <tr>
                                                        <th style="border-radius: 23px 0px 0px 0px;">Positions</th>
                                                        <th>Candidates</th>
                                                        <th style="border-radius: 0px 23px 0px 0px;">Voters</th>
                                                    </tr>
                                                    <?php
                                                        $sql = "SELECT * FROM votes";
                                                        $result = $conn->query($sql);

                                                        if(!$result){
                                                            die("Invalid query: " . $conn->error);
                                                        }else{
                                                        while($row = mysqli_fetch_assoc($result)) {
                                                    ?>

                                                    <tr>
                                                        <td><?php echo $row['position_id'];?></td>
                                                        <td><?php echo $row['candidate_id'];?></td>
                                                        <td><?php echo $row['voters_id'];?></td>
                                                    </tr>

                                                        <?php
                                                            }
                                                        }
                                                    ?>

                                                    <tr>
                                                        <td colspan="3" style=" padding: 17px; background-color: #24724D;"></td>
                                                    </tr>
                                            </table>
                                        </div>  
                                    </table>
                                </div>
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
                                    <img src="Organization/<?php echo $row ['logo']?>" alt="" width="55px">
                                    <div class="school-name">
                                        <p style="color: #4A4A4A; font-size: 14px;"><?php echo$row['organization_name'];?></p>
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
                
      
                        </div>


                    </div>


                </nav>

                <div id="resetposition_popup" class="resetposition_popup" style="display: none;">
                    <div class="resetposition_popup-content">
                        <span class="resetposition_close">×</span>
                        <div class="resetposition_popup-top">
                            <h2>RESET VOTES</h2>
                        </div>
            
                        <div class="resetposition_popup-forms">
                            <form action="save.php" method="POST">
                                <div class="warning-description">
                                    <i style="font-size: 90px; color: red;" class='bx bx-alarm-exclamation'></i>
                                    <h2>Are you sure?</h2>
                                    <p>Once you reset. you will not be able to recover</p>
                                </div>
                                <div class="form-group-button">
                                    <button type="button" class="resetposition_close-form-btn"><svg width="15px" height="15px" fill="#24724D" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z" fill="#24724D"></path>
                                        </svg>
                                        Close</button>
                                    <button type="submit" class="save-btn"> <svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" style="fill: white;" viewBox="0 0 512 512" xml:space="preserve">
                                        <g>
                                          <g>
                                            <path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256c118.252,0,218.898-81.941,247.035-192h-67.912
                                              c-26.55,73.368-96.47,128-179.123,128c-105.869,0-192-86.131-192-192S150.131,64,256,64c63.013,0,118.685,29.652,154.629,76.106
                                              l-85.803,64.352H512V0l-86.65,64.928C374.073,24.008,317.339,0,256,0z"></path>
                                          </g>
                                        </g>
                                      </svg>
                                        Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>

      <script src="Election_Title.js"></script>    
      <script src="hamburger-navbar.js"></script>
    </body>
</html>

<?php
    }else{
        header("Location: Dashboard_Page.php");
        exit();
    }
?>