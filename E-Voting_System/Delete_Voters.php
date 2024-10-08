<?php
session_start();
include "database_connect.php";
include "Add_Voters.php";


if (isset($_SESSION['id']) && isset($_SESSION['admin_username'])) {


    // Start by checking if the form is submitted and delete the position
    function deleteVoter()
    {
        include "database_connect.php";
        $id = $_GET["id"];
        $sql = "DELETE FROM voters WHERE id=" . $id;
        $result = $conn->query($sql);

        if ($result) {
            header("Location: Voters_Page_Admin.php?insert_msg=Voter has been deleted successfully");
            exit();
        } else {
            echo "Error deleting Voter: " . $conn->error;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnDelete'])) {
        deleteVoter();
    }




    if (isset($_GET['id'])) {
        $id = $_GET['id'];


        $sql = "SELECT * from `voters` where `id` = '$id'";
        $result = mysqli_query($conn, $sql);


        if (!$result) {
            die("Invalid query: " . $conn->error);
        } else {
            $row = mysqli_fetch_assoc($result);
        }
    }


?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="DeleteStyle_Voters.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
        <title>Admin Voters Page | SIKHAY</title>

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
                                            class='bx bxs-chevron-right'></i> Voters </a></li>
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
                                    <h2 style="font-weight: 550;" class="header" id="breadcrup-title">DELETE VOTER</h2>
                                </div>
                                <div class="voters-list-content">
                                    <div class="back-button">
                                        <button class="button-back"><a href="Voters_Page_Admin.php" style="color:white; display:flex; align-items:center; gap: 3px;"><i class="bx bx-arrow-back"></i>Back</a></button>
                                    </div>

                                    <div id="addvoters-popup" class="addvoters-popup">

                                        <div class="addvoters-popup-forms">

                                            <form action="" method="POST">

                                                <div class="container">
                                                    <div class="warning-description">
                                                        <i style="font-size: 90px; color: red;" class="bx bx-alarm-exclamation"></i>
                                                        <h2>Are you sure?</h2>
                                                        <p>Once you delete, you will not be able to recover</p>
                                                    </div>

                                                    <div class="content-wrapper">
                                                        <div class="profile-section">
                                                            <div class="image-container">
                                                                <img id="profile-picture" src="Voters/<?php echo $row['voters_photo'] ?>" alt="">
                                                            </div>
                                                            <p style="font-size: 24px; font-weight: bold; color: #4A4A4A; margin-top:10px;"><?php echo $row['voters_firstname'] ?> <?php echo $row['voters_lastname'] ?></p>
                                                            <p style="font-size: 20px; font-weight: lighter; color: #4A4A4A; margin-top: -20px;"><?php echo $row['grade_id'] ?> - <?php echo $row['section_id'] ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="buttons">
                                                        <button type="submit" name="btnDelete" class="update-btn">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
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