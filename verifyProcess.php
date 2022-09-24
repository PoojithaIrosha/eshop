<?php

session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $id =  $_GET["id"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `verification_code`='" . $id . "'");

    if ($admin_rs->num_rows == 1) {
        $admin_data = $admin_rs->fetch_assoc();
        $_SESSION["a"] = $admin_data;

        echo "Success";
    } else {
        echo "Verification Code Invalid";
    }
} else {
    echo "Please enter your verification code.";
}
