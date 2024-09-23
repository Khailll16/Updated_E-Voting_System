<?php

$sname = "localhost";
$admin_usrnm = "root";
$admin_psw = "";
$database_name = "e-voting_system";

$conn = mysqli_connect($sname, $admin_usrnm, $admin_psw, $database_name);

if (!$conn){
    echo "Connection failed";
}
?>