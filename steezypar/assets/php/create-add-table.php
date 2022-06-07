<?php
session_start();
require_once 'util/db-conn.php';

$sql = "SELECT * FROM playercredentials";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

for ($i = 0; $i < $resultData->num_rows; $i++) {
    $profile_pic = 'default';
    $row = mysqli_fetch_assoc($resultData);

    $name = $row["name"];
    $player_id = $row["player_id"];
    $pic_is_set = $row["pic_is_set"];
    if ($pic_is_set == 1) {
        $profile_pic = $player_id;
    }

    echo "
    <tr>
        <td>
            <div class='d-flex px-2 py-1'>
                <div>
                    <img src='../assets/uploads/" . $profile_pic . ".jpg' class='avatar avatar-sm me-3 border-radius-lg' alt='user1'>
                </div>
                <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>" . $name . "</h6>
                </div>
                <div class='form-check form-switch ps-0 ms-auto my-auto'>
                    <input class='form-check-input mt-1 ms-auto' name='cbx_" . $player_id . "' value='" . $player_id . "'type='checkbox' id='selectPlayer'>
                </div>
            </div>
        </td>
    </tr>";
}