<?php
require_once 'util/db-conn.php';

if (isset($_POST["so_submit"])) {
    require_once 'sign-out.php';
    header("location: ../../index.php");
    exit();
}

if (!isset($_POST["submit"])) {
    die("Please enter this page appropriately");
}

$username = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT c_id FROM credentials WHERE username = ? AND password = ?;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($resultData);

if (count($row) === 1) {
    session_start();
    $_SESSION["u_id"] = $row["c_id"];
    header("location: ../../index.php");
    exit();
} else {
    header("location: ../../index.php?error=creds");
    exit();
}