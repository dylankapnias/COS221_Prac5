<?php

require_once 'db-conn.php';

$sql = "SELECT * FROM playercredentials";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

for ($i = 0; $i < $resultData->num_rows; $i++) {
    $profile_pic = 'default';
    $row = mysqli_fetch_assoc($resultData);

    $player_id = $row["player_id"];
    $name = $row["name"];
    $username = $row["username"];
    $email = $row["email"];
    $pic_is_set = $row["pic_is_set"];
    if ($pic_is_set == 1) {
        $profile_pic = $player_id;
    }

    echo "
    <tr>
      <td>
        <div class='d-flex px-2 py-1'>
          <div>
            <img src='../assets/uploads/" . $profile_pic . ".jpg' class='avatar avatar-sm me-3 border-radius-lg' alt='user" . $player_id . "'>
          </div>
          <div class='d-flex flex-column justify-content-center'>
            <h6 class='mb-0 text-sm'>" . $name . "</h6>
            <p class='text-xs text-secondary mb-0'>" . $email . "</p>
          </div>
        </div>
      </td>
      <td>
        <p class='text-xs font-weight-bold mb-0'>Manager</p>
        <p class='text-xs text-secondary mb-0'>Organization</p>
      </td>
      <td class='align-middle text-center text-sm'>
        <span class='badge badge-sm bg-gradient-success'>Online</span>
      </td>
      <td class='align-middle text-center'>
        <span class='text-secondary text-xs font-weight-bold'>23/04/18</span>
      </td>
      <td class='align-middle'>
        <a href='javascript:;' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user'>
            Edit
        </a>
      </td>
    </tr>";
}