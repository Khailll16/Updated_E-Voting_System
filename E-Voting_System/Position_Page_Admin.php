<?php
session_start();
include "database_connect.php";
include "Add_Positions.php";

if (isset($_SESSION['id']) && isset($_SESSION['admin_username'])) {
    $searchQuery = '';
    if (isset($_POST['search'])) {
        $searchQuery = mysqli_real_escape_string($conn, $_POST['search']);
    }

    // Determine sorting order and column
    $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'descrip'; // Default to sorting by Description
    $sortOrder = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC'; // Default to ASC order
    $toggleSortOrder = $sortOrder == 'ASC' ? 'desc' : 'asc'; // Toggle for next click
?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="PositionStyle_Page.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
        <title>Admin Positions Page | SIKHAY</title>
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
                                <li><a href="Position_Page_Admin.php"><i class='bx bxs-dashboard icon'></i> Home</a></li>
                                <li class="active" style="font-weight: lighter;" id="title-page"> <a href=""><i class='bx bxs-chevron-right'></i> Positions </a></li>
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
                                    <h2 style="font-weight: 550;" class="header" id="breadcrup-title">POSITIONS LIST</h2>
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
                                        <button id="addposition-openPopup" class="button-add">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2m5 11h-4v4h-2v-4H7v-2h4V7h2v4h4z" />
                                            </svg>
                                            New
                                        </button>
                                    </div>

                                    <div class="voters-list-container">
                                        <table class="voters-table">

                                            <!--------ENTRIES SEARCH BAR CONTAINER-------->
                                            <div class="entries-search-bar-container">
                                                <div class="selector-entries">
                                                    <label>Show</label>
                                                    <select name="entries" id="entries" onchange="loadTable(1)">
                                                        <option>10</option>
                                                        <option>25</option>
                                                        <option>50</option>
                                                        <option>100</option>
                                                    </select>
                                                    <label>Entries</label>
                                                </div>

                                                <!-- Separate filter form for position -->
                                                <div class="grade-section">
                                                    <div class="grade-selection">
                                                        <form method="POST" action="">
                                                            <select name="filter_position" id="filter_position" onchange="this.form.submit()">
                                                                <option value="">All Positions</option>
                                                                <?php
                                                                // Fetch all positions from the database
                                                                $sql = "SELECT * FROM positions";
                                                                $result = $conn->query($sql);

                                                                if (!$result) {
                                                                    die("Invalid query: " . $conn->error);
                                                                } else {
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        // Keep selected option when reloading the page
                                                                        $selected = isset($_POST['filter_position']) && $_POST['filter_position'] == $row['descrip'] ? 'selected' : '';
                                                                        echo "<option value='" . $row['descrip'] . "' $selected>" . $row['descrip'] . "</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Separate search form -->
                                                <div class="search-bar">
                                                    <div class="search-container">
                                                        <form method="POST" action="">
                                                            <i class="bx bx-search icon"></i>
                                                            <input type="text" class="search-input" name="search" placeholder="Search..." value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-container">
                                                <table class="voters-list">
                                                    <tr style="border-radius: 11px;">
                                                        <th style="border-radius: 11px 0px 0px 11px;">
                                                            Description
                                                            <a style="color: white; margin-left: 6px;" href="?sort=descrip&order=<?php echo $toggleSortOrder; ?>">
                                                                <i class="fas fa-sort-<?php echo $sortColumn == 'descrip' && $sortOrder == 'ASC' ? 'up' : 'down'; ?>"></i>
                                                            </a>
                                                        </th>
                                                        <th>
                                                            Maximum Vote
                                                            <a style="color: white; margin-left: 6px;" href="?sort=max_vote&order=<?php echo $toggleSortOrder; ?>">
                                                                <i class="fas fa-sort-<?php echo $sortColumn == 'max_vote' && $sortOrder == 'ASC' ? 'up' : 'down'; ?>"></i>
                                                            </a>
                                                        </th>
                                                        <th style="border-radius: 0px 11px 11px 0px;">Actions</th>
                                                    </tr>

                                                    <?php
                                                    // Handle the position filter separately
                                                    $positionFilter = isset($_POST['filter_position']) ? $_POST['filter_position'] : '';

                                                    // Handle the search query separately
                                                    $searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

                                                    // Base SQL query
                                                    $sql = "SELECT * FROM positions WHERE 1";

                                                    // Add position filter to SQL if a position is selected
                                                    if ($positionFilter != '') {
                                                        $sql .= " AND descrip = '$positionFilter'";
                                                    }

                                                    // Add search filter to SQL if a search query is entered
                                                    if ($searchQuery != '') {
                                                        $sql .= " AND (descrip LIKE '%$searchQuery%' OR max_vote LIKE '%$searchQuery%')";
                                                    }

                                                    // Add sorting
                                                    $sql .= " ORDER BY $sortColumn $sortOrder";

                                                    $result = $conn->query($sql);

                                                    if (!$result) {
                                                        die("Invalid query: " . $conn->error);
                                                    } elseif (mysqli_num_rows($result) > 0) { // Check if there is data to display
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                            <tr>
                                                                <td> <?php echo $row['descrip']; ?> </td>
                                                                <td> <?php echo $row['max_vote']; ?> </td>
                                                                <td>
                                                                    <div class="actions-button">
                                                                        <a href="Edit_Positions.php?id=<?php echo $row['id']; ?>"><button class="update"><i class='bx bxs-edit'></i></button></a>
                                                                        <a href="Delete_Positions.php?id=<?php echo $row['id']; ?>"><button class="delete"><i class='bx bxs-trash'></i></button></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        // If no data is found, display a message in the table
                                                        echo "<tr><td colspan='3' style='text-align: center; padding: 10px 0px;'>No data available in table</td></tr>";
                                                    }
                                                    ?>
                                                </table>

                                                <div class="pagination-content">
                                                    <?php
                                                    include "database_connect.php";

                                                    $sql = "SELECT * FROM positions";
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
                                                <a href="EducationLevel_Page_Admin.php">
                                                    <i class='bx bx-bar-chart icon'></i>
                                                    <span class="text nav-text">Education Level</span>
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




                            <!--------ADD POSITION POP UP FORM----------->

                            <div id="addposition-popup" class="addposition-popup">
                                <div class="addposition-popup-content">
                                    <div class="addposition-popup-top">
                                        <h2>NEW POSITION</h2>
                                    </div>

                                    <div class="addposition-popup-forms">
                                        <form action="Add_Positions.php" method="POST">
                                            <div class="form-section">
                                                <div class="form-group">
                                                    <label for="position-candidate">Position</label>
                                                    <input type="text" id="position-candidate" name="position-candidate" class="input-field" value="" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="maximum-vote">Maximum Vote</label>
                                                    <input type="number" id="maximum-vote" name="maximum-vote" class="input-field" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group-button">
                                                <button type="button" class="addposition-close-form-btn"><svg width="15px" height="15px" fill="#24724D"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                                                            fill="#24724D" />
                                                    </svg>
                                                    Close</button>
                                                <button type="submit" name="add_position" class="save-btn"><svg fill="#000000" version="1.1" id="Capa_1"
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