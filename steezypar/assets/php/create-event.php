<?php

require_once 'util/db-conn.php';

if (isset($_POST["cancel_event"])) {
    header("location: ../../pages/players.php");
    exit();
}

if (!isset($_POST["add_event"])) {
    die("Please enter this page appropriately");
}

$location = $_POST["location_in"];
$start = $_POST["start_in"];
$end = $_POST["end_in"];
$prev_id = '';

$sql = "SELECT * FROM eventStats;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

for($i = 0; $i < $resultData->num_rows; $i++) {
    $row = mysqli_fetch_assoc($resultData);
    $prev_id = $row["event_id"];
}

$id_no = substr($prev_id, -3);
$next_no = (int)$id_no + 1;
$next_id = 'EVE' . substr(str_repeat('0', 3) . $next_no, -3);
echo $next_id;

$sql = "INSERT INTO eventStats (event_id, start_date, end_date, location_id) VALUES (?, ?, ?, ?);";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $next_id, $start, $end, $location);
mysqli_stmt_execute($stmt);

header("location: ../../pages/players.php");