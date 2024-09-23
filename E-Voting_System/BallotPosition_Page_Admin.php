<?php
    session_start();
    include "database_connect.php";

    if (isset($_SESSION['id']) && isset($_SESSION['admin_username'])){

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="BalloPosition_Admin.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
        <title>Admin Ballot Position Page | SIKHAY</title>
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
                            <li><a href="BallotPosition_Page_Admin.php"><i class='bx bxs-dashboard icon'></i> Home</a></li>
                            <li class="active" style="font-weight: lighter;" id="title-page"> <a href=""><i class='bx bxs-chevron-right'></i> Ballot Preview</a></li>
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
                <div class="dashboard-body">

                                        <?php
                                            $sql = "SELECT * FROM `ballot`";
                                            $result = $conn->query($sql);

                                            if(!$result){
                                                die("Invalid query: " . $conn->error);
                                                }
                                                else{
                                                ($row = mysqli_fetch_assoc($result));
                                                           
                                        ?>

                        <h2 style="font-weight: 550;" class="header" id="breadcrup-title">BALLOT POSITIONS</h2>
           
                        <div class="edit-button">
                            <button class="button-edit"><a href="Edit_BallotTitle.php?id=<?php echo $row['id']; ?>"><i class="bx bxs-edit"></i>Edit</a></button>
                        </div>

                    <div class="dashboard-content">

                        <!----DASHBOARD TITLE---->
                        <div class="ballot-section">
                            <h3 class="official-ballot">OFFICIAL BALLOT</h3>
                            <div class="ballot-title">
                                <img src="Images/school-logo-1.png" alt="" width="120px">
                                <h1><?php echo $row['title']; ?></h1>
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
                                            <button><i class="bx bx-play"></i>View</button>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="candidate">
                                <div class="details-voter">
                                    <label>
                                        <input type="radio" name="president" value="Rhea Clarisse Esteban">
                                        <img src="Images/jude-removebg-preview.png" alt="Rhea Clarisse Esteban">
                                        <div class="candidate-info">
                                            Jude Ramos
                                            <button><i class="bx bx-play"></i>View</button>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="candidate">
                                <div class="details-voter">
                                    <label>
                                        <input type="radio" name="president" value="Rhea Clarisse Esteban">
                                        <img src="Images/david-removebg-preview.png" alt="Rhea Clarisse Esteban">
                                        <div class="candidate-info">
                                                David Amos
                                            <button><i class="bx bx-play"></i>View</button>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="candidate">
                                <label>
                                    <input type="radio" name="president" value="Abstain">
                                    Abstain
                                </label>
                            </div>

                            <h3> VICE PRESIDENT</h3>
                            <div class="candidate">
                                <div class="details-voter">
                                    <label>
                                        <input type="radio" name="president" value="Rhea Clarisse Esteban">
                                        <img src="Images/rhea-removebg-preview.png" alt="Rhea Clarisse Esteban">
                                        <div class="candidate-info">
                                            Rhea Clarisse Esteban
                                            <button><i class="bx bx-play"></i>View</button>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="candidate">
                                <div class="details-voter">
                                    <label>
                                        <input type="radio" name="president" value="Rhea Clarisse Esteban">
                                        <img src="Images/jude-removebg-preview.png" alt="Rhea Clarisse Esteban">
                                        <div class="candidate-info">
                                            Jude Ramos
                                            <button><i class="bx bx-play"></i>View</button>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="candidate">
                                <div class="details-voter">
                                    <label>
                                        <input type="radio" name="president" value="Rhea Clarisse Esteban">
                                        <img src="Images/david-removebg-preview.png" alt="Rhea Clarisse Esteban">
                                        <div class="candidate-info">
                                                David Amos
                                            <button><i class="bx bx-play"></i>View</button>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="candidate">
                                <label>
                                    <input type="radio" name="president" value="Abstain">
                                    Abstain
                                </label>
                            </div>

                
                                <div class="form-group-button">
                                    <button type="button" class="addCandidates_close-form-btn"><svg fill="#24724D" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" style="fill: #24724D;" viewBox="0 0 512 512" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256c118.252,0,218.898-81.941,247.035-192h-67.912
                                                    c-26.55,73.368-96.47,128-179.123,128c-105.869,0-192-86.131-192-192S150.131,64,256,64c63.013,0,118.685,29.652,154.629,76.106
                                                    l-85.803,64.352H512V0l-86.65,64.928C374.073,24.008,317.339,0,256,0z"></path>
                                                </g>
                                            </g>
                                        </svg>Reset</button>
                                    <button type="submit" class="save-btn"><svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" style="fill: white;" viewBox="0 0 407.096 407.096" xml:space="preserve">
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
                                        Submit</button>

                                </div>

                                <div class="logo-sikhay-submit">
                                    <img src="Images/sikhay-new-logo.png" alt="" >
                                    <p>Providing easier ways to VOTE and be HEARD.</p>
                                </div>
                    

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
                <!-----SIDEBAR TOP CONTENT------>
                <div class="sidebar-content">
                    <div class="sidebar-top-content">
                        <!------SIKHAY LOGO---->
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
                    </li>
                </div>
            </div>
        </nav>


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