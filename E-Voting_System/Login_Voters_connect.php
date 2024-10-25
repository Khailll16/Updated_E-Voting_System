<?php
session_start();
include "database_connect.php";

if (isset($_POST['voter_id']) && isset($_POST['voter_psw'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $voter_id = validate($_POST['voter_id']);
    $voter_psw = validate($_POST['voter_psw']);

    if (empty($voter_id)) {
        header("Location: LoginPage_Voters.php?error=Voters id is required");
        exit();
    } elseif (empty($voter_psw)) {
        header("Location: LoginPage_Voters.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM voters WHERE voters_id = '$voter_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            
            // Use password_verify to compare the entered password with the hashed password
            if ($row['voters_id'] === $voter_id && password_verify($voter_psw, $row['voters_password'])) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['voters_id'] = $row['voters_id'];
                $_SESSION['voters_firstname'] = $row['voters_firstname'];
                $_SESSION['voters_lastname'] = $row['voters_lastname'];

                header("Location: Voters_Ballot_Page.php? WelcometoSikhay" . urlencode($row['voters_firstname']) . "" . urlencode($row['voters_lastname']) . "ID:" . urlencode($row['id']));
                exit();
                
            } else {
                header("Location: LoginPage_Voters.php?error=Incorrect Voters id or Password");
                exit();
            }
        } else {
            header("Location: LoginPage_Voters.php?error=Incorrect Voters id or Password");
            exit();
        }
    }
    
} else {
    header("Location: LoginPage_Voters.php?error");
    exit();
}
?>
