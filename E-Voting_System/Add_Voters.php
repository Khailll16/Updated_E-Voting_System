<?php
    include "database_connect.php";
    $pic_uploaded = 0;

    if(isset($_POST['add_voters'])){
        $votersfirstname = $_POST['votersfirstname'];
        $voterslastname = $_POST['voterslastname'];
        $Grade = $_POST['grade'];
        $Section = $_POST['section']; // Assuming this is section name, not ID
        $voterspassword = password_hash($_POST['voterspassword'], PASSWORD_DEFAULT);

        // Fetch the section details based on both grade and section
        $section_query = "SELECT id, max_student FROM sections WHERE grade = '$Grade' AND section = '$Section'";
        $section_result = mysqli_query($conn, $section_query);

        // Check if the section exists
        if (mysqli_num_rows($section_result) == 0) {
            die("Section not found or invalid Grade/Section combination.");
        }

        // Fetch section information
        $section_row = mysqli_fetch_assoc($section_result);
        $section_id = $section_row['id'];
        $max_student = $section_row['max_student'];

        // Count the number of current students in the section
        $count_query = "SELECT COUNT(*) as student_count FROM voters WHERE section_id = '$section_id'";
        $count_result = mysqli_query($conn, $count_query);
        $count_row = mysqli_fetch_assoc($count_result);
        $current_student_count = $count_row['student_count'];

        // Check if adding another student exceeds the limit
        if ($current_student_count >= $max_student) {
            header("Location: Voters_Page_Admin.php?message=The maximum number of students for this section has been reached.");
            exit();
        }

        // Image upload logic
        $photo = 'Profile.png'; // Set default profile picture
        if (!empty($_FILES['votersprofile']['name'])) {
            $image = time().$_FILES["votersprofile"]['name'];
            if (move_uploaded_file($_FILES['votersprofile']['tmp_name'], $_SERVER['DOCUMENT_ROOT']. 
            '/UPDATED_E-VOTING_SYSTEM/E-Voting_System/Voters/'.$image)){
                $target_file = $_SERVER['DOCUMENT_ROOT'].'/UPDATED_E-VOTING_SYSTEM/E-Voting_System/Voters/'.$image;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $picname = basename($_FILES['votersprofile']['name']);
                $photo = time().$picname;
                if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "svg"){
                ?>
                    <script> 
                        alert("Please upload photo having extension .jpg / .jpeg / .png / .svg");
                    </script>
                <?php
                } else if ($_FILES["votersprofile"]["size"] > 1000000) {
                ?>
                    <script> 
                        alert("Image size is too large");
                    </script>
                <?php
                } else {
                    $pic_uploaded = 1;
                }
            }
        }

        // Use default picture if no picture is uploaded
        if ($pic_uploaded == 0) {
            $photo = 'Profile.png'; // Default profile picture stored in 'Images' folder
        }

        // Generate a unique ID for the voter
        $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $votersid = substr(str_shuffle($set), 0, 15);

        // Validate required fields
        if(empty($votersfirstname)){
            header("Location: Voters_Page_Admin.php?message=Firstname of the voter is required");
            exit();  
        } elseif(empty($voterslastname)){
            header("Location: Voters_Page_Admin.php?message=Lastname of the voter is required");
            exit(); 
        } elseif(empty($Grade)){
            header("Location: Voters_Page_Admin.php?message=Grade of the voter is required");
            exit();
        } elseif(empty($Section)){
            header("Location: Voters_Page_Admin.php?message=Section of the voter is required");
            exit();
        } elseif(empty($voterspassword)){
            header("Location: Voters_Page_Admin.php?message=Password of the voter is required");
            exit(); 
        } else {
            // Insert voter information using the fetched section_id (No subquery needed in INSERT)
            $sql = "INSERT INTO voters (voters_firstname, voters_lastname, voters_password, voters_id, voters_photo, grade_id, section_id) 
            VALUES ('$votersfirstname','$voterslastname','$voterspassword','$votersid','$photo','$Grade','$section_id')";
            $result = mysqli_query($conn, $sql);

            if(!$result){
                die("Query Failed: " . $conn->error);
            } else {
                header("Location: Voters_Page_Admin.php?insert_msg=New voter has been added successfully");
                exit();   
            }
        }
    }
?>
