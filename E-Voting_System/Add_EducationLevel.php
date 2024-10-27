<?php
include "database_connect.php";

if (isset($_POST['add_educationlevel'])) {
    $educationalLevel = $_POST['education_level'];
    $gradeYear = $_POST['education_grade'];
    $maxSection = $_POST['education_maximum'];

    if (empty($educationalLevel)) {
        header("Location: EducationLevel_Page_Admin.php?message=Educational level is required");
        exit();
    } elseif (empty($gradeYear)) {
        header("Location: EducationLevel_Page_Admin.php?message=Grade or year group is required");
        exit();
    } elseif (empty($maxSection)) {
        header("Location: EducationLevel_Page_Admin.php?message=Maximum section is required");
        exit();
    } else {
        $sql = "INSERT INTO level (educational_level, grade_year, max_section) VALUES ('$educationalLevel', '$gradeYear', '$maxSection')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Query Failed: " . $conn->error);
        } else {
            header("Location: EducationLevel_Page_Admin.php?insert_msg=New education level has been added successfully");
            exit();
        }
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}
?>
