<?php
include 'database_connect.php';

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
