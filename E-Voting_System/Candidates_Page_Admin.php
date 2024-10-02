<?php
session_start();
include "database_connect.php";
include "Add_Candidate.php";

if (isset($_SESSION['id']) && isset($_SESSION['admin_username'])) {
        $searchQuery = '';
        if (isset($_POST['search'])) {
            $searchQuery = mysqli_real_escape_string($conn, $_POST['search']);
        }

?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="CandidatesStyle_Page.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
        <title>Admin Candidates Page | SIKHAY</title>

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
                                <li><a href="Candidates_Page_Admin.php"><i class='bx bxs-dashboard icon'></i> Home</a></li>
                                <li class="active" style="font-weight: lighter;" id="title-page"> <a href=""><i class='bx bxs-chevron-right'></i> Candidates </a></li>
                            </ol>
                        </div>

                        <nav class="nav-burger">
                            <i class='bx bx-menu icon' onclick="toggleMenu()"></i>
                            <div class="menu-content">
                                <h2><i class='bx bxs-cog icon'></i> SETTINGS </h2>
                                <a href="View_UserProfile.php"><i class='bx bxs-user-detail icon'></i> User Profile</a>
                                <a href="View_WebSetup.php"><i class='bx bx-window icon'></i> Web Setup</a>
                                <a style="border-radius: 0px 0px 15px 15px;" href="LogoutPage_Admin.php"><i class='bx bx-log-out icon'></i>Sign out</a>
                            </div>
                        </nav>

                    </div>

                    <!----DASHBOARD---->
                    <div class="dashboard-body">

                        <div class="dashboard-content">

                            <!----DASHBOARD TITLE---->
                            <div class="second-content">

                                <div class="Voters-list-title">
                                    <h2 style="font-weight: 550;" class="header" id="breadcrup-title">CANDIDATES LIST</h2>
                                </div>

                                <div class="notification" id="notification">
                                    <?php
                                    if (isset($_GET['insert_msg'])) {
                                        echo "<p><i class='bx bxs-check-circle'></i> Success!</p>";
                                        echo htmlspecialchars($_GET['insert_msg']);
                                    }
                                    ?>
                                </div>

                                <div class="add-button">
                                    <button id="addCandidates_openPopup" class="button-add"><i class='bx bxs-user-plus icon'></i>New</button>
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

                                                        if (!$result) {
                                                            die("Invalid query: " . $conn->error);
                                                        } else {

                                                            while ($row = mysqli_fetch_assoc($result)) {

                                                                echo "<option value='" . $row['descrip'] . "'>" . $row['descrip'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
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
                                                <tr style="border-radius: 11px;">
                                                    <th style="border-radius: 11px 0px 0px 11px;">Photo</th>
                                                    <th>Last Name</th>
                                                    <th>First Name</th>
                                                    <th>Position</th>
                                                    <th style="border-radius: 0px 11px 11px 0px;">Actions</th>
                                                </tr>

                                                <?php
                                               $sql = "SELECT candidates.*, positions.descrip 
                                                FROM candidates 
                                                LEFT JOIN positions ON candidates.position_id = positions.id
                                                WHERE candidate_lastname LIKE '%$searchQuery%' 
                                                OR candidate_firstname LIKE '%$searchQuery%'";
                                                $result = $conn->query($sql);

                                                if (!$result) {
                                                    die("Invalid query: " . $conn->error);
                                                } else {
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                ?>

                                                        <tr>
                                                            <td style="padding-top: 7px;">
                                                                <img src="Candidates/<?php echo $row['candidate_profile'] ?>" data-id="<?php echo $row['id']; ?>" width='60px' style='background-color: #ddd; border-radius: 3px;'>
                                                            </td>
                                                            <td> <?php echo $row['candidate_lastname']; ?> </td>
                                                            <td> <?php echo $row['candidate_firstname']; ?> </td>
                                                            <td>
                                                                <?php echo $row['position_id']; ?>
                                                            </td>
                                                            <td style="padding: 8px 0px;">
                                                                <div class="actions-button">
                                                                    <a href="View_Candidates.php?id=<?php echo $row['id']; ?>"><button class="view"><i class='bx bx-play'></i></button></a>
                                                                    <a href="Edit_Candidates.php?id=<?php echo $row['id']; ?>"><button class="update"><i class='bx bxs-edit'></i></button></a>
                                                                    <a href="Delete_Candidates.php?id=<?php echo $row['id']; ?>"><button class="delete"><i class='bx bxs-trash'></i></button></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </table>

                                            <div class="pagination-content">
                                                <div class="pagination">
                                                    <a href=""><button class="prev-btn"><i class='bx bxs-left-arrow'></i> Prev </button></a>
                                                    <p>1</p>
                                                    <a href=""><button class="next-btn"> Next <i class='bx bxs-right-arrow'></i></button></a>
                                                </div>
                                            </div>

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
                                    <img src="Organization/<?php echo $row['logo'] ?>" alt="" width="55px">
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

                <!------ADD CANDIDATES FORM POP UP----------->


                <div id="addCandidates_popup" class="addCandidates_popup">
                    <div class="addCandidates_popup-content">
                        <span class="addCandidates_close">&times;</span>
                        <div class="addCandidates_popup-top">
                            <h2>NEW CANDIDATE</h2>
                        </div>

                        <div class="addCandidates_popup-forms">
                            <form action="Add_Candidate.php" autocomplete="off" enctype="multipart/form-data" method="POST">
                                <div class="form-group-title">
                                    <label for="update-candidate-firstname">Firstname</label>
                                    <input type="update-candidate-firstname" id="update-candidate-firstname" name="candidate-firstname" class="input-size" value="" required>
                                </div>
                                <div class="form-group-title">
                                    <label for="update-candidate-lastname">Lastname</label>
                                    <input type="update-candidate-lastname" id="update-candidate-lastname" name="candidate-lastname" class="input-size" value="" required>
                                </div>
                                <div class="form-group-position">
                                    <label for="position" class="col-sm-3 control-label">Position</label>
                                    <select class="form-position" id="position" name="position" required="">
                                        <option value="" selected="">- Select -</option>
                                        <?php
                                        $sql = "SELECT * FROM positions";
                                        $result = $conn->query($sql);

                                        if (!$result) {
                                            die("Invalid query: " . $conn->error);
                                        } else {

                                            while ($row = mysqli_fetch_assoc($result)) {

                                                echo "<option value='" . $row['descrip'] . "'>" . $row['descrip'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group-photo">
                                    <label for="candidate-profile">Photo</label>
                                    <input type="file" id="candidate-profile" name="candidate-photo" class="input-size" value="">
                                </div>
                                <div class="form-group-textarea">
                                    <label for="candidate-platform">Platform</label>
                                    <textarea class="input-size" id="candidate-platform" name="candidate-platform" rows="7" style="resize: vertical;" required></textarea>
                                </div>

                                <div class="form-group-button">
                                    <button type="button" class="addCandidates_close-form-btn"><svg width="15px" height="15px" fill="#24724D"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z"
                                                fill="#24724D" />
                                        </svg>
                                        Close</button>
                                    <button type="submit" name="add_candidate" class="save-btn"><svg fill="#000000" version="1.1" id="Capa_1"
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


            </div>
        </div>

        <script src="Election_Title.js"></script>
        <script src="Add_Candidates_FormPopup.js"></script>
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