<?php
include "database_connect.php";

if (isset($_GET['education_level'])) {
    $educationLevel = mysqli_real_escape_string($conn, $_GET['education_level']);

    // Fetch grades for the selected educational level
    $sql = "SELECT grade_year FROM level WHERE educational_level = '$educationLevel'";
    $result = $conn->query($sql);

    $grades = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $grades[] = $row['grade_year'];
        }
    }
    
    echo json_encode($grades);
}
?>
