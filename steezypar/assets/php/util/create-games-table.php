<?php

require_once 'db-conn.php';

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
        <div class='d-flex px-2'>
          <div>
            <img src='../assets/uploads/" . $profile_pic . "' class='avatar avatar-sm rounded-circle me-2' alt='game" . $event_id . "'>
          </div>
          <div class='my-auto'>
            <h6 class='mb-0 text-sm'>Game " . $game_no . "</h6>
          </div>
        </div>
      </td>
      <td>
        <p class='text-sm font-weight-bold mb-0'>18</p>
      </td>
      <td>
        <span class='text-xs font-weight-bold'>in progress</span>
      </td>
      <td>
        <span class='text-xs font-weight-bold'>" . $start . "</span>
      </td>
      <td>
        <span class='text-xs font-weight-bold'>" . $end . "</span>
      </td>
      <td class='align-middle text-center'>
        <div class='d-flex align-items-center justify-content-center'>
          <span class='me-2 text-xs font-weight-bold'>60%</span>
          <div>
            <div class='progress'>
              <div class='progress-bar bg-gradient-info' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 60%;'></div>
            </div>
          </div>
        </div>
      </td>
      <td class='align-middle'>
        <button class='btn btn-link text-secondary mb-0'>
          <i class='fa fa-ellipsis-v text-xs'></i>
        </button>
      </td>
    </tr>";
}