<?php

session_start();

$servername = "webpagesdb.it.auth.gr:3306";
$username = "akritidi_root";
$password = "01234";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,'utf8');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>