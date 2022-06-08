<?php

require_once 'util/db-conn.php';

$sql = "SELECT a.player_id, a.points, b.name FROM playertournamentstats a, playercredentials b WHERE a.player_id = b.player_id GROUP BY player_id ORDER BY points DESC;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

echo "<div class='col-lg-4 col-md-6'>
        <div class='card h-100'>
          <div class='card-header pb-0'>
            <h6>Leaderboard</h6>
          </div>

      <div class='card-body p-3'>
        <div class='timeline timeline-one-side'>";

for ($i = 0; $i < 5; $i++) {
    $row = mysqli_fetch_assoc($resultData);

    $score = $row["points"];
    $name = $row["name"];

    echo "<div class='timeline-block mb-3'>
        <span class='timeline-step'>
            <i class='material-icons text-success text-gradient'></i>
        </span>
        <div class='timeline-content'>
            <h6 class='text-dark text-sm font-weight-bold mb-0'>" . $name . "</h6>
            <p class='text-secondary font-weight-bold text-xs mt-1 mb-0'>" . $score . " points</p>
        </div>
    </div>";
}

echo "      </div>
          </div>
        </div>
      </div>";
