<?php

session_start();
require "connection.php";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["co"];
$color = $_POST["col"];
$qty = $_POST["qty"];
$price = $_POST["p"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$description = $_POST["desc"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;
$usermail = $_SESSION["u"]["email"];

if ($category == "0") {
    echo "Please select a category.";
} else if ($brand == "0") {
    echo "Please select a brand.";
} else if ($model == "0") {
    echo "Please select a model.";
} else if (empty($title)) {
    echo "Please add a title to your product.";
} else if (strlen($title) > 100) {
    echo "Please enter a title contains 100 characters or lower.";
} else if (empty($qty)) {
    echo "Quantity field must not be empty.";
} else if ($qty == "0" || $qty == "e" || $qty < 0) {
    echo "Please enter a valid quantity.";
} else if (empty($price)) {
    echo "Please enter a price for your product.";
} else if (is_int($price)) {
    echo "Please enter a valid price.";
} else if (empty($dwc)) {
    echo "Please enter the delivery cost inside Colombo.";
} else if (is_int($dwc)) {
    echo "Please enter a valid price for delivery cost inside Colombo.";
} else if (empty($doc)) {
    echo "Please enter the delivery cost outside Colombo.";
} else if (is_int($doc)) {
    echo "Please enter a valid price for delivery cost outside Colombo.";
} else if (empty($description)) {
    echo "Please enter a description to your product.";
} else {

    $modelHasBrand = Database::search("SELECT `id` FROM model_has_brand WHERE `brand_id`='" . $brand . "' AND `model_id`='" . $model . "'");
    if ($modelHasBrand->num_rows == 0) {
        echo "This product does not exists.";
    } else {
        $f = $modelHasBrand->fetch_assoc();
        $modelHadBrandId = $f["id"];

        Database::iud("INSERT INTO `product`(`category`, `model_has_brand`, `colour_id`, `price`, `qty`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES ('" . $category . "','" . $modelHadBrandId . "','" . $color . "','" . $price . "','" . $qty . "','" . $description . "','" . $title . "','" . $condition . "','" . $status . "','" . $usermail . "','" . $date . "','" . $dwc . "','" . $doc . "')");


        $last_id = Database::$connection->insert_id;

        $allowed_image_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg", "image/jfif");

        if (isset($_FILES["img1"])) {
            $image1 = $_FILES["img1"];

            if (isset($image1)) {
                $file_extension = $image1["type"];
                if (in_array($file_extension, $allowed_image_extensions)) {
                    $fileName = "resources//products//" . uniqid() . $image1["name"];
                    move_uploaded_file($image1["tmp_name"], $fileName);

                    Database::iud("INSERT INTO images(`code`, `product_id`) VALUES ('" . $fileName . "', '" . $last_id . "')");
                } else {
                    echo "Please select a valid image.";
                }
            }
        }

        if (isset($_FILES["img2"])) {
            $image2 = $_FILES["img2"];

            if (isset($image2)) {
                $file_extension = $image2["type"];
                if (in_array($file_extension, $allowed_image_extensions)) {
                    $fileName = "resources//products//" . uniqid() . $image2["name"];
                    move_uploaded_file($image2["tmp_name"], $fileName);

                    Database::iud("INSERT INTO images(`code`, `product_id`) VALUES ('" . $fileName . "', '" . $last_id . "')");
                } else {
                    echo "Please select a valid image.";
                }
            }
        }

        if (isset($_FILES["img3"])) {
            $image3 = $_FILES["img3"];

            if (isset($image3)) {
                $file_extension = $image3["type"];
                if (in_array($file_extension, $allowed_image_extensions)) {
                    $fileName = "resources//products//" . uniqid() . $image3["name"];
                    move_uploaded_file($image3["tmp_name"], $fileName);

                    Database::iud("INSERT INTO images(`code`, `product_id`) VALUES ('" . $fileName . "', '" . $last_id . "')");
                } else {
                    echo "Please select a valid image.";
                }
            }
        }
    }

    echo "success";
}
