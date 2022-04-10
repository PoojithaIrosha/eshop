<?php
// connection class
require "connection.php";

// PHPMailer
require "SMTP.php";
require "Exception.php";
require "PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {
    $email = $_GET["e"];

    if (empty($email)) {
        echo "Please enter a valid Email.";
    } else {
        $rs = Database::search("SELECT * FROM user WHERE `email`='" . $email . "'");

        if ($rs->num_rows == 1) {
            $code = uniqid();
            Database::iud("UPDATE user SET `verification_code`='" . $code . "' WHERE `email` = '" . $email . "'");

            // email code
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'andruehudson9311@gmail.com'; // Sender's Email Address
            $mail->Password = '!h~DHuq/$9311'; // Sender's Email Password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('andruehudson9311@gmail.com', 'eShop');
            $mail->addReplyTo('andruehudson9311@gmail.com', 'eShop');
            $mail->addAddress($email); // Receiver's Email Address
            $mail->isHTML(true);
            $mail->Subject = 'eShop Forgot Password Verification Code.';
            $bodyContent = '<h1>Your verification code is :<span style="color: green;"> ' . $code . '</span></h1>';
            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                echo "Verification code sending failed";
            } else {
                echo "success";
            }
        } else {
            echo "Email Address not found.";
        }
    }
} else {
    echo "Please enter your Email Address.";
}
