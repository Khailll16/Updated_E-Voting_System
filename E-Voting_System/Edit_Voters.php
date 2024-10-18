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
    <title>Admin Voters Page | SIKHAY</title>
    <script src="fetch_sections.js"></script> <!-- JavaScript to fetch sections based on grade -->
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
                            <a style="border-radius: 0px 0px 15px 15px;" id="logout_openPopup"><i
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
                                <h2 style="font-weight: 550;" class="header" id="breadcrup-title">EDIT VOTER</h2>
                            </div>
                            <div class="voters-list-content">
                                <div class="back-button">
                                    <button class="button-back"><a href="Voters_Page_Admin.php" style="color: white;"><i
                                                class="bx bx-arrow-back"></i>Back</a></button>
                                </div>

                                <div id="addvoters-popup" class="addvoters-popup">

                                    <div class="addvoters-popup-forms">
                                        <?php

                                        if (isset($_GET['id'])) {
                                            $id = $_GET['id'];
                                            $sql = "SELECT * from `voters` where `id` = '$id'";
                                            $result = mysqli_query($conn, $sql);
                                            if (!$result) {
                                                die("Invalid query: " . $conn->error);
                                            } else {
                                                $voter = mysqli_fetch_assoc($result);
                                            }
                                        }

                                        if (isset($_POST['update-voters'])) {
                                            $idnew = $_GET['id_new'];
                                            $fname = $_POST['votersfname'];
                                            $lname = $_POST['voterslname'];
                                            $grade = $_POST['grade'];
                                            $section = $_POST['section'];
                                            $pword = $_POST['voterspword'];

                                            $query = "SELECT voters_photo FROM voters WHERE id = '$idnew'";
                                            $result = mysqli_query($conn, $query);
                                            $row = mysqli_fetch_assoc($result);
                                            $photo = $row['voters_photo'];

                                            if (isset($_FILES['updatephoto']['name']) && $_FILES['updatephoto']['name'] != '') {
                                                $size = $_FILES['updatephoto']['size'];
                                                $temp = $_FILES['updatephoto']['tmp_name'];
                                                $type = $_FILES['updatephoto']['type'];
                                                $picturename = $_FILES['updatephoto']['name'];

                                                if (!empty($photo)) {
                                                    unlink("Voters/$photo");
                                                }
                                                move_uploaded_file($temp, "Voters/$picturename");
                                            } else {
                                                $picturename = $photo;
                                            }

                                            $sql = "UPDATE `voters` SET 
                                                `voters_firstname` = '$fname',
                                                `voters_lastname` = '$lname',
                                                `grade_id` = '$grade',
                                                `section_id` = '$section',
                                                `voters_password` = '$pword',
                                                `voters_photo` = '$picturename' 
                                                WHERE `id` = '$idnew'";

                                            $result = mysqli_query($conn, $sql);
                                            if (!$result) {
                                                die("Invalid query: " . $conn->error);
                                            } else {
                                                header("Location: Voters_Page_Admin.php?insert_msg=Voter have been updated successfully");
                                                exit();
                                            }
                                        }
                                        ?>

                                        <form action="Edit_Voters.php?id_new=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                                            <div class="container">
                                                <div class="profile-section">
                                                    <p style="font-size: 24px; font-weight: bold; color: #4A4A4A;">Choose profile picture</p>
                                                    <div class="image-container">
                                                        <img id="profile-picture" src="Voters/<?php echo $voter['voters_photo'] ?>" alt="">
                                                        <div class="overlay">
                                                            <i class='bx bxs-pencil icon'></i>
                                                        </div>
                                                    </div>
                                                    <input type="file" id="file-input" name="updatephoto" class="file-input" accept="image/*" onchange="previewImage(event)">
                                                    <label for="file-input" class="choose-file-btn">Choose File</label>
                                                    <p style="width: 340px; font-size: small; font-weight: lighter; text-align: center; margin: 20px 0px 0px 0px; color: #4A4A4A;">Accepted file format: JPG, PNG & SVG Recommended dimension: 300 x 300 pixels</p>
                                                </div>

                                                <div class="form-section">
                                                    <label for="">First Name
                                                        <input type="text" name="votersfname" class="input-field" value="<?php echo $voter['voters_firstname'] ?>">
                                                    </label>
                                                    <label for="">Last Name
                                                        <input type="text" name="voterslname" class="input-field" value="<?php echo $voter['voters_lastname'] ?>">
                                                    </label>

                                                    <label for="" style="justify-content: end; display: flex;">Grade
                                                        <select class="input-field" id="grade" name="grade" required onchange="fetchSections(this.value)">
                                                            <option value="" selected>- Select Grade -</option>
                                                            <?php
                                                            // Fetch distinct grades from sections table
                                                            $sql = "SELECT DISTINCT grade FROM sections";
                                                            $result = $conn->query($sql);
                                                            if ($result) {
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $selected = ($row['grade'] == $voter['grade_id']) ? "selected" : "";
                                                                    echo "<option value='" . $row['grade'] . "' $selected>" . $row['grade'] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </label>

                                                    <label for="" style="justify-content: end; display: flex;">Section
                                                        <select class="input-field" id="section" name="section" required>
                                                            <option value="" selected>- Select Section -</option>
                                                            <?php
                                                            // Fetch sections related to the current grade
                                                            $grade = $voter['grade_id'];
                                                            $sql = "SELECT section FROM sections WHERE grade = '$grade'";
                                                            $result = $conn->query($sql);
                                                            if ($result) {
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $selected = ($row['section'] == $voter['section_id']) ? "selected" : "";
                                                                    echo "<option value='" . $row['section'] . "' $selected>" . $row['section'] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </label>

                                                    <label for="">Password
                                                        <input type="password" name="voterspword" class="input-field" value="<?php echo $voter['voters_password'] ?>">
                                                    </label>

                                                    <div class="buttons">
                                                        <button name="update-voters" class="update-btn"><i class="bx bxs-edit"></i>Update</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>


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

                        <!-----SIDEBAR TOP CONTENT------>
                        <div class="sidebar-content">
                            <div class="sidebar-top-content">

                                <!------SIKHAY LOGO------>
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

                <!--LOGOUT FORM------>
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
        <script src="Filter_Grade-Section.js"></script>
        <script src="displayPopUpForm.js"></script>
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
