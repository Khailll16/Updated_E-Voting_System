<?php
session_start();
include "database_connect.php";

if (isset($_SESSION['id']) && isset($_SESSION['voters_id'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="Images/Black Retro Minimalist Vegan Cafe Logo (26).png">
        <title>Voters Ballot Page | SIKHAY</title>
        <link rel="stylesheet" href="VotersBallot_Page.css">
    </head>

    <body>
        <main>

        </main>
    </body>

    </html>

<?php
} else {
    header("Location: Voters_Ballot_Page.php");
    exit();
}
?>