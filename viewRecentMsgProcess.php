<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    $allMsgrs = Database::search("SELECT DISTINCT * FROM `message`");

    $allMsgNum = $allMsgrs->num_rows;

    for ($x = 0; $x < $allMsgNum; $x++) {
        $allMsgData = $allMsgrs->fetch_assoc();

        if ($allMsgData["to"] == $user_email) {
            $query1 = "WHERE `from` ='" . $allMsgData["from"] . "'";
            $a = Database::search("SELECT DISTINCT * FROM `message`" + $query1);

            $n = $a->num_rows;

            for ($y = 0; $y < $n; $y++) {
                $a->fetch_assoc();
            }
        } else {
            echo $allMsgData["to"];
        }
    }
} else {
    echo "Please login to your account first.";
}
