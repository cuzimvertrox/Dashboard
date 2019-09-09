<?php
$servername = "localhost";
$username = "uofh2974#WR94";
$password = "4XLHDdR{qLyz03%PQ8EB+7&6-KO!5^";
$dbname = "max-webinterface";

// Create connection
/** @var TYPE_NAME $servername */
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    echo '"Connection failed: " . mysqli_connect_error()';
}


