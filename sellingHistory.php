<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eShop | Admin | Selling History</title>

    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-light text-center mb-3">
                <label class="form-label fs-1 fw-bold text-primary">Selling History</label>
            </div>

            <div class="col-12 bg-white mt-3 mb-3">
                <div class="row">
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5"> Search by Invoice ID:</label>
                        <input type="text" class="form-control fs-5 " placeholder="Invoice number..." id="search" onkeyup="invoiveSearch();">
                    </div>
                    <div class="col-12 col-lg-2 mt-3 mb-3"> </div>
                    <div class=" col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5"> From Date</label>
                        <input type="date" class="form-control fs-5" id="from">
                    </div>

                    <div class=" col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5"> To Date</label>
                        <input type="date" class="form-control fs-5" id="to">
                    </div>
                    <div class="col-12 col-lg-1 mt-3 mb-3 d-grid">
                        <button class="btn btn-primary fs-5 fw-bold" onclick="findSelling();"> Find </button>
                    </div>
                    <div>

                    </div>



                </div>
            </div>



            <div class="col-12">
                <div class="row">

                    <div class="col-1 bg-secondary text-end">
                        <label class="form-label text-white fw-bold fs-5">Invoice ID</label>
                    </div>
                    <div class="col-3 bg-white text-end">
                        <label class="form-label text-black fw-bold fs-5">Product</label>
                    </div>
                    <div class="col-3 bg-secondary text-end">
                        <label class="form-label text-white fw-bold fs-5">Buyer</label>
                    </div>
                    <div class="col-2 bg-white text-end">
                        <label class="form-label text-black fw-bold fs-5">Amount</label>
                    </div>
                    <div class="col-1 bg-secondary text-end">
                        <label class="form-label text-white fw-bold fs-5">Quantity</label>
                    </div>
                    <div class="col-2 bg-white"></div>

                </div>
            </div>




            <?php
            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }
            $invoice_rs = Database::search("SELECT * FROM `invoice`");
            $invoice_num = $invoice_rs->num_rows;

            $result_per_page = 15;
            $number_of_pages = ceil($invoice_num / $result_per_page);

            $result_count = ((int)$pageno - 1) * $result_per_page;
            $results = Database::search("SELECT `invoice`.`id`,`invoice`.`status`,`product`.`title`,`user`.`fname`,
            `user`.`lname`,`invoice`.`total`,`invoice`.`qty` FROM `invoice` INNER JOIN `user` ON 
invoice.user_email = user.email INNER JOIN `product` ON 
invoice.product_id = product.id ORDER BY `invoice`.`id` DESC LIMIT " . $result_per_page . " OFFSET " . $result_count . " ");

            //    $result_num = $results->num_rows;
            ?>

            <div class="col-12">
                <div class="row" id="loadresult">

                    <?php
                    while ($result_data = $results->fetch_assoc()) {
                    ?>
                        <div class="col-12">
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-1 bg-secondary text-end">
                                            <label class="form-label text-white fw-bold fs-5"><?php echo $result_data["id"]     ?></label>
                                        </div>

                                        <div class="col-3 bg-white text-end">
                                            <label class="form-label text-black fw-bold fs-5"><?php echo $result_data["title"]     ?></label>
                                        </div>
                                        <div class="col-3 bg-secondary text-end">
                                            <label class="form-label text-white fw-bold fs-5"><?php echo $result_data["fname"] . " " . $result_data["lname"]     ?></label>
                                        </div>
                                        <div class="col-2 bg-white text-end">
                                            <label class="form-label text-black fw-bold fs-5">Rs.<?php echo $result_data["total"] ?>
                                                .00</label>
                                        </div>
                                        <div class="col-1 bg-secondary text-end">
                                            <label class="form-label text-white fw-bold fs-5"><?php echo $result_data["qty"]     ?></label>
                                        </div>
                                        <div class="col-2 bg-white d-grid ">


                                            <?php
                                            $x = $result_data["status"];

                                            if ($x == 0) {
                                            ?>

                                                <button class="btn btn-success mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $result_data['id']  ?>);" id="btn<?php echo $result_data['id']   ?>">Confirm Order</button>

                                            <?php
                                            } else if ($x == 1) {
                                            ?>

                                                <button class="btn btn-warning mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $result_data['id']  ?>);" id="btn<?php echo $result_data['id']   ?>">Paking</button>

                                            <?php
                                            } else if ($x == 2) {
                                            ?>

                                                <button class="btn btn-info mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $result_data['id']  ?>);" id="btn<?php echo $result_data['id']   ?>">Dispatch</button>

                                            <?php
                                            } else  if ($x == 3) {
                                            ?>

                                                <button class="btn btn-primary mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $result_data['id']  ?>);" id="btn<?php echo $result_data['id']   ?>">Shipping</button>

                                            <?php
                                            } else if ($x == 4) {
                                            ?>

                                                <button class="btn btn-danger mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $result_data['id']  ?>);" id="btn<?php echo $result_data['id']   ?>" disabled>Delivered</button>

                                            <?php
                                            }

                                            ?>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>



                    <?php



                    }


                    ?>
                </div>
            </div>








            <!--paddination-->
            <div class="text-center col-12 mt-3 mb-3 offset-lg-4 col-lg-4 d-flex justify-content-center">
                <div class="pagination">
                    <a href="<?php if ($pageno <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($pageno - 1);
                                }
                                ?>">&laquo;</a>

                    <?php
                    for ($page = 1; $page <= $number_of_pages; $page++) {

                        if ($page == $pageno) {
                    ?>
                            <a href="<?php echo "?page=" . ($page);  ?>" class="active"><?php echo $page  ?></a>
                        <?php
                        } else {
                        ?>
                            <a href="<?php echo "?page=" . ($page);  ?>"><?php echo $page  ?></a>

                    <?php

                        }
                    }
                    ?>

                    <a href="<?php if ($pageno >= $number_of_pages) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($pageno + 1);
                                }

                                ?>">&raquo;</a>
                </div>

            </div>
            <!--paddination-->
            <?php
            require "footer.php";
            ?>


        </div>
    </div>

    <script src="./script.js"></script>
</body>

</html>