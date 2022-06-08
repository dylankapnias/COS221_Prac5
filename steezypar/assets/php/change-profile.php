<?php
session_start();

require_once 'util/db-conn.php';
require __DIR__ . '/../../vendor/autoload.php';
use Webmozart\Assert\Assert;

if (isset($_POST["cancel_change"])) {
    header("location: ../../pages/profile.php");
    exit();
}

if (!isset($_POST["change_profile"])) {
    die("Please enter this page appropriately");
}

$amount = 0;

$name = $_POST["name_change"];
if ($name != '') {
    $amount++;
}

$username = $_POST["username_change"];
if ($username != '') {
    $amount++;
}

$email= $_POST["email_change"];
if ($email != '') {
    $amount++;
}

$bio = $_POST["bio_change"];
if ($bio != '') {
    $amount++;
}

try {
    Assert::greaterThan($amount, 0, "Please fill at least one field, you filled in %s");
} catch (InvalidArgumentException $e) {
    die($e->getMessage());
}

$amount--;


$rel = array("name", "username", "email", "bio");
$index = 0;
$count = 0;
$total = count($rel) - 1;

$insert = "UPDATE playercredentials SET ";

if ($name != '') {
    $insert .= $rel[$index] . " = '" . $name . "'";
    if ($count != $amount && $index != $total) {
        $insert .= ", ";
    } else {
        $insert .= " WHERE ";
    }
    $count++;
}
$index++;

if ($username != '') {
    $insert .= $rel[$index] . " = '" . $username . "'";
    if ($count != $amount && $index != $total) {
        $insert .= ", ";
    } else {
        $insert .= " WHERE ";
    }
    $count++;
}
$index++;

if ($email != '') {
    try {
        Assert::email($email, "Email was inserted incorrectly, you gave this %s");
    } catch (InvalidArgumentException $e) {
        die($e->getMessage());
    }
    $insert .= $rel[$index] . " = '" . $email . "'";
    if ($count != $amount && $index != $total) {
        $insert .= ", ";
    } else {
        $insert .= " WHERE ";
    }
    $count++;
}
$index++;

if ($bio != '') {
    $insert .= $rel[$index] . " = '" . $bio . "'";
    if ($count != $amount && $index != $total) {
        $insert .= ", ";
    } else {
        $insert .= " WHERE ";
    }
    $count++;
}
$index++;

$sql = $insert . "player_id = " . $_SESSION["u_id"];
//echo $sql;
$ret = $conn->query($sql);

header("location: ../../pages/profile.php");