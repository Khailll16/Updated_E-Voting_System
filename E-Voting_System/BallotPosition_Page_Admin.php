<?php
session_start();
include "database_connect.php";

if (isset($_SESSION['id']) && isset($_SESSION['admin_username'])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="BallotPosition_Admin.css">
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
                                <a href="View_UserProfile.php"><i class='bx bxs-user-detail icon'></i> User Profile</a>
                                <a href="View_WebSetup.php"><i class='bx bx-window icon'></i> Web Setup</a>
                                <a style="border-radius: 0px 0px 15px 15px;" id="logout_openPopup"><i class='bx bx-log-out icon'></i>Sign out</a>
                            </div>
                        </nav>


                    </div>
                    <!----DASHBOARD---->
                    <div class="dashboard-body">

                        <?php
                        $sql = "SELECT * FROM `ballot`";
                        $result = $conn->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $conn->error);
                        } else {
                            ($row = mysqli_fetch_assoc($result));

                        ?>
                            <div class="notification" id="notification">
                                <?php
                                if (isset($_GET['insert_msg'])) {
                                    echo "<p><i class='bx bxs-check-circle'></i> Success!</p>";
                                    echo htmlspecialchars($_GET['insert_msg']);
                                }
                                ?>
                            </div>

                            <h2 style="font-weight: 550;  margin-bottom: 15px;" class="header" id="breadcrup-title">BALLOT POSITIONS</h2>
                            <div class="voters-list-content">
                                <div class="edit-button">
                                    <button class="button-edit"><a href="Edit_BallotTitle.php?id=<?php echo $row['id']; ?>"><i class="bx bxs-edit"></i>Edit</a></button>
                                </div>

                                <div class="dashboard-content">

                                    <!----DASHBOARD TITLE---->
                                    <div class="ballot-section">
                                        <h3 class="official-ballot">OFFICIAL BALLOT</h3>
                                        <div class="ballot-title">
                                            <img src="Images/<?php echo $row['logo_ballot'] ?>" alt="" width="120px">
                                            <h1 style="color:#4A4A4A;"><?php echo $row['title']; ?></h1>
                                        </div>
                                    <?php
                                }
                                    ?>
                                    <form action="">

                                        <?php
                                        // SQL query to fetch positions and their corresponding candidates
                                        $sql_positions = "
                                        SELECT positions.descrip AS position_name, candidates.*
                                        FROM positions
                                        LEFT JOIN candidates ON positions.id = CAST(candidates.position_id AS UNSIGNED)
                                        ORDER BY positions.id, candidates.id";

                                        // Execute the query and check for errors
                                        $result_positions = $conn->query($sql_positions);
                                        if (!$result_positions) {
                                            die("Error in SQL query: " . $conn->error);
                                        }

                                        // Check if any candidates are returned
                                        if (mysqli_num_rows($result_positions) === 0) {
                                            echo "No positions or candidates found.";
                                        }

                                        // Track the current position header to prevent repeating it
                                        $current_position = '';

                                        // Loop through each result and group candidates by position
                                        while ($row = mysqli_fetch_assoc($result_positions)) {
                                            // Check if the position has changed, then display a new header and reset the grid container
                                            if ($current_position !== $row['position_name']) {
                                                // Close the previous grid container if any
                                                if ($current_position !== '') {
                                                    echo '</div>'; // Close previous grid-container
                                                }

                                                // Update the current position and display the header
                                                $current_position = $row['position_name'];
                                                echo "<h3>" . htmlspecialchars($current_position) . "</h3>";

                                                // Start a new grid container for the candidates under this position
                                                echo '<div class="grid-container">';
                                            }
                                        ?>
                                            <div class="grid-item">
                                                <?php if (!empty($row['candidate_firstname'])) { ?>
                                                    <div class="candidate">
                                                        <div class="details-voter">
                                                            <label>
                                                                <input type="radio" name="<?php echo htmlspecialchars($current_position); ?>" value="<?php echo $row['candidate_firstname'] . ' ' . $row['candidate_lastname']; ?>" disabled>
                                                                <img src="Candidates/<?php echo $row['candidate_profile']; ?>" alt="<?php echo htmlspecialchars($row['candidate_firstname']); ?>">
                                                                <div class="candidate-info">
                                                                    <p><?php echo htmlspecialchars($row['candidate_firstname'] . ' ' . $row['candidate_lastname']); ?></p>
                                                                    <button type="button"><i class="bx bx-play"></i>View</button>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="grid-item no-candidates">
                                                        <p>No candidates found for this position.</p>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                        <?php
                                        }

                                        // Close the last grid container
                                        if ($current_position !== '') {
                                            echo '</div>';
                                        }
                                        ?>

                                        <div class="form-group-button">
                                            <button type="button" class="reset_close-form-btn"><svg fill="#24724D" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" style="fill: #24724D;" viewBox="0 0 512 512" xml:space="preserve">
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
                                            <img src="Images/sikhay-new-logo.png" alt="">
                                            <p>Providing easier ways to VOTE and be HEARD.</p>
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
                            <!------SIKHAY LOGO---->
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
                            <div class="form-group-button1">
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