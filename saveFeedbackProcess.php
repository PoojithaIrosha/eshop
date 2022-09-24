<?php

require 'connection.php';

$pid = $_POST["pid"];
$type = $_POST["type"];
$feedback = $_POST["feedback"];
$email = $_POST["email"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format('Y-m-d H:i:s');

Database::iud("INSERT INTO `feedback`(`user_email`,`product_id`,`feed`,`date`,`type`) VALUES ('" . $email . "', '" . $pid . "', '" . $feedback . "', '" . $date . "', '" . $type . "')");

echo "success";
