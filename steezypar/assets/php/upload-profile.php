<?php
session_start();

require_once 'util/db-conn.php';

if (!isset($_POST["pic_submit"])) {
    die("Please enter this page appropriately");
}

$file = $_FILES["profile_pic"];

$file_sep = explode('.', $file["name"]);
$allow = array('jpg');

if (!in_array(end($file_sep), $allow)) {
    die("Please only upload .jpg");
}

if ($file["error"] != 0) {
    die("There was an error uploading your profile picture");
}

$new_name = $_SESSION["u_id"] . "." . end($file_sep);
move_uploaded_file($file["tmp_name"], '../uploads/' . $new_name);

$sql = "UPDATE playercredentials SET pic_is_set = 1 WHERE player_id = ?;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION["u_id"]);
mysqli_stmt_execute($stmt);

header("location: ../../pages/profile.php?upload=success");