<?php
//  Name: MAX-Stuttgart.de - Dashboard
//  File: ./index.php
//  Last Edit: 09.09.2019 by Benjamin Kollmer
//
//  All rights reserved by MAX-STUTTGART.de
//  No permission of distributing or changing this code!
?>

<!DOCTYPE html>
<html lang="de-de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Anmelden | MAX-STUTTGART.de</title>

    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/max-css.css">
    <script src="js/material.min.js"></script>
    <script src="js/sessionhandler.js"></script>

</head>
<body>
<?php

// Include the database Connection and hashing file

include 'connectdb.php';
include 'hash.php';

// Define variables and set to empty values

$nameErr = $pswErr = "";
$username = $psw = "";
$error = "false";

// Login process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $error = "true";
        $usernameErr = "Please enter your Username!";
    } else {
        if (strpos($_POST["username"], ' ') !== false) {
            $error = "true";
            $usernameErr = "Please enter a valid Username!";
        } else {
            // ckeck if username is in db
            $res_us = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'") or die($mainErr = "Bitte versuche es später erneut!");
            $row_us = $res_us->fetch_assoc();
            $salt = $row_us["salt"];
            $username = hash_email($_POST['username'], $salt);
            $res_uss = mysqli_query( $conn, "SELECT username FROM users WHERE username='$username'") or die($mainErr = "Bitte versuche es später noch ein mal!");
            $numrows1 = mysqli_num_rows($res_uss);
            if (mysqli_num_rows($res_uss) == 0) {
                $mainErr = "<br>Username or password is wrong!<br>";
                $error = "true";
            }
        }
    }

    if (empty($_POST["psw"])) {
        $pswErr = "Please enter your password!";
        $error = "true";
    } else {
        $password = $_POST["psw"];
    }

    if ($error == "false") {
        echo "<script>console.log('no errors')</script>";

        $res_s = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'") or die($mainErr = "Bitte versuche es später erneut!");
        $row = $res_s->fetch_assoc();
        $password_db = $row["password"];
        $cookie = $row["sessioncookie"];
        $cookie2 = hash_email($_POST['username'], $salt);
        $hashedpsw = hash_passwd($password, $salt);

        if ($hashedpsw != $password_db) {
            $mainErr = "Username or password is wrong db!";
        } else {

            //Login Redirect
            $url = "home.html";
            echo "<script>setCookie('session', '$cookie');</script>";
            echo "<script>setCookie('usr', '$cookie2');</script>";
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.$url.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
            echo '</noscript>'; exit;
        }
    } else {
        $mainErr = "Your username or password is wrong!";
    }
}
?>


<!-- Center Login Form -->
<div class="mdl-grid center-items centered">
    <div class="  mdl-typography--text-center">

        <!-- Card form-->
        <img class="card-logo" src="assets/logo/card-logo.png" alt="Logo">
        <div class="card">
            <a class="rob-regular max-h2">Max-Stuttgart.de | </a><a class="rob-light max-h2">Dashboard</a>

            <!-- Login Form  -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" name="username" type="text" id="sample1">
                    <label class="mdl-textfield__label" for="sample1">Benutzername</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input card-password-inp" name="password" type="password" id="sample2" >
                    <label class="mdl-textfield__label card-password-lbl" for="sample2" >Passwort</label>
                </div>
            </form>

            <!-- Submit button-->
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored card-button"  type="submit">
                LOGIN
            </button>
        </div>
    </div>
</div>





</body>
</html>





















<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
