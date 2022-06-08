<?php
require_once 'db-conn.php';

$sql = "SELECT eventStats.event_id, SUM(average) AS Average, eventStats.end_date 
        FROM eventStats 
        INNER JOIN playereventstats 
        ON eventStats.event_id = playereventstats.event_id 
        GROUP BY playereventstats.event_id 
        ORDER BY end_date DESC;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

$averages = array();

for ($i = 0; $i < $resultData->num_rows; $i++) {
    if ($i == 4) {
        break;
    }
    $row = mysqli_fetch_assoc($resultData);
    $averages = array_merge($averages, array($row["event_id"] => round($row["Average"], 2)));
}

end($averages);
$last = key($averages);
reset($averages);