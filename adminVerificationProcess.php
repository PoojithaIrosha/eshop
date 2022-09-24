<?php

// connection class
require "connection.php";

// PHPMailer
require "SMTP.php";
require "Exception.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["e"])) {
    $email = $_POST["e"];

    if (empty($email)) {
        echo "Please enter your email address";
    } else {
        $adminrs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
        $an = $adminrs->num_rows;

        if ($an == 1) {
            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

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
            $mail->addAddress($email); // Receiver's Email Address
            $mail->isHTML(true);
            $mail->Subject = 'Admin Verification Code';
            $bodyContent = '<h1>Your verification code is :<b style="color: green;"> ' . $code . '</b></h1>';
            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                echo "Decline email sending failed";
            } else {
                echo "success";
            }
        } else {
            echo "You are not a valid user";
        }
    }
}
