<?php

session_start();
require_once 'util/db-conn.php';

$sql = "SELECT * FROM eventStats;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

echo "
<select class='btn btn-primary dropdown-toggle' name='game'>
    <option class='dropdown-menu' value='select'>Select Game</option>
";

for ($i = 0; $i < $resultData->num_rows; $i++) {
    $row = mysqli_fetch_assoc($resultData);

    $event_id = $row["event_id"];
    echo "
        <option class='dropdown-menu' value='" . $event_id . "'>" . $event_id . "</option>
    ";
}

echo "</select>";