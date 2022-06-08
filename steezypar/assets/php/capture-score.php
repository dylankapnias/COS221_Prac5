<?php
session_start();
require_once 'util/db-conn.php';
require __DIR__ . '/../../vendor/autoload.php';
use Webmozart\Assert\Assert;

if (!isset($_POST["capture_score"])) {
    die("Please enter this page appropriately");
}

if ($_POST["game"] == "select") {
    die("Please select a game to insert scores into");
}

try {
    Assert::integerish($_POST["total_score"], "Score should be an integer value, you filled in %s");
    Assert::integerish($_POST["total_par"], "Par should be an integer value, you filled in %s");
    Assert::integerish($_POST["total_eagle"], "eagles should be an integer value, you filled in %s");
    Assert::integerish($_POST["total_birdie"], "Birdies should be an integer value, you filled in %s");
    Assert::integerish($_POST["total_bogey"], "Bogeys should be an integer value, you filled in %s");
    Assert::integerish($_POST["total_drive"], "Drive Distance should be an integer value, you filled in %s");
} catch (InvalidArgumentException $e) {
    die($e->getMessage());
}

$player_id = $_SESSION["u_id"];
$event_id = $_POST["game"];
$score = (int) $_POST["total_score"];
$par = (int) $_POST["total_par"];
$eagle = (int) $_POST["total_eagle"];
$birdie = (int) $_POST["total_birdie"];
$bogey = (int) $_POST["total_bogey"];
$drives = (int) $_POST["total_drive"];
$distance = round($_POST["total_distance"], 2);
$position = 0;

$average = round($score / 18, 2);
$under_par = $eagle + $birdie;

$sql = "INSERT INTO playereventstats VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "isdiidiiiii", $player_id, $event_id, $average, $birdie, $bogey,
                       $distance, $drives, $eagle, $under_par, $score, $position);
mysqli_stmt_execute($stmt);

$sql = "SELECT player_id, RANK() OVER (PARTITION BY event_id ORDER BY points) currRank FROM playereventstats WHERE event_id = ?;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "s", $event_id);
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);

for ($i = 0; $i < $resultData->num_rows; $i++) {
    $row = mysqli_fetch_assoc($resultData);

    $id = $row["player_id"];
    $rank = $row["currRank"];

    $sql1 = "UPDATE playereventstats SET position = " . $rank . " WHERE player_id = ". $id . " AND event_id = '" . $event_id . "';";
    $conn->query($sql1);
}

$conn->close();
header("location: ../../pages/profile.php");