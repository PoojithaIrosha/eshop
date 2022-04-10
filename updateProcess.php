<?php

require "connection.php";
session_start();

$t = $_POST["t"];
$qty = $_POST["qty"];
$c = $_POST["c"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];

$productid = $_SESSION["p"]["id"];

if (empty($t)) {
    echo "Please add a title to your product.";
} else if (strlen($t) > 100) {
    echo "Please enter a title contains 100 characters or lower.";
} else if (empty($qty)) {
    echo "Quantity field must not be empty.";
} else if ($qty == "0" || $qty == "e" || $qty < 0) {
    echo "Please enter a valid quantity.";
} else if (empty($c)) {
    echo "Please enter a price for your product.";
} else if (is_int($c)) {
    echo "Please enter a valid price.";
} else if (empty($dwc)) {
    echo "Please enter the delivery cost inside Colombo.";
} else if (is_int($dwc)) {
    echo "Please enter a valid price for delivery cost inside Colombo.";
} else if (empty($doc)) {
    echo "Please enter the delivery cost outside Colombo.";
} else if (is_int($doc)) {
    echo "Please enter a valid price for delivery cost outside Colombo.";
} else if (empty($desc)) {
    echo "Please enter a description to your product.";
} else {

    Database::iud("UPDATE `product` SET `title` = '" . $t . "', `qty`='" . $qty . "',`price`='" . $c . "', `delivery_fee_colombo`='" . $dwc . "', `delivery_fee_other`='" . $doc . "', `description`='" . $desc . "' WHERE `id`='" . $productid . "'");
    echo "Product updated successfully";

    $last_id = Database::$connection->insert_id;
    $allowed_image_extensions = array("image/jpg", "image/png", "image/jpeg", "image/svg", "image/jfif");

    if (isset($_FILES["i1"])) {


        Database::iud("DELETE FROM images WHERE `product_id` = '".$productid."'");

        $images = $_FILES["i1"];
        $file_extension = $images["type"];



        if (!in_array($file_extension, $allowed_image_extensions)) {
            echo "Please select an valid image file";
        } else {
            $fileName = "resources//products//" . uniqid() . $images["name"];
            move_uploaded_file($images["tmp_name"], $fileName);

            Database::iud("INSERT INTO `images` VALUES ('".$fileName."', '".$productid."')");
        }
    }

    if (isset($_FILES["i2"])) {
        $images = $_FILES["i2"];
        $file_extension = $images["type"];

        if (!in_array($file_extension, $allowed_image_extensions)) {
            echo "Please select an valid image file";
        } else {
            $fileName = "resources//products//" . uniqid() . $images["name"];
            move_uploaded_file($images["tmp_name"], $fileName);

            Database::iud("INSERT INTO `images` VALUES ('".$fileName."', '".$productid."')");
        }
    }

    if (isset($_FILES["i3"])) {
        $images = $_FILES["i3"];
        $file_extension = $images["type"];

        if (!in_array($file_extension, $allowed_image_extensions)) {
            echo "Please select an valid image file";
        } else {
            $fileName = "resources//products//" . uniqid() . $images["name"];
            move_uploaded_file($images["tmp_name"], $fileName);

            Database::iud("INSERT INTO `images` VALUES ('".$fileName."', '".$productid."')");
        }
    }
}
