<?php

require "connection.php";

session_start();

if (isset($_SESSION["u"])) {
    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $addline1 = $_POST["a1"];
    $addline2 = $_POST["a2"];
    $city = $_POST["c"];
    $img = $_FILES["i"];

    if (empty($fname)) {
        echo "Please enter your first name";
    } else if (empty($lname)) {
        echo "Please enter your last name";
    } else if (empty($mobile)) {
        echo "Please enter your mobile number";
    } else if (empty($mobile)) {
        echo "Please enter your mobile number.";
    } else if (strlen($mobile) != 10) {
        echo "Mobile number should contain 10 characters.";
    } else if (preg_match("/07[0,1,2,4,5,6,7,8,][0-9]{7}+/", $mobile) == 0) {
        echo "Invalid Mobile Number.";
    } else {


        if (isset($img)) {
            $allowed_image_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg");
            $fileex = $img["type"];
            // echo $fileex;

            if (!in_array($fileex, $allowed_image_extensions)) {
                echo "Please Select a Valid Image.";
            } else {
                $newimageextension;

                if ($fileex == "image/jpg") {
                    $newimageextension = '.jpg';
                } else if ($fileex == "image/jpeg") {
                    $newimageextension = '.jpeg';
                } else if ($fileex == "image/png") {
                    $newimageextension = ".png";
                } else if ($fileex == "image/svg") {
                    $newimageextension = ".svg";
                }

                $file_name = "resources/profiles/" . uniqid() . $newimageextension;
                move_uploaded_file($img["tmp_name"], $file_name);

                $profilers = Database::search("SELECT * FROM profile_img WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                $in = $profilers->num_rows;


                if ($in == 1) {
                    // Update
                    Database::iud("UPDATE profile_img SET `code`='" . $file_name . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                    echo "New Profile Image Updated Successfully ";
                } else {
                    // Insert
                    Database::iud("INSERT INTO profile_img(`code`, `user_email`) VALUES('" . $file_name . "', '" . $_SESSION["u"]["email"] . "')");
                    echo "New Profile Image Saved Successfully ";
                }
            }
        }

        Database::iud("UPDATE user SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' WHERE `email`='" . $_SESSION["u"]["email"] . "'");


        $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
        $nrs = $addressrs->num_rows;

        if ($nrs == 1) {
            // UPDATE
            Database::iud("UPDATE `user_has_address` SET `line1`='" . $addline1 . "',`line2`='" . $addline2 . "',`city_id`='" . $city . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
        } else {
            // INSERT (save)
            Database::iud("INSERT INTO `user_has_address`(`user_email`,`line1`, `line2`, `city_id`) VALUES ('" . $_SESSION["u"]["email"] . "','" . $addline1 . "', '" . $addline2 . "','" . $city . "')");
        }

        echo "User has been updated.";
    }
} else {
    echo "error";
}
