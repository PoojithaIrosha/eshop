<!DOCTYPE html>
<html>

<head>
    <!-- Title -->
    <title>eShop</title>

    <!-- Required meta tags for bootstrap-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <!-- Website Icon -->
    <link rel="icon" href="resources/logo.svg" />

    <!-- CSS -->
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="main-body">

    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <!-- header -->

            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome to eShop</p>
                    </div>
                </div>
            </div>

            <!-- header end -->
            <!-- content -->

            <div class="col-12 p-3">
                <div class="row">
                    <!-- Background Image -->
                    <div class="col-6 d-none d-lg-block background"></div>

                    <!-- Sign Up Form -->
                    <div class="col-12 col-lg-6 d-none" id="signUpBox">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="title02">Create New Account</p>
                                <span class="text-danger" id="msg"></span>
                            </div>
                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input class="form-control" type="text" id="fname" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" type="text" id="lname" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" id="email" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" id="password" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input class="form-control" type="text" id="mobile" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="gender">

                                    <?php
                                    require "connection.php";

                                    $r = Database::search("SELECT * FROM `gender`");
                                    $n = $r->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $row = $r->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                    <?php
                                    }

                                    ?>

                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button onclick="signUp();" class="btn btn-primary">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button onclick="changeView();" class="btn btn-dark">Already have an account? Sign In</button>
                            </div>
                        </div>
                    </div>
                    <!-- Sign Up Form end -->

                    <!-- Sign In Form -->
                    <div class="col-12 col-lg-6 " id="signInBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Sign into your Account</p>
                                <span class="text-danger" id="msg2"></span>
                            </div>

                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" id="email2" value="<?php echo $email; ?>" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" id="password2" value="<?php echo $password; ?>" />
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="1" id="rememberMe" />
                                    <label for="rememberMe" class="form-check-label lbl1">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <a class="link-primary " href="#" onclick="forgotpassword();">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid ">
                                <button onclick="signIn();" class="btn btn-primary">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button onclick="changeView();" class="btn btn-danger">New to eShop? Join Now</button>
                            </div>
                        </div>
                    </div>
                    <!-- Sign In Form end -->
                </div>

                <!-- content end -->

                <!-- footer -->

                <div class="col-12 d-none d-lg-block fixed-bottom">
                    <p class="text-center">&copy; 2021 eShop.lk All Rights Reserved</p>
                </div>

                <!-- footer end -->
                <!-- modal -->
                <div class="modal" tabindex="-1" id="forgotPasswordModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reset Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="np" />
                                            <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();">Show</button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Re-Type Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="rnp" />
                                            <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();">Show</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Verification Code</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="vc" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal end -->
            </div>
        </div>

        <!-- Javascript -->
        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
</body>

</html>