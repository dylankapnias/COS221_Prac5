<?php
$db_host = "localhost";
$db_user = "admin";
$db_pass = "";
$db_name = "steezypar";
$db_port = "3306";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

if (!$conn) {
    die("Connection to database failed" . mysqli_connect_error());
}