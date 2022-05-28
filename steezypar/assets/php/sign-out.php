<?php
session_start();

if (isset($_SESSION["u_id"])) {
    session_unset();
    session_destroy();
    header("location: ../../index.php");
    exit();
}
