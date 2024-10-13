<?php
session_start();
include "database_connect.php";
include "Add_Voters.php";

if (isset($_SESSION['id']) && isset($_SESSION['admin_username'])) {
    $searchQuery = '';
    if (isset($_POST['search'])) {
        $searchQuery = mysqli_real_escape_string($conn, $_POST['search']);
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="VotersStyle_Page.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                                <li><a href="Voters_Page_Admin.php"><i class='bx bxs-dashboard icon'></i> Home</a></li>
                                <li class="active" style="font-weight: lighter;" id="title-page"> <a href=""><i class='bx bxs-chevron-right'></i> Voters </a></li>
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

                            <!----DASHBOARD TITLE---->
                            <div class="second-content">

                                <div class="Voters-list-title">
                                    <h2 style="font-weight: 550;" class="header" id="breadcrup-title">VOTERS LIST</h2>
                                </div>

                                <div class="notification" id="notification">
                                    <?php
                                    if (isset($_GET['insert_msg'])) {
                                        echo "<p><i class='bx bxs-check-circle'></i> Success!</p>";
                                        echo htmlspecialchars($_GET['insert_msg']);
                                    }
                                    ?>
                                </div>
                                <div class="voters-list-content">
                                    <div class="add-button">
                                        <button id="addvoters_openPopup" class="button-add"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                                                <g fill="currentColor">
                                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7a3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0a3 3 0 0 1 6 0" />
                                                    <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                                </g>
                                            </svg>New</button>
                                    </div>

                                    <div class="voters-list-container">
                                        <table class="voters-table">


                                            <!--------ENTRIES SEARCH BAR CONTAINER-------->
                                            <div class="entries-search-bar-container">
                                                <div class="selector-entries">
                                                    <label>Show</label>
                                                    <select name="entries" id="entries" onchange="loadTable(1)">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                    <label>Entries</label>
                                                </div>

                                                <div class="grade-section">
                                                    <div class="grade-selection">
                                                        <select name="filter_grade" id="filter_grade" onchange="this.form.submit()">
                                                            <option value="">Select Grade</option>
                                                            <?php
                                                            // Fetch all sections from the database
                                                            $sql = "SELECT * FROM sections";
                                                            $result = $conn->query($sql);

                                                            if (!$result) {
                                                                die("Invalid query: " . $conn->error);
                                                            } else {
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    // Keep selected option when reloading the page
                                                                    $selected = isset($_POST['filter_section']) && $_POST['filter_section'] == $row['grade'] ? 'selected' : '';
                                                                    echo "<option value='" . $row['grade'] . "' $selected>" . $row['grade'] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="grade-selection">
                                                        <form method="POST" action="">
                                                            <select name="filter_section" id="filter_section" onchange="this.form.submit()">
                                                                <option value="">Select Section</option>
                                                                <?php

                                                                $sql = "SELECT * FROM sections";
                                                                $result = $conn->query($sql);

                                                                if (!$result) {
                                                                    die("Invalid query: " . $conn->error);
                                                                } else {
                                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                                        $selected = isset($_POST['filter_section']) && $_POST['filter_section'] == $row['section'] ? 'selected' : '';
                                                                        echo "<option value='" . $row['section'] . "' $selected>" . $row['section'] . "</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Moved search-bar to the end -->
                                                <div class="search-bar">
                                                    <div class="search-container">
                                                        <form method="POST" action="">
                                                            <i class="bx bx-search icon"></i>
                                                            <input type="text" class="search-input" name="search" placeholder="Search..." value="<?php echo $searchQuery; ?>">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="table-container">
                                                <table class="voters-list">
                                                    <tbody>
                                                        <tr style="border-radius: 11px;">
                                                            <th style="border-radius: 11px 0px 0px 11px;">Photo</th>
                                                            <th>Last Name</th>
                                                            <th>First Name</th>
                                                            <th>Voters ID</th>
                                                            <th>Grade</th>
                                                            <th>Section</th>
                                                            <th style="border-radius: 0px 11px 11px 0px;">Actions</th>
                                                        </tr>


                                                        <?php
                                                        $sql = "SELECT voters.*, grade_table.grade, section_table.section 
                                                        FROM voters 
                                                        LEFT JOIN sections AS grade_table ON voters.grade_id = grade_table.id
                                                        LEFT JOIN sections AS section_table ON voters.section_id = section_table.id
                                                        WHERE voters_lastname LIKE '%$searchQuery%' OR 
                                                        voters_firstname LIKE '%$searchQuery%' OR 
                                                        voters_id LIKE '%$searchQuery%' OR
                                                        grade_id LIKE '%$searchQuery%' OR
                                                        section_id LIKE '%$searchQuery%'";
                                                        $result = $conn->query($sql);

                                                        if (!$result) {
                                                            die("Invalid query: " . $conn->error);
                                                        } else {
                                                            while ($row = mysqli_fetch_assoc($result)) {

                                                        ?>

                                                                <tr>
                                                                    <td style="padding-top: 7px;">
                                                                        <img src="Voters/<?php echo $row['voters_photo'] ?>" width='41px' style='background-color: #ddd; border-radius: 3px;' />
                                                                    </td>
                                                                    <td> <?php echo $row['voters_lastname']; ?> </td>
                                                                    <td> <?php echo $row['voters_firstname']; ?> </td>

                                                                    <td>
                                                                        <?php echo $row['voters_id']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['grade_id']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['section_id']; ?>
                                                                    </td>
                                                                    <td style="padding: 8px 0px;">
                                                                        <div class="actions-button">
                                                                            <a href="Edit_Voters.php?id=<?php echo $row['id']; ?>"><button class="update"><i class='bx bxs-edit'></i></button></a>
                                                                            <a href="Delete_Voters.php?id=<?php echo $row['id']; ?>"><button class="delete"><i class='bx bxs-trash'></i></button></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                </table>

                                                <div class="pagination-content">
                                                    <?php
                                                    include "database_connect.php";

                                                    $sql = "SELECT * FROM voters";
                                                    $query = $conn->query($sql);

                                                    echo "<div class='entries'>";
                                                    echo "<p>Showing 1 to $query->num_rows  of  $query->num_rows  entries</p>";
                                                    echo "</div>";
                                                    ?>
                                                    <div class="pagination">
                                                        <button class="prev-btn" onclick="loadTable(currentPage - 1)"><i class='bx bxs-left-arrow'></i> Prev</button>
                                                        <span id="page-numbers"></span> <!-- This will hold the current page number -->
                                                        <button class="next-btn" onclick="loadTable(currentPage + 1)">Next <i class='bx bxs-right-arrow'></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                        </table>
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


                                </div>

                            </div>

                        </nav>




                        <!--------ADD VOTERS POP UP FORM----------->

                        <?php
                        include "database_connect.php";

                        if (isset($_POST['grade'])) {
                            $grade = mysqli_real_escape_string($conn, $_POST['grade']);
                            $sql = "SELECT section FROM sections WHERE grade = '$grade'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<option value='' selected=''>- Select Section -</option>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['section'] . "'>" . $row['section'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No sections available</option>";
                            }
                        }
                        ?>



                        <div id="addvoters-popup" class="addvoters-popup">
                            <div class="addvoters-popup-content">
                                <div class="addvoters-popup-top">
                                    <h2>NEW VOTER</h2>
                                </div>

                                <div class="addvoters-popup-forms">
                                    <form action="Add_Voters.php" autocomplete="off" enctype="multipart/form-data" method="POST">
                                        <div class="form-group-title">
                                            <label for="voters-firstname">Firstname</label>
                                            <input type="text" id="votersfirstname" name="votersfirstname" class="input-size" value="" required>
                                        </div>
                                        <div class="form-group-title">
                                            <label for="votersLastname">Lastname</label>
                                            <input type="text" id="voterslastname" name="voterslastname" class="input-size" value="" required>
                                        </div>
                                        <div class="form-group-position">
                                            <label for="Grade" class="col-sm-3 control-label">Grade</label>
                                            <select class="form-position" id="grade" name="grade" required="" onchange="fetchSections(this.value)">
                                                <option value="" selected="">- Select Grade -</option>
                                                <?php
                                                $sql = "SELECT DISTINCT grade FROM sections";
                                                $result = $conn->query($sql);

                                                if (!$result) {
                                                    die("Invalid query: " . $conn->error);
                                                } else {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='" . $row['grade'] . "'>" . $row['grade'] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group-position">
                                            <label for="Section" class="col-sm-3 control-label">Section</label>
                                            <select class="form-position" id="section" name="section" required="">
                                                <option value="" selected="">- Select Section -</option>
                                            </select>
                                        </div>

                                        <div class="form-group-title">
                                            <label for="voters-password">Password</label>
                                            <input type="password" id="voterspassword" name="voterspassword" class="input-size" value="" required>
                                        </div>
                                        <div class="form-group-photo">
                                            <label for="votersprofile">Photo</label>
                                            <input type="file" id="votersprofile" name="votersprofile" class="input-size" value="">
                                        </div>

                                        <div class="form-group-button">
                                            <button type="button" class="voters-close-form-btn"><svg width="15px" height="15px" fill="#24724D"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                                                        fill="#24724D" />
                                                </svg>
                                                Close</button>
                                            <button type="submit" name="add_voters" value="Save" class="save-btn"><svg fill="#000000" version="1.1" id="Capa_1"
                                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    width="15px" height="15px" style="fill: white;" viewBox="0 0 407.096 407.096"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M402.115,84.008L323.088,4.981C319.899,1.792,315.574,0,311.063,0H17.005C7.613,0,0,7.614,0,17.005v373.086
                                                        c0,9.392,7.613,17.005,17.005,17.005h373.086c9.392,0,17.005-7.613,17.005-17.005V96.032
                                                        C407.096,91.523,405.305,87.197,402.115,84.008z M300.664,163.567H67.129V38.862h233.535V163.567z" />
                                                            <path d="M214.051,148.16h43.08c3.131,0,5.668-2.538,5.668-5.669V59.584c0-3.13-2.537-5.668-5.668-5.668h-43.08
                                                        c-3.131,0-5.668,2.538-5.668,5.668v82.907C208.383,145.622,210.92,148.16,214.051,148.16z" />
                                                        </g>
                                                    </g>
                                                </svg>
                                                Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



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
                <script src="Filter_Grade-Section.js"></script>
                <script src="Tables_Functionals.js"></script>
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