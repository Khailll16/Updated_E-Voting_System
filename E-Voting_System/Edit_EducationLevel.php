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
        <title>Admin Education Level Page | SIKHAY</title>
    </head>

    <body>
        <div class="main-container">
            <!-- RIGHT SIDE CONTENT -->
            <div class="right-side">
                <div class="right-side-content">

                    <!-- PROFILE ADMIN -->
                    <div class="top_content">
                        <div class="breadcrumb-content">
                            <ol class="breadcrumb">
                                <li><a href="Dashboard_Page.php"><i class='bx bxs-dashboard icon'></i> Home</a></li>
                                <li class="active" style="font-weight: lighter;" id="title-page"> <a href="#"><i class='bx bxs-chevron-right'></i> Education Level </a></li>
                            </ol>
                        </div>
                        <nav class="nav-burger">
                            <i class='bx bx-menu icon' onclick="toggleMenu()"></i>
                            <div class="menu-content">
                                <h2><i class='bx bxs-cog icon'></i> SETTINGS </h2>
                                <a href="View_UserProfile.php"><i class='bx bxs-user-detail icon'></i> User Profile</a>
                                <a href="View_WebSetup.php"><i class='bx bx-window icon'></i> Web Setup</a>
                                <a id="logout_openPopup" style="border-radius: 0px 0px 15px 15px;"><i class='bx bx-log-out icon'></i>Sign out</a>
                            </div>
                        </nav>
                    </div>

                    <!-- DASHBOARD BODY -->
                    <div class="dashboard-body">
                        <div class="dashboard-content">

                            <!-- DASHBOARD TITLE -->
                            <div class="second-content">
                                <div class="Voters-list-title">
                                    <h2 style="font-weight: 550;" class="header" id="breadcrup-title">EDIT EDUCATION LEVEL</h2>
                                </div>
                                <div class="voters-list-content">
                                    <div class="back-button">
                                        <button class="button-back"><a href="EducationLevel_Page_Admin.php" style="color: white;"><i class='bx bx-arrow-back'></i> Back</a></button>
                                    </div>
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $id = intval($_GET['id']);

                                        // Fetch data for the specific education level
                                        $sql = "SELECT * FROM level WHERE id = $id";
                                        $result = $conn->query($sql);

                                        if ($result && $result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                        } else {
                                            die("No data found for the specified ID.");
                                        }

                                        // Handle form submission for updating the data
                                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-pos'])) {
                                            $educationalLevel = $_POST['education_level'];
                                            $gradeYear = $_POST['grade_year'];
                                            $maxSection = intval($_POST['max_section']);

                                            $updateSql = "UPDATE level SET educational_level = '$educationalLevel', grade_year = '$gradeYear', max_section = '$maxSection' WHERE id = $id";
                                            if ($conn->query($updateSql)) {
                                                header("Location: EducationLevel_Page_Admin.php?insert_msg=Education Level updated successfully");
                                                exit();
                                            } else {
                                                echo "Error updating record: " . $conn->error;
                                            }
                                        }
                                    } else {
                                        die("No ID specified.");
                                    }
                                    ?>

                                    <div id="addvoters-popup" class="addvoters-popup">
                                        <div class="addvoters-popup-forms">
                                            <!-- Include ID in the action URL to ensure it is passed correctly -->
                                            <form action="Edit_EducationLevel.php?id=<?php echo $id; ?>" method="POST">
                                                <div class="container">
                                                    <div class="form-section">
                                                        <!-- Educational Level -->
                                                        <label for="education-level" style="justify-content: end; display: flex;">Educational Level
                                                            <select class="input-field" id="education-level" name="education_level" required>
                                                                <option value="" disabled>Select educational level</option>
                                                                <option value="Primary Education" <?php if ($row['educational_level'] == 'Primary Education') echo 'selected'; ?>>Primary Education</option>
                                                                <option value="Secondary Education" <?php if ($row['educational_level'] == 'Secondary Education') echo 'selected'; ?>>Secondary Education</option>
                                                                <option value="Senior Education" <?php if ($row['educational_level'] == 'Senior Education') echo 'selected'; ?>>Senior Education</option>
                                                                <option value="Tertiary Education" <?php if ($row['educational_level'] == 'Tertiary Education') echo 'selected'; ?>>Tertiary Education</option>
                                                            </select>
                                                        </label>

                                                        <!-- Hidden input to store current grade_year for JavaScript -->
                                                        <input type="hidden" id="current-grade-year" value="<?php echo htmlspecialchars($row['grade_year']); ?>">

                                                        <!-- Grade or Year Group -->
                                                        <label for="grade-year" style="justify-content: end; display: flex;">Grade or Year Group
                                                            <select class="input-field" id="education-grade" name="grade_year" required>
                                                                <option value="">Select grade or year group</option>
                                                                <!-- Options will be populated dynamically by JavaScript -->
                                                            </select>
                                                        </label>

                                                        <!-- Maximum Section -->
                                                        <label for="max-section">Number of Sections
                                                            <input type="number" name="max_section" class="input-field" value="<?php echo $row['max_section']; ?>" required>
                                                        </label>

                                                        <!-- Update Button -->
                                                        <div class="buttons">
                                                            <button type="submit" name="update-pos" class="update-btn"><i class="bx bxs-edit"></i> Update</button>
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
                </div>

                <!-- SIDE BAR -->
                <nav class="sidebar">
                    <div class="menu-bar">
                        <?php
                        $sql = "SELECT * FROM `setup`";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="sidebar-content">
                            <div class="sidebar-top-content">
                                <div class="sikhay-logo">
                                    <img src="Organization/<?php echo $row['logo'] ?>" alt="" width="78px">
                                    <div class="school-name">
                                        <p style="color: #4A4A4A; font-size: 16px;"><?php echo $row['organization_name']; ?></p>
                                        <p style="font-weight: lighter; font-size: 13px; color: #9F9898;">Organization</p>
                                    </div>
                                    <hr style="margin-top: 10px;">
                                </div>

                                <header class="sidebar-profile">
                                    <div class="image-text">
                                        <?php
                                        $sql = "SELECT * FROM `admin` WHERE `id` = '{$_SESSION['id']}'";
                                        $result = $conn->query($sql);
                                        $row = mysqli_fetch_assoc($result);
                                        ?>
                                        <span class="image">
                                            <img id="picture-admin" src="Images/<?php echo $row['admin_profile'] ?>" alt="">
                                        </span>
                                        <div class="text header-text">
                                            <p id="name-admin"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></p>
                                            <span class="name">Online</span>
                                        </div>
                                    </div>
                                </header>

                            </div>
                        </div>

                        <div class="menu">
                            <ul class="menu-links">
                                <li class="nav-link">
                                    <a href="Dashboard_Page.php">
                                        <i class='bx bxs-dashboard icon'></i>
                                        <span class="text nav-text">DashBoard</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="Votes_Page_Admin.php">
                                        <i class='bx bxs-box icon'></i>
                                        <span class="text nav-text">Votes</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="EducationLevel_Page_Admin.php">
                                        <i class='bx bx-bar-chart icon'></i>
                                        <span class="text nav-text">Education Level</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="Section_Page_Admin.php">
                                        <i class='bx bxs-objects-horizontal-left icon'></i>
                                        <span class="text nav-text">Sections</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="Voters_Page_Admin.php">
                                        <i class='bx bxs-group icon'></i>
                                        <span class="text nav-text">Voters</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="Position_Page_Admin.php">
                                        <i class='bx bxs-objects-horizontal-left icon'></i>
                                        <span class="text nav-text">Positions</span>
                                    </a>
                                </li>
                                <li class="nav-link">
                                    <a href="Candidates_Page_Admin.php">
                                        <i class='bx bxs-user-account icon'></i>
                                        <span class="text nav-text">Candidates</span>
                                    </a>
                                </li>
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

                <!-- LOGOUT FORM -->
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
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793-5.793z" fill="#24724D"></path>
                                        </svg> Close</button>
                                    <button type="submit" class="save-btn">
                                        <svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" style="fill: white;" viewBox="0 0 512 512" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M504.5,75.5c-9.6-9.6-25.2-9.6-34.9,0L192.4,352.7L42.3,202.7c-9.6-9.6-25.2-9.6-34.9,0c-9.6,9.6-9.6,25.2,0,34.9L174.9,404.1
                                                    c9.6,9.6,25.2,9.6,34.9,0l305.7-305.7C514.1,100.7,514.1,85.1,504.5,75.5z" />
                                                </g>
                                            </g>
                                        </svg> Yes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="EducationalLevel_Script.js"></script>
        <script src="displayPopUpForm.js"></script>
        <script src="hamburger-navbar.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: Dashboard_Page.php");
    exit();
}
?>