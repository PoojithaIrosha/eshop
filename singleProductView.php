<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eShop | Single Product View</title>

    <link rel="icon" href="resources/logo.svg" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<?php
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $productrs = Database::search("SELECT product.id, product.category, product.model_has_brand, product.title, product.colour_id, product.qty, product.description, product.price, product.condition_id, product.status_id, product.user_email, product.date_time_added, product.delivery_fee_colombo, product.delivery_fee_other, model.name AS `mname`, brand.name AS `bname` FROM product INNER JOIN model_has_brand ON model_has_brand.id = product.model_has_brand INNER JOIN brand ON brand.id = model_has_brand.brand_id INNER JOIN model ON model.id = model_has_brand.model_id WHERE product.id = '" . $pid . "'");
    $pn = $productrs->num_rows;

    if ($pn == 1) {
        $pd = $productrs->fetch_assoc();

?>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php
                    require "header.php";
                    ?>

                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">

                            <div class="bg-light" style="padding: 11px;">
                                <div class="row">

                                    <!-- Vertical Left Side Images -->
                                    <div class="col-lg-2 order-lg-1 order-2">
                                        <ul>

                                            <?php
                                            $title = $pd['title'];
                                            $imagers = Database::search("SELECT * FROM images INNER JOIN product ON product.id=images.product_id WHERE product.title = '" . $title . "'");
                                            $in = $imagers->num_rows;
                                            $img;

                                            if (!empty($in)) {
                                                for ($x = 0; $x < $in; $x++) {
                                                    $d = $imagers->fetch_assoc();
                                                    if ($x == 0) {
                                                        $img = $d["code"];
                                                    }
                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                        <img src="<?php echo $d["code"]; ?>" height="150px" class="mt-1 mb-1" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>)" />
                                                    </li>
                                                <?php

                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                            <?php
                                            }

                                            ?>



                                        </ul>

                                    </div>

                                    <!-- Main Product Image -->
                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="align-items-center border border-1 border-secondary">
                                            <div style="background-image: url('<?php echo $img; ?>'); background-repeat: no-repeat; background-size: contain; height: 480px;" id="mainimg"></div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">

                                                <!-- Breadcrumb -->
                                                <nav>
                                                    <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                                                        <li class="breadcrumb-item"><a class="text-decoration-none text-black-50 fw-bold" href="#">Accessories</a></li>
                                                    </ol>
                                                </nav>

                                                <!-- Title -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fs-4 fw-bold mt-3"><?php echo $pd["title"]; ?></label>
                                                    </div>
                                                </div>

                                                <!-- Ratings -->
                                                <div class="col-12 mt-1">
                                                    <span class="badge">
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star-half mt-1 text-warning fs-6"></i>
                                                    </span>
                                                    <label class="text-dark fs-6">4.5 Stars</label>
                                                    <label class="text-dark fs-6">35 | 35 Ratings & Reviews</label>
                                                </div>

                                                <!-- Price -->
                                                <div class="col-12 d-inline-block">
                                                    <label class="fw-bold fs-4 mt-1" id="unit_price">Rs.<?php echo $pd["price"]; ?>.00</label>&nbsp;&nbsp;&nbsp;
                                                    <label class="fw-bold fs-6 mt-1 text-danger"><del>Rs.<?php
                                                                                                            $p = $pd["price"];
                                                                                                            $n = ($pd["price"] / 100)  * 5;
                                                                                                            $newval = $p  + $n;
                                                                                                            echo $newval; ?>.00</del></label>
                                                </div>

                                                <hr class="hr-break-1" />

                                                <!-- Warrenty -->
                                                <div class="col-12">
                                                    <label class="fs-6 fw-bold text-primary">Warrenty : 6 months warrenty</label><br>
                                                    <label class="fs-6 text-primary"><b>Return Policy :</b> 01 month return policy</label><br>
                                                    <label class="fs-6 text-primary"><b class="text-success">In Stock :</b> <?php echo $pd["qty"]; ?> items available</label>
                                                </div>

                                                <hr class="hr-break-1" />

                                                <!-- Seller's Details -->
                                                <div class="col-12">

                                                    <?php
                                                    $userrs = Database::search("SELECT * FROM user WHERE `email`='" . $pd["user_email"] . "'");
                                                    $userd = $userrs->fetch_assoc();


                                                    ?>

                                                    <label class="fs-3 text-dark fw-bold mb-3">Seller's Details</label><br />
                                                    <label class="fs-6 text-success">Seller's name : <?php echo $userd["fname"] . " " . $userd["lname"]; ?></label><br />
                                                    <label class="fs-6 text-success">Seller's email : <?php echo $userd["email"]; ?></label><br />
                                                    <label class="fs-6 text-success">Seller's mobile : <?php echo $userd["mobile"]; ?></label><br />
                                                </div>

                                                <hr class="hr-break-1" />

                                                <!-- Discount -->
                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class=" col-lg-8 rounded border border-1 border-primary mt-1 pt-2">
                                                            <div class="row">

                                                                <div class="col-md-3 col-sm-3 col-lg-1">
                                                                    <img src="resources/pricetag.png" height="70%" />
                                                                </div>

                                                                <div class="col-md-9 col-sm-9 mt-lg-1 mt-1 pe-4 col-lg-11">
                                                                    <label class="mt-2">Stand a chance to get instance 5% discount by using VISA.</label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <hr class="hr-break-1" />

                                                <!-- Quantity -->
                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="col-md-6" style="margin-top: 15px;">
                                                            <div class="row">

                                                                <div class="border border-1 bg-white border-secondary rounded overflow-hidden float-start mt-1 position-relative product_qty">
                                                                    <div class="col-12">
                                                                        <span style="font-size: 12px;">Qty : </span>
                                                                        <input id="qtyinput" type="text" class="border-0 fs-6 fw-bold text-start w-75" style="outline: none;" pattern="[0-9]" value="1" onkeyup='check_val(<?php echo $pd["qty"]; ?>);' />
                                                                        <div class="position-absolute qty_buttons">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_inc">
                                                                                <i class="fas fa-chevron-up" onclick='qty_inc(<?php echo $pd["qty"]; ?>);'></i>
                                                                            </div>
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_dec">
                                                                                <i class="fas fa-chevron-down" onclick='qty_dec();'></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 mt-4 mb-2">
                                                                    <div class="row">

                                                                        <div class="col-4 col-lg-5 d-grid">
                                                                            <button class="btn btn-primary">Add to Cart</button>
                                                                        </div>

                                                                        <div class="col-4 col-lg-5 d-grid">
                                                                            <button class="btn btn-success" onclick="buynow(<?php echo $pid; ?>);">Buy Now</button>
                                                                        </div>

                                                                        <div class="col-4 col-lg-2 d-grid">
                                                                            <button class="btn btn-light"><i class="fa fa-heart fs-3 mt-1 text-danger"></i></button>

                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                        <div class="col-md-6 ">
                                            <span class="fs-3 fw-bold">Related Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="row p-2 d-flex justify-content-center" style="text-align: justify;">

                                                <?php
                                                $prod = Database::search("SELECT * FROM product WHERE `model_has_brand` = '" . $pd['model_has_brand'] . "' AND  `id` <> '" . $pd["id"] . "' LIMIT 4");
                                                $bds = $prod->num_rows;
                                                for ($x = 0; $x < $bds; $x++) {
                                                    $pdf = $prod->fetch_assoc();
                                                ?>
                                                    <div class="card me-1" style="width: 18rem;">

                                                        <?php
                                                        $pimgrs = Database::search("SELECT * FROM images WHERE `product_id` = '" . $pdf["id"] . "'");
                                                        $pimgf = $pimgrs->fetch_assoc();
                                                        ?>

                                                        <img src="<?php echo $pimgf['code']; ?>" class="card-img-top" alt="..." />
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $pdf["title"]; ?></h5>
                                                            <p class="card-text text-success">Rs.<?php echo $pdf["price"]; ?>.00</p>
                                                            <a href="#" class="btn btn-primary fsm2">Add cart</a>
                                                            <a href='<?php echo "singleProductView.php?id=" . ($pdf["id"]) ?>' class="btn btn-success fsm2">Buy Now</a>
                                                            <a href="#" class="mt-2 fs-6 ms-2"><i class="fas fa-heart fs-4 text-danger "></i></a>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>



                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-6 bg-white">
                                            <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                                <div class="col-md-6 ">
                                                    <span class="fs-3 fw-bold">Product Details</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 bg-white">
                                            <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                                <div class="col-md-6 ">
                                                    <span class="fs-3 fw-bold">Send Feedback</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-6 bg-white border border-1 border-secondary">
                                            <div class="row">
                                                <div class="col-12 mt-3">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <label class="form-label fw-bold">Brand</label>
                                                        </div>
                                                        <div class="col-10">
                                                            <label class="form-label"><?php echo $pd["bname"]; ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <label class="form-label fw-bold">Model</label>
                                                        </div>
                                                        <div class="col-10">
                                                            <label class="form-label"><?php echo $pd["mname"]; ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <label class="form-label fw-bold">Description</label>
                                                        </div>
                                                        <div class="col-10">

                                                            <textarea cols="60" rows="10" disabled><?php echo $pd["description"]; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 bg-white border border-1 border-secondary">
                                            <div class="row">
                                                <div class="col-12 mt-3">
                                                    <div class="row">

                                                        <div class="col-12 col-lg-3">
                                                            <label class="form-label">Feedback Type</label>
                                                        </div>

                                                        <div class="col-12 col-lg-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r1" checked>
                                                                <label class="form-check-label text-success fw-bold " for="r1">
                                                                    Positive
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r2">
                                                                <label class="form-check-label text-warning fw-bold" for="r2">
                                                                    Neutrals
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r3">
                                                                <label class="form-check-label text-danger fw-bold" for="r3">
                                                                    Negative
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="form-label fw-bold">Customer's Email</label>
                                                        </div>
                                                        <div class="col-8">
                                                            <input id="e" type="email" class="form-control" placeholder="ex: john@example.com" value="<?php echo $_SESSION["u"]["email"]; ?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-3 mb-3">

                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="form-label fw-bold">Customer's Feedback</label>
                                                        </div>
                                                        <div class="col-8">
                                                            <textarea id="f" class="form-control" cols="30" rows="8"></textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-12 offset-lg-3 col-lg-8 mt-2 mb-3 d-grid">
                                                    <button class="btn btn-outline-primary" onclick="saveFeed(<?php echo $pid; ?>);">Send Feedback</button>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-secondary">
                                </div>

                                <div class="col-12">
                                    <div class="row g-2">

                                        <?php

                                        $feedback_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `user` ON `feedback`.`user_email` = `user`.`email` WHERE `product_id` ='" . $pid . "'");
                                        while ($feedback_data = $feedback_rs->fetch_assoc()) {
                                        ?>
                                            <div class="col-12 col-lg-3 bg-white border border-1 border-danger rounded mx-2">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <span class="text-center fs-5 fw-bold text-primary"><?php echo $feedback_data["fname"] . " " . $feedback_data["lname"]; ?></span>
                                                        <br>
                                                        <span class="fs-6 fw-bold text-secondary"><?php echo $feedback_data["user_email"]; ?></span>
                                                    </div>

                                                    <div class="offset-1 col-10 text-center border border-1 border-warning rounded mt-3" style="height: 100px; overflow: auto;">
                                                        <p class="fs-6 "><?php echo $feedback_data["feed"]; ?></p>
                                                    </div>

                                                    <div class="col-12 text-center mt-2 ">
                                                        <span class="fs-6 text-black-50 fw-bold"><?php echo $feedback_data["date"]; ?></span>
                                                    </div>

                                                    <div class="col-12 mt-3 mb-3">
                                                        <div class="row">
                                                            <?php

                                                            if ($feedback_data["type"] == 1) {
                                                            ?>
                                                                <div class="offset-1 col-10 bg-success text-center">
                                                                    <span class="fs-5 fw-bold text-white">Positive Feedback</span>
                                                                </div>
                                                            <?php
                                                            } else if ($feedback_data["type"] == 2) {
                                                            ?>
                                                                <div class="offset-1 col-10 bg-warning text-center">
                                                                    <span class="fs-5 fw-bold text-white">Neutral Feedback</span>
                                                                </div>
                                                            <?php
                                                            } else if ($feedback_data["type"] == 3) {
                                                            ?>
                                                                <div class="offset-1 col-10 bg-danger text-center">
                                                                    <span class="fs-5 fw-bold text-white">Negative Feedback</span>
                                                                </div>
                                                            <?php
                                                            }

                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }

                                        ?>
                                    </div>
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
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        </body>

</html>

<?php
    }
} else {
}

?>