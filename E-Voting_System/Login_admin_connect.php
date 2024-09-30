<?php
session_start();
include "database_connect.php";

 if(isset($_POST['admin_usrnm']) && isset($_POST['admin_psw'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $admin_usrnm = validate($_POST['admin_usrnm']);
    $admin_psw = validate($_POST['admin_psw']);

    if(empty($admin_usrnm)){
        header("Location: LoginPage_Admin.php?error=Username is required");
        exit();  
    }elseif(empty($admin_psw)){
        header("Location: LoginPage_Admin.php?error=Password is required");
        exit();  
    }else{
        $sql = "SELECT * FROM admin WHERE admin_username = '$admin_usrnm' AND admin_password = '$admin_psw'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if($row['admin_username'] === $admin_usrnm && $row['admin_password'] === $admin_psw){
                $_SESSION['id'] = $row['id'];
                $_SESSION['admin_username'] = $row['admin_username'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                
                header("Location: Dashboard_Page.php?insert_msg=You have successfully logged in");
                exit();
            }else{
                header("Location: LoginPage_Admin.php?error=Incorrect Username or Password");
                exit();
            }
        }else{
            header("Location: LoginPage_Admin.php?error=Incorrect Username or Password");
            exit();
        }
    }
    
 }else{
    header("Location: LoginPage_Admin.php?error");
    exit();  
 }



?>
