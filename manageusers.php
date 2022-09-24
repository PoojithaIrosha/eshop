<?php
require "connection.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eShop | Admin | Manage Users</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%, #9FACE6 100%)">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center p-2">
                <h2 class="text-primary fw-bold">Manage All Users</h2>
            </div>



            <div class="col-12 mt-3">
                <div class="row">

                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">

                            <div class="col-9">
                                <input type="text" class="form-control" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning">Search User</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">

                    <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>
                    <div class="col-4 col-lg-2 bg-primary py-2">
                        <span class="fs-4 fw-bold text-white">Username</span>
                    </div>
                    <div class="col-4 col-lg-2 bg-light py-2">
                        <span class="fs-4 fw-bold">Email</span>
                    </div>
                    <div class="col-2 bg-primary py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-2 col-lg-1 bg-white py-2">

                    </div>

                </div>
            </div>


            <?php

            $page_no;

            if (isset($_GET["page"])) {
                $page_no = $_GET["page"];
            } else {
                $page_no = 1;
            }

            $user_rs = Database::search("SELECT * FROM `user`");
            $user_num =  $user_rs->num_rows;

            $results_per_page = 10;
            $number_of_pages = ceil($user_num / $results_per_page);
            $viewed_result_count = ((int)$page_no - 1) * $results_per_page;
            $view_user_rs = Database::search("SELECT * FROM `user` LIMIT " . $results_per_page . " OFFSET " . $viewed_result_count);
            $view_user_num = $view_user_rs->num_rows;

            while ($view_user_data = $view_user_rs->fetch_assoc()) {

            ?>
                <div class="col-12 my-3">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                            <span class="fs-6 fw-bold text-white"><?php echo $view_user_data["id"]; ?></span>
                        </div>
                        <?php
                        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $view_user_data["email"] . "'");

                        $imgCode = "resources/profiles/6229da2a06f41.png";
                        if ($image_rs->num_rows == 1) {
                            $image_data = $image_rs->fetch_assoc();
                            $imgCode = $image_data["code"];
                        }
                        ?>
                        <div class="col-2 bg-light py-2 d-none d-lg-block text-center" onclick="viewMsgModal('<?php echo $view_user_data['email']; ?>');">
                            <img src="<?php echo $imgCode; ?>" class="img-fluid" style="height: 40px;">
                        </div>
                        <div class="col-4 col-lg-2 bg-primary py-2">
                            <span class="fs-6 fw-bold text-white"><?php echo $view_user_data["fname"] . " " . $view_user_data["lname"]; ?></span>
                        </div>
                        <div class="col-4 col-lg-2 bg-light py-2">
                            <span class="fs-6 fw-bold"><?php echo $view_user_data["email"]; ?></span>
                        </div>
                        <div class="col-2 bg-primary py-2 d-none d-lg-block">
                            <span class="fs-6 fw-bold text-white"><?php echo $view_user_data["mobile"]; ?></span>
                        </div>
                        <div class="col-2 bg-light py-2 d-none d-lg-block">
                            <?php
                            $register_datetime = explode(" ", $view_user_data["register_date"]);
                            $register_date = $register_datetime[0];
                            ?>
                            <span class="fs-6 fw-bold"><?php echo $register_date; ?></span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white py-2 d-grid">
                            <?php

                            $s = $view_user_data["status_id"];

                            if ($s == "1") {
                            ?>
                                <button class="btn btn-danger" onclick="blockUser('<?php echo $view_user_data['email']; ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-warning" onclick="blockUser('<?php echo $view_user_data['email']; ?>');">Unblock</button>
                            <?php
                            }

                            ?>
                        </div>

                    </div>
                </div>


                <!-- modal -->

                <div class="modal fade" tabindex="-1" id="viewMsgModal<?php echo $view_user_data["email"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">My Messages <?php echo $view_user_data["email"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Received -->

                                <div class="col-12 mt-2">
                                    <div class="row">

                                        <div class="col-8 rounded bg-success">
                                            <div class="row">

                                                <div class="col-12 pt-2">
                                                    <span class="text-white fs-4">Hello there!!</span>
                                                </div>
                                                <div class="col-12 text-end pb-2">
                                                    <span class="fs-6 text-white">2022-06-11 | 08:00:00</span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Received -->

                                <!-- Sent -->

                                <div class="col-12 mt-2">
                                    <div class="row">

                                        <div class="offset-4 col-8 rounded bg-primary">
                                            <div class="row">

                                                <div class="col-12 pt-2">
                                                    <span class="text-white fs-4">How are you ?</span>
                                                </div>
                                                <div class="col-12 text-end pb-2">
                                                    <span class="fs-6 text-white">2022-06-11 | 08:15:00</span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Sent -->
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-8">
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-4 d-grid">
                                            <button class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal -->

            <?php

            }
            ?>





            <!-- Pagination -->
            <div class="col-12 text-center">
                <div class="pagination">
                    <a href="<?php if ($page_no <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no - 1);
                                } ?>">&laquo;</a>

                    <?php

                    for ($page = 1; $page <= $number_of_pages; $page++) {

                        if ($page == $page_no) {
                    ?>
                            <a href="<?php echo "?page=" . ($page); ?>" class="active"><?php echo $page; ?></a>
                        <?php
                        } else {
                        ?>
                            <a href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                    <?php
                        }
                    }

                    ?>
                    <a href="<?php if ($page_no >= $number_of_pages) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no + 1);
                                } ?>">&raquo;</a>
                </div>
            </div>
            <!-- Pagination -->

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>