<?php
require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

// Validating User Details
if (empty($fname)) {
    echo "Please enter your First Name.";
} else if (strlen($fname) > 50) {
    echo "First Name must be less than 50 characters.";
} else if (empty($lname)) {
    echo "Please enter your Last Name.";
} else if (strlen($lname) > 50) {
    echo "Last Name must be less than 50 characters.";
} else if (empty($email)) {
    echo "Please enter your Email Address.";
} else if (strlen($email) >= 100) {
    echo "Email must be less than 100 characters.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email Address.";
} else if (empty($password)) {
    echo "Please enter your password.";
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo "Password length should be between 5 to 20.";
} else if (empty($mobile)) {
    echo "Please enter your mobile number.";
} else if (strlen($mobile) != 10) {
    echo "Mobile number should contain 10 characters.";
} else if (preg_match("/07[0,1,2,4,5,6,7,8,][0-9]{7}+/", $mobile) == 0) {
    echo "Invalid Mobile Number.";
} else {

    // Searching for email and mobile
    $r = Database::search("SELECT * FROM user WHERE `email`='" . $email . "' OR `mobile` = '" . $mobile . "'");
    $n = $r->num_rows;
    if ($n > 0) {
        echo "User with the same email address or mobile number already exists.";
    } else {

        // Setting Up DateTime
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        // Inserting data into the database
        Database::iud("INSERT INTO user(`email`, `fname`, `lname`, `password`, `mobile`, `gender`, `register_date`) VALUES ('" . $email . "','" . $fname . "','" . $lname . "','" . $password . "','" . $mobile . "','" . $gender . "', '" . $date . "')");

        echo "success";
    }
}
