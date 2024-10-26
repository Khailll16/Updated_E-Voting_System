<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['admin_username'])) {

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
                                <a href="View_UserProfile.php"><i class='bx bxs-user-detail icon'></i> User Profile</a>
                                <a href="View_WebSetup.php"><i class='bx bx-window icon'></i> Web Setup</a>
                                <a style="border-radius: 0px 0px 15px 15px;" id="logout_openPopup"><i class='bx bx-log-out icon'></i>Sign out</a>
                            </div>
                        </nav>


                    </div>

                    <!----DASHBOARD---->
                    <div class="dashboard-body">

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
                            <div class="Voters-list-title">
                                <h2 style="font-weight: 550;" class="header" id="breadcrup-title">DASHBOARD</h2>
                            </div>
                            <div class="voters-list-content">
                                <!----BUTTON MENU---->
                                <div class="button-container">

                                    <button class="btn">
                                        <i class='bx bxs-objects-horizontal-right icon'></i>
                                        <div class="inner">
                                            <?php
                                            include "database_connect.php";
                                            $sql = "SELECT * FROM positions";
                                            $query = $conn->query($sql);

                                            echo "<h3 id=number-positions>" . $query->num_rows . "</h3>";
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

                                            echo "<h3 id=number-candidates>" . $query->num_rows . "</h3>";
                                            ?>
                                            <p>No. Candidates</p>
                                        </div>
                                        <a href="Candidates_Page_Admin.php" class="small-box-footer">More info <i class='bx bxs-right-arrow-circle'></i></a>
                                    </button>


                                    <button class="btn">
                                        <i class='bx bxs-objects-horizontal-right icon'></i>
                                        <div class="inner">
                                            <?php
                                            include "database_connect.php";

                                            $sql = "SELECT * FROM sections";
                                            $query = $conn->query($sql);

                                            echo "<h3 id=number-sections>" . $query->num_rows . "</h3>";
                                            ?>
                                            <p>No. Sections</p>
                                        </div>
                                        <a href="Section_Page_Admin.php" class="small-box-footer">More info <i class='bx bxs-right-arrow-circle'></i></a>
                                    </button>


                                    <button class="btn">
                                        <i class='bx bxs-group icon'></i>
                                        <div class="inner">
                                            <?php
                                            include "database_connect.php";

                                            $sql = "SELECT * FROM voters";
                                            $query = $conn->query($sql);

                                            echo "<h3 id=number-voters>" . $query->num_rows . "</h3>";
                                            ?>
                                            <p>Total Voters</p>
                                        </div>
                                        <a href="Voters_Page_Admin.php" class="small-box-footer">More info <i class='bx bxs-right-arrow-circle'></i></a>
                                    </button>


                                    <button class="btn">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M2 5c0-.943 0-1.414.293-1.707S3.057 3 4 3h16c.943 0 1.414 0 1.707.293S22 4.057 22 5s0 1.414-.293 1.707S20.943 7 20 7H4c-.943 0-1.414 0-1.707-.293S2 5.943 2 5" />
                                            <path fill="currentColor" fill-rule="evenodd" d="m20.069 8.5l.431-.002V13c0 3.771 0 5.657-1.172 6.828S16.271 21 12.5 21h-1c-3.771 0-5.657 0-6.828-1.172S3.5 16.771 3.5 13V8.498l.431.002zM9 12c0-.466 0-.699.076-.883a1 1 0 0 1 .541-.541c.184-.076.417-.076.883-.076h3c.466 0 .699 0 .883.076a1 1 0 0 1 .54.541c.077.184.077.417.077.883s0 .699-.076.883a1 1 0 0 1-.541.54c-.184.077-.417.077-.883.077h-3c-.466 0-.699 0-.883-.076a1 1 0 0 1-.54-.541C9 12.699 9 12.466 9 12" clip-rule="evenodd" />
                                        </svg>
                                        <div class="inner">
                                            <?php
                                            include "database_connect.php";

                                            $sql = "SELECT * FROM votes";
                                            $query = $conn->query($sql);

                                            echo "<h3 id=total-voters-voted>" . $query->num_rows . "</h3>";
                                            ?>
                                            <p>Voters Voted</p>
                                        </div>
                                        <a href="Votes_Page_Admin.php" class="small-box-footer">More info <i class='bx bxs-right-arrow-circle'></i></a>
                                    </button>


                                </div>


                                <!-- VOTES AND GRADE LEVEL PARTICIPATION -->
                                <div class="third-container">
                                    <div class="votes-container">
                                        <h2 class="header">VOTES PARTICIPATION</h2>
                                    </div>
                                    <div class="grade-level-content">
                                        <div class="grade-level-container">
                                            <h2>GRADE LEVEL</h2>
                                            <span style=" color: #4A4A4A; font-size:15px">Total number of grade level 6</span>
                                            <div class="icon-grade-level">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="100px" viewBox="0 0 512 512">
                                                    <defs>
                                                        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                                                            <stop offset="0%" style="stop-color:#0FA25C; stop-opacity:1" />
                                                            <stop offset="93%" style="stop-color:#E5CF00; stop-opacity:1" />
                                                            <stop offset="100%" style="stop-color:#E5CF00; stop-opacity:1" />
                                                        </linearGradient>
                                                    </defs>
                                                    <path fill="url(#grad1)" d="M512 124.7L256 18L0 124.7l256 106.7zM256 274l-144.9-67.6L0 252.7l256 106.7l256-106.7l-111.1-46.3zm0 128l-139.6-69.8L0 380.7l256 106.7l256-106.7l-116.4-48.5z" />
                                                </svg>
                                            </div>
                                            <div class="view-button">
                                                <button><a href=""><i class='bx bx-play'></i> View </a></button>
                                            </div>
                                        </div>
                                        <div class="date-time">
                                            <h2>DATE AND TIME</h2>
                                            <div class="clock-icon">
                                                <span class="clock-number" style="top: 5%; left: 50%; transform: translate(-50%, -50%);">12</span>
                                                <span class="clock-number" style="top: 20%; left: 85%; transform: translate(-50%, -50%);">1</span>
                                                <span class="clock-number" style="top: 50%; left: 95%; transform: translate(-50%, -50%);">3</span>
                                                <span class="clock-number" style="top: 80%; left: 85%; transform: translate(-50%, -50%);">5</span>
                                                <span class="clock-number" style="top: 95%; left: 50%; transform: translate(-50%, -50%);">6</span>
                                                <span class="clock-number" style="top: 80%; left: 15%; transform: translate(-50%, -50%);">7</span>
                                                <span class="clock-number" style="top: 50%; left: 5%; transform: translate(-50%, -50%);">9</span>
                                                <span class="clock-number" style="top: 20%; left: 15%; transform: translate(-50%, -50%);">11</span>
                                                <span class="clock-number" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">12</span>
                                                <div class="hour-hand"></div>
                                                <div class="minute-hand"></div>
                                                <div class="second-hand"></div>
                                            </div>
                                            <p id="timeDisplay"></p> <!-- Display only the date here -->
                                            <input type="datetime-local" id="timePicker" disabled /> <!-- Disabled input to show date and time -->
                                        </div>

                                    </div>



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

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    } else {
                        ($row = mysqli_fetch_assoc($result));
                    }
                    ?>

                    <!-----SIDEBAR TOP CONTENT-->
                    <div class="sidebar-content">
                        <div class="sidebar-top-content">

                            <!------SIKHAY LOGO-->
                            <div class="sikhay-logo">
                                <img src="Organization/<?php echo $row['logo'] ?>" alt="" width="78px">
                                <div class="school-name">
                                    <p style="color: #4A4A4A; font-size: 16px;"><?php echo $row['organization_name']; ?></p>
                                    <p style="font-weight: lighter; font-size: 13px; color: #9F9898;">Organization</p>
                                </div>
                                <hr style="margin-top: 10px;">
                            </div>


                            <!-----PROFILE ADMIN------>
                            <header class="sidebar-profile">
                                <div class="image-text">
                                    <?php
                                    $sql = "SELECT * FROM `admin`";
                                    $result = $conn->query($sql);

                                    if (!$result) {
                                        die("Invalid query: " . $conn->error);
                                    } else {
                                        ($row = mysqli_fetch_assoc($result))

                                    ?>
                                        <span class="image">
                                            <img id="picture-admin" src="Images/<?php echo $row['admin_profile'] ?>" alt="">
                                        </span>
                                        <div class="text header-text">
                                            <p id="name-admin"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></p>
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

                            <!-----Grade level------>
                            <li class="nav-link">
                                <a href="">
                                    <i class='bx bx-bar-chart icon'></i>
                                    <span class="text nav-text">Grade Level</span>
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

            <!--LOGOUT FORM---->

            <div id="logout_popup" class="logout_popup" style="display: none;">
                <div class="logout_popup-content">

                    <div class="logout_popup-top">
                        <h2>SIGN OUT</h2>
                    </div>

                    <div class="logout_popup-forms">
                        <form action="LogoutPage_Admin.php" method="POST">
                            <div class="warning-logout-description">
                                <p>Are you sure you want to sign out?</p>
                            </div>
                            <div class="form-group-button">
                                <button type="button" class="logout_close-form-btn"><svg width="15px" height="15px" fill="#24724D" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z" fill="#24724D"></path>
                                    </svg>
                                    Close</button>
                                <button type="submit" class="save-btn">
                                    <svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" style="fill: white;" viewBox="0 0 512 512" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M504.5,75.5c-9.6-9.6-25.2-9.6-34.9,0L192.4,352.7L42.3,202.7c-9.6-9.6-25.2-9.6-34.9,0c-9.6,9.6-9.6,25.2,0,34.9L174.9,404.1
                                                        c9.6,9.6,25.2,9.6,34.9,0l305.7-305.7C514.1,100.7,514.1,85.1,504.5,75.5z" />
                                            </g>
                                        </g>
                                    </svg>
                                    Yes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <script src="DateTime_RealTime.js"></script>
        <script src="displayPopUpForm.js"></script>
        <script src="hamburger-navbar.js"></script>
        <script src="displayPopUpMessage.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: Dashboard_Page.php");
    exit();
}
?>