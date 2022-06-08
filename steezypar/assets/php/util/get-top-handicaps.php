<?php
require_once 'db-conn.php';

$sql = "SELECT name, handicap FROM playerStats INNER JOIN playercredentials 
        ON playerStats.player_id = playercredentials.player_id ORDER BY handicap;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

$players = array();
$handicaps = array();

for ($i = 0; $i < $resultData->num_rows; $i++) {
    if ($i == 10) {
        break;
    }
    $row = mysqli_fetch_assoc($resultData);
    array_push($players, $row["name"]);
    array_push($handicaps, round($row["handicap"], 0));
}