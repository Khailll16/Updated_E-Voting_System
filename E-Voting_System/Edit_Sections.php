<?php
session_start();
include "database_connect.php";

if (isset($_SESSION['id']) && isset($_SESSION['admin_username'])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="EditStyle_Voters.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
        <title>Admin Sections Page | SIKHAY</title>

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
                                <li><a href="#"><i class='bx bxs-dashboard icon'></i> Home</a></li>
                                <li class="active" style="font-weight: lighter;" id="title-page"> <a href=""><i
                                            class='bx bxs-chevron-right'></i> Sections </a></li>
                            </ol>
                        </div>

                        <nav class="nav-burger">
                            <i class='bx bx-menu icon' onclick="toggleMenu()"></i>
                            <div class="menu-content">
                                <h2><i class='bx bxs-cog icon'></i> SETTINGS </h2>
                                <a href="View_UserProfile.php"><i class='bx bxs-user-detail icon'></i> User Profile</a>
                                <a href="View_WebSetup.php"><i class='bx bx-window icon'></i> Web Setup</a>
                                <a style="border-radius: 0px 0px 15px 15px;" href="LogoutPage_Admin.php"><i
                                        class='bx bx-log-out icon'></i>Sign out</a>
                            </div>
                        </nav>

                    </div>

                    <!----DASHBOARD---->
                    <div class="dashboard-body">

                        <div class="dashboard-content">

                            <!----DASHBOARD TITLE---->
                            <div class="second-content">

                                <div class="Voters-list-title">
                                    <h2 style="font-weight: 550;" class="header" id="breadcrup-title">EDIT SECTION</h2>
                                </div>
                                <div class="voters-list-content">
                                    <div class="back-button">
                                        <button class="button-back"><a href="Section_Page_Admin.php" style="color: white;"><i
                                                    class="bx bx-arrow-back"></i>Back</a></button>
                                    </div>

                                    <div id="addvoters-popup" class="addvoters-popup">

                                        <div class="addvoters-popup-forms">

                                            <?php

                                            if (isset($_GET['id'])) {
                                                $id = $_GET['id'];


                                                $sql = "SELECT * from `sections` where `id` = '$id'";
                                                $result = mysqli_query($conn, $sql);


                                                if (!$result) {
                                                    die("Invalid query: " . $conn->error);
                                                } else {
                                                    $row = mysqli_fetch_assoc($result);
                                                }
                                            }
                                            ?>

                                            <?php

                                            if (isset($_POST['update-pos'])) {
                                                if (isset($_GET['id_new'])) {
                                                    $pos_id = $_GET['id_new'];
                                                }
                                                $section = $_POST['section'];
                                                $grade = $_POST['grade'];
                                                $maxstudent = $_POST['maximum'];

                                                $sql = "UPDATE `sections` set `grade` = '$grade',`section` = '$section',`max_student` = '$maxstudent' where `id` = '$pos_id' ";

                                                $result = mysqli_query($conn, $sql);

                                                if (!$result) {
                                                    die("Invalid query: " . $conn->error);
                                                } else {
                                                    header("Location: Section_Page_Admin.php?insert_msg=Section has been edit successfully");
                                                    exit();
                                                }
                                            }

                                            ?>

                                            <form action="Edit_Sections.php?id_new=<?php echo $id; ?>" method="POST">

                                                <div class="container">

                                                    <div class="form-section">

                                                        <label for="">Section
                                                            <input type="text" name="section" class="input-field" value="<?php echo $row['section'] ?>">
                                                        </label>
                                                        <label for="">Grade
                                                            <input type="text" name="grade" class="input-field" value="<?php echo $row['grade'] ?>">
                                                        </label>
                                                        <label for="">Maximum Student
                                                            <input type="number" name="maximum" class="input-field" value="<?php echo $row['max_student'] ?>">
                                                        </label>

                                                        <div class="buttons">
                                                            <button name="update-pos" class="update-btn"><i
                                                                    class="bx bxs-edit"></i>Update</button>
                                                        </div>

                                                    </div>
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
        <script src="hamburger-navbar.js"></script>
        <script src="Edit_Voters_Profile.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: Dashboard_Page.php");
    exit();
}
?>