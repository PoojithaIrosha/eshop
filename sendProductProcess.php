<?php

require "connection.php";
session_start();

$umail = $_SESSION["u"]["email"];
$pid = $_GET["id"];

$product = Database::search("SELECT * FROM product WHERE `user_email`='" . $umail . "' AND `id`='" . $pid . "'");
$n = $product->num_rows;

if ($n == 1) {
    $row = $product->fetch_assoc();
    $_SESSION["p"] = $row;
    echo "success";
} else {
    echo "error";
}
