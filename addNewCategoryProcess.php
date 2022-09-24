<?php

require "connection.php";

// PHPMailer
require "SMTP.php";
require "Exception.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["n"]) && isset($_POST["e"])) {
    $new_category = $_POST["n"];
    $user_email = $_POST["e"];

    $category_rs = Database::search("SELECT * FROM `category` WHERE `name`='" . $new_category . "'");
    if ($category_rs->num_rows == 0) {
        $code = uniqid();
        Database::iud("UPDATE `admin` SET `verification_code`='" . $code . "' WHERE `email` = '" . $user_email . "'");

        // email code
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'andruehudson9311@gmail.com'; // Sender's Email Address
        $mail->Password = 'tinpmrbqbcedjmme'; // Sender's Email Password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('andruehudson9311@gmail.com', 'eShop');
        $mail->addReplyTo('andruehudson9311@gmail.com', 'eShop');
        $mail->addAddress($user_email); // Receiver's Email Address
        $mail->isHTML(true);
        $mail->Subject = 'Add Category Verification';
        $bodyContent = '<h1>Your verification code is :<span style="color: green;"> ' . $code . '</span></h1>';
        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo "Verification code sending failed";
        } else {
            echo "success";
        }
    } else {
        echo "This category already exists";
    }
}
