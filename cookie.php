<?php

function FunctionName($cookie, $cookie2)
{

  include 'connectdb.php';
  $mainErr = "";

  if (!isset($cookie)) {
    header("Location: /max-webinterface/login.html");
    die();
  } elseif (isset($cookie) and isset($cookie2)) {
    $securecookie = mysqli_real_escape_string($conn, $cookie);
    $securecookie2 = mysqli_real_escape_string($conn, $cookie2);
    $res_s = mysqli_query($conn, "SELECT * FROM users WHERE username='$securecookie2'") or die($mainErr = "Bitte versuche es später erneut!");
    $row = $res_s->fetch_assoc();
    $cookie_db = $row['sessioncookie'];
    if ($row == None) {
      echo "<script>console.log('row = none!');</script>";
      header("Location: /max-webinterface/login.html");
      die();
    } elseif ($cookie == $cookie_db) {
      echo "<script>console.log('Sessioncookie validated!');</script>";
    }
  } else {
    echo "<script>console.log('Sessioncookies not set!');</script>";
    header("Location: /max-webinterface/login.html");
    die();
  }
}
 ?>
