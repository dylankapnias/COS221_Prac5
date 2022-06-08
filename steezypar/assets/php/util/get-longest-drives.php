<?php
require_once 'db-conn.php';

$sql = "SELECT name, distance_longest FROM playereventstats INNER JOIN playercredentials
        ON playereventstats.player_id = playercredentials.player_id ORDER BY distance_longest DESC;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

$players = array();
$drives = array();

for ($i = 0; $i < $resultData->num_rows; $i++) {
    if ($i == 10) {
        break;
    }
    $row = mysqli_fetch_assoc($resultData);
    array_push($players, $row["name"]);
    array_push($drives, round($row["distance_longest"], 0));
}