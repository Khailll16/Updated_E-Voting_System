<?php
include "database_connect.php";

if (isset($_POST['add_section'])) {
    $sectionstudent = $_POST['section-student'];
    $gradestudent = $_POST['grade-student'];
    $maxstudent = $_POST['maximum-student'];

    if (empty($sectionstudent)) {
        header("Location: Section_Page_Admin.php?message=Section is required");
        exit();
    } elseif (empty($gradestudent)) {
        header("Location: Section_Page_Admin.php?message=Grade is required");
        exit();
    } elseif (empty($maxstudent)) {
        header("Location: Section_Page_Admin.php?message=Maximum student is required");
        exit();
    } else {
        $sql = "INSERT INTO sections (grade, section, max_student) VALUES ('$gradestudent','$sectionstudent','$maxstudent')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Query Failed: " . $conn->error);
        } else {
            header("Location: Section_Page_Admin.php?insert_msg=New section have been added successfully");
            exit();
        }
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}
