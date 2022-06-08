<?php

require_once 'util/db-conn.php';

$sql = "SELECT * FROM eventStats";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

for ($i = 0; $i < $resultData->num_rows; $i++) {
    $row = mysqli_fetch_assoc($resultData);

    $event_id = $row["event_id"];
    $start = $row["start_date"];
    $end = $row["end_date"];
    $location = $row["location_id"];
    $profile_pic = $location . '.jpg';
    $game_no = $i + 1;

    echo "
    <tr>
        <td>
            <div class='d-flex px-2 py-1'>
                <div>
                    <img src='../assets/img/landscapes/" . $location . ".jpg' class='avatar avatar-sm me-3' alt='xd'>
                </div>
                <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>Game " . $game_no . "</h6>
                </div>
            </div>
        </td>
        <td>
            <div class='avatar-group mt-2'>";

    $sql1 = "SELECT p.player_id, c.name, c.pic_is_set FROM playerEvents AS p NATURAL JOIN playercredentials AS c WHERE p.event_id = ?;";
    $stmt1 = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt1, $sql1);
    mysqli_stmt_bind_param($stmt1, "s", $event_id);
    mysqli_stmt_execute($stmt1);

    $resultData1 = mysqli_stmt_get_result($stmt1);
    for ($j = 0; $j < $resultData1->num_rows; $j++) {
        $row1 = mysqli_fetch_assoc($resultData1);
        $profile_pic = 'default';
        $player_id = $row1["player_id"];
        $name = $row1["name"];
        $pic_is_set = $row1["pic_is_set"];
        if ($pic_is_set == 1) {
            $profile_pic = $player_id;
        }

        echo "
                <a href='javascript:;' class='avatar avatar-xs rounded-circle' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" . $name . "'>
                    <img src='../assets/uploads/" . $profile_pic . ".jpg' alt='profile_pic'>
                </a>";
    }
    echo "
            </div>
        </td>";

    $sql2 = "SELECT event_id, COUNT(player_id) AS TotalPlayers, SUM(average) AS AverageScore FROM playereventstats WHERE event_id = ?;";
    $stmt2 = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt2, $sql2);
    mysqli_stmt_bind_param($stmt2, "s", $event_id);
    mysqli_stmt_execute($stmt2);

    $resultData2 = mysqli_stmt_get_result($stmt2);
    $row2 = mysqli_fetch_assoc($resultData2);
    $average = round($row2["AverageScore"], 2);
    echo "
        <td class='align-middle text-center text-sm'>
            <span class='text-xs font-weight-bold'> " . $average . "</span>
        </td>";
    echo "</tr>";
}