<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <!-- Title -->
        <title>eShop | User Profile</title>

        <!-- Required meta tags for bootstrap-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <!-- Website Icon -->
        <link rel="icon" href="resources/logo.svg" />

        <!-- CSS -->
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="bg-primary">

        <div class="container-fluid bg-light rounded mt-4 mb-4">
            <div class="row">

                <!-- Modal For Confirmation -->
                <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to update the user profile?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-primary" onclick="updateProfile();" data-dismiss="modal">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 1 - Profile Image -->
                <div class="col-md-3 border-end">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                        <?php

                        $profileImg = Database::search("SELECT * FROM profile_img WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                        $pn = $profileImg->num_rows;

                        if ($pn == 1) {
                            $p = $profileImg->fetch_assoc();
                        ?>
                            <img id="prev0" class="rounded mt-5" style="width: 150px;" src="<?php echo $p["code"]; ?>" />
                        <?php
                        } else {
                        ?>
                            <img id="prev0" class="rounded mt-5" style="width: 150px;" src="resources/profiles/profile_img_02.jpg" />
                        <?php
                        }
                        ?>
                        <span class="fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                        <span class="text-black-50"><?php echo $_SESSION["u"]["email"]; ?></span>
                        <input type="file" class="d-none" id="profileimg" accept="img/*" />
                        <label class="btn btn-primary mt-3" for="profileimg" onclick="changeImage();">Update Profile Image</label>
                    </div>
                </div>

                <!-- Section 2 - User Details -->
                <div class="col-md-5 border-end">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Profile Settings</h4>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input id="fname" type="text" class="form-control" placeholder="First Name" value="<?php echo $_SESSION["u"]["fname"]; ?>" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input id="lname" type="text" class="form-control" placeholder="Last Name" value="<?php echo $_SESSION["u"]["lname"]; ?>" />
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mobile No.</label>
                                <input id="mobile" type="text" class="form-control" placeholder=" Enter your mobile number" value="<?php echo $_SESSION["u"]["mobile"]; ?>" />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input readonly type="password" class="form-control" placeholder="Enter your password" value="<?php echo $_SESSION["u"]["password"]; ?>" />
                                    <button class="btn btn-outline-secondary" type="button"><i class="bi bi-eye-fill"></i></button>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email Address</label>
                                <input readonly type="email" class="form-control" placeholder="Enter your email address" value="<?php echo $_SESSION["u"]["email"]; ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Registered Date</label>
                                <input readonly type="text" class="form-control" placeholder="Enter your registered date" value="<?php echo $_SESSION["u"]["register_date"]; ?>" />
                            </div>

                            <?php
                            $usermail = $_SESSION["u"]["email"];
                            $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $usermail . "'");
                            $n = $address->num_rows;

                            if ($n > 0) {
                                $d = $address->fetch_assoc();

                                $city = Database::search("SELECT * FROM city WHERE `id`='" . $d["city_id"] . "'");
                                $cf = $city->fetch_assoc();

                                $district = Database::search("SELECT * FROM district WHERE `id`='" . $cf["district_id"] . "'");
                                $df = $district->fetch_assoc();

                                $province = Database::search("SELECT * FROM province WHERE `id`='" . $df["province_id"] . "'");
                                $pf = $province->fetch_assoc();

                            ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 01</label>
                                    <input id="addline1" type="text" class="form-control" placeholder="Address line 01" value="<?php echo $d["line1"]; ?>" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 02</label>
                                    <input id="addline2" type="text" class="form-control" placeholder="Address line 02" value="<?php echo $d["line2"]; ?>" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Province</label>
                                    <select class="form-select">
                                        <option value="<?php echo $pf["id"]; ?>"><?php echo $pf["name"]; ?></option>
                                        <?php
                                        $pall = Database::search("SELECT * FROM province WHERE `name`!='" . $pf["name"] . "'");
                                        $num1 = $pall->num_rows;
                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $row1['id'] ?>"><?php echo $row1['name'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">District</label>
                                    <select class="form-select">
                                        <option value="<?php echo $df["id"]; ?>"><?php echo $df["name"]; ?></option>
                                        <?php
                                        $dall = Database::search("SELECT * FROM district WHERE `name`!= '" . $df["name"] . "'");
                                        $num2 = $dall->num_rows;
                                        for ($x = 1; $x <= $num2; $x++) {
                                            $row2 = $dall->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $row2['id'] ?>"><?php echo $row2['name'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <select id="usercity" class="form-select">
                                        <option value="<?php echo $cf["id"]; ?>"><?php echo $cf["name"]; ?></option>
                                        <?php
                                        $call = Database::search("SELECT * FROM city WHERE `name`!= '" . $cf["name"] . "'");
                                        $num3 = $call->num_rows;
                                        for ($x = 1; $x <= $num3; $x++) {
                                            $row3 = $call->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $row3['id'] ?>"><?php echo $row3['name'] ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" placeholder="Postal code" value="<?php echo $cf["postal_code"]; ?>" />
                                </div>
                            <?php

                            } else {
                            ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 01</label>
                                    <input id="addline1" type="text" class="form-control" placeholder="Address line 01" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 02</label>
                                    <input id="addline2" type="text" class="form-control" placeholder="Address line 02" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Province</label>
                                    <select class="form-select">
                                        <option value="">Select Your Province</option>
                                        <?php
                                        $pall = Database::search("SELECT * FROM province");
                                        $num1 = $pall->num_rows;
                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $row1['id'] ?>"><?php echo $row1['name'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">District</label>
                                    <select class="form-select">
                                        <option value="">Select Your District</option>
                                        <?php
                                        $dall = Database::search("SELECT * FROM district");
                                        $num2 = $dall->num_rows;
                                        for ($x = 1; $x <= $num2; $x++) {
                                            $row2 = $dall->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $row2['id'] ?>"><?php echo $row2['name'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <select id="usercity" class="form-select">
                                        <option value="">Select Your City</option>
                                        <?php
                                        $call = Database::search("SELECT * FROM city");
                                        $num3 = $call->num_rows;
                                        for ($x = 1; $x <= $num3; $x++) {
                                            $row3 = $call->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $row3['id'] ?>"><?php echo $row3['name'] ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" placeholder="Postal code" />
                                </div>

                            <?php
                            }
                            ?>

                            <?php

                            $gender = Database::search("SELECT * FROM `gender` WHERE `id`='" . $_SESSION["u"]["gender"] . "'");
                            $gf = $gender->fetch_assoc();
                            ?>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" placeholder="gender" readonly value="<?php echo $gf["name"]; ?>">
                            </div>

                            <div class="mt-3 text-center">
                                <button onclick="showConfirmModal();" class="btn btn-primary">Update Profile</button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Section 3 - User Ratings -->
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="col-md-12">
                            <span class="header">User Rating</span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <p>4.1 average based on 254 reviews</p>
                            <hr class="hr-break-1" />
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <!-- progressbar 01 -->
                                <div class="col-12 side ">
                                    <span>5 Star</span>
                                </div>

                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>150</span>
                                </div>
                                <!-- progressbar 01 end -->

                                <!-- progressbar 02 -->
                                <div class="col-12 side ">
                                    <span>4 Star</span>
                                </div>

                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>63</span>
                                </div>
                                <!-- progressbar 02 end -->

                                <!-- progressbar 03 -->
                                <div class="col-12 side ">
                                    <span>3 Star</span>
                                </div>

                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>15</span>
                                </div>
                                <!-- progressbar 03 end -->

                                <!-- progressbar 04 -->
                                <div class="col-12 side ">
                                    <span>2 Star</span>
                                </div>

                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 5%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>6</span>
                                </div>
                                <!-- progressbar 04 end -->

                                <!-- progressbar 05 -->
                                <div class="col-12 side ">
                                    <span>1 Star</span>
                                </div>

                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>20</span>
                                </div>
                                <!-- progressbar 05 end -->
                            </div>
                        </div>

                    </div>

                </div>

                <?php
                require "footer.php";
                ?>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </body>

    </html>


<?php

} else {

?>
    <script>
        alert("You have to sign in or sign up first.")
        window.location = "signInSignUp.php";
    </script>
<?php

}

?>