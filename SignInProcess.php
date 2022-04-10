<?php

session_start();

require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["rememberMe"];

// Search for user
$resultset = Database::search("SELECT * FROM user WHERE `email`= '" . $email . "' AND `password` = '" . $password . "'");
$n = $resultset->num_rows;

// If user details are correct.
if ($n == 1) {
    echo "success";
    $d = $resultset->fetch_assoc();
    $_SESSION["u"] = $d;

    if ($rememberMe == "true") {
        setcookie("email", $email, time() + (60 * 60 * 24 * 365));
        setcookie("password", $password, time() + (60 * 60 * 24 * 365));
    } else {
        setcookie("email", "", -1);
        setcookie("password", "", -1);
    }
} else { // If user details are incorrect.
    echo "Invalid Username or Password.";
}
