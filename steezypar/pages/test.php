<?php
    $db_host = "localhost";
    $db_user = "admin";
    $db_pass = "";
    $db_name = "steezypar";
    $db_port = "3306";

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

    if ($conn) {
        echo "Connection to database was a success.";
    } else {
        echo "Connection to database was not a success";
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    echo $email . " -&- " . $password;

    //header("location:../index.php");
?>