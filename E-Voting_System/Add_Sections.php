<?php
include "database_connect.php";

if (isset($_POST['add_section'])) {
    $educationalLevel = $_POST['education_level'];
    $gradeYear = $_POST['education_grade'];
    $sectionstudent = $_POST['section-student'];
    $maxstudent = $_POST['maximum-student'];

    if (empty($sectionstudent)) {
        header("Location: Section_Page_Admin.php?message=Section is required");
        exit();
    } elseif (empty($gradeYear)) {
        header("Location: Section_Page_Admin.php?message=Grade or year group is required");
        exit();
    } elseif (empty($maxstudent)) {
        header("Location: Section_Page_Admin.php?message=Maximum student is required");
        exit();
    } else {
        // Retrieve the educational level and grade year from the `level` table
        $levelQuery = "SELECT grade_year FROM level WHERE educational_level = '$educationalLevel' AND grade_year = '$gradeYear' LIMIT 1";
        $levelResult = mysqli_query($conn, $levelQuery);

        if ($levelResult && mysqli_num_rows($levelResult) > 0) {
            // Insert the section into the `sections` table
            $sql = "INSERT INTO sections (grade_id, section, max_student, education_id) VALUES ('$gradeYear', '$sectionstudent', '$maxstudent', '$gradeYear')";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Query Failed: " . mysqli_error($conn));
            } else {
                header("Location: Section_Page_Admin.php?insert_msg=New section has been added successfully");
                exit();
            }
        } else {
            header("Location: Section_Page_Admin.php?message=Invalid Educational Level or Grade/Year Group selected");
            exit();
        }
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}
?>
