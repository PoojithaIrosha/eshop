<?php

session_start();
require "connection.php";

$receiver_email = $_SESSION["u"]["email"];
$sender_email = $_GET["email"];

$message_rs = Database::search("SELECT * FROM `message` WHERE `from`='" . $sender_email . "' OR `to` = '" . $sender_email . "'");
$message_num = $message_rs->num_rows;

for ($x = 0; $x < $message_num; $x++) {
    $message_data = $message_rs->fetch_assoc();

    if ($message_data["to"] == $sender_email & $message_data["from"] == $receiver_email) {
?>
        <!-- Sender's Message -->
        <div class="mb-3 w-50">
            <div>
                <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="mb-0"><?php echo $message_data["content"]; ?></p>
                </div>
                <p class="small text-black-50 text-end"><?php echo $message_data["date_time"]; ?></p>
                <p class="invisible"></p>
            </div>
        </div>
        <!-- Sender's Message -->

    <?php
    } else if ($message_data["to"] == $receiver_email & $message_data["from"] == $sender_email) {
    ?>
        <!-- Receiver's Message -->
        <div class="mb-3 w-50">

            <img src="resources/profiles/6229da2a06f41.png" width="50px" class="rounded-circle mb-1" alt="">

            <div>
                <div class="bg-white rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-black"><?php echo $message_data["content"]; ?></p>
                </div>
                <p class="small text-black-50 text-end"><?php echo $message_data["date_time"]; ?></p>
                <p class="invisible" id="rmail"><?php echo $message_data["from"]; ?></p>
            </div>
        </div>
        <!-- Receiver's Message -->

<?php
    }

    Database::iud("UPDATE `message` SET `status`='1' WHERE `from` = '" . $sender_email . "' AND `to` = '" . $receiver_email . "'");
}
