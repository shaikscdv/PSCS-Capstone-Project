<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "root";
$dbName = "finalyear";
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
if (!$conn) {
    die("something went wrong");
}
?>