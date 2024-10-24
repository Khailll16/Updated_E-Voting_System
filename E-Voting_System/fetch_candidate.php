<?php
include "database_connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT candidates.*, positions.descrip 
            FROM candidates 
            LEFT JOIN positions ON candidates.position_id = positions.id 
            WHERE candidates.id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row); // Return the data as JSON
    } else {
        echo json_encode([]);
    }
}
?>
