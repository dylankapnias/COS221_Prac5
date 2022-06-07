<?php
require_once 'db-conn.php';

$c_id = $_SESSION["u_id"];

$sql = "SELECT COUNT(*) AS Total FROM playercredentials;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($resultData);

$total = $row["Total"];