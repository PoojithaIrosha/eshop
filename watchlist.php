<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $mail = $_SESSION["u"]["email"];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>eShop | Watchlist</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- Header -->
                <?php require "header.php"; ?>

                <div class="col-12 ">
                    <div class="row">
                        <div class="col-12 border border-1 border-secondary rounded my-3">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fs-1 fw-bold">Watchist <i class="bi bi-heart-fill text-danger fs-2 "></i></label>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <hr class="hr-break-1">
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="offset-0 offset-lg-2  col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Search in Watchlist..." id="watchlistSearch" onkeyup="basicSearchWatchlist();">
                                        </div>

                                        <div class="col-12 col-lg-2 d-grid mb-3">
                                            <button class="btn btn-outline-primary" onclick="basicSearchWatchlist();">Search</button>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1">
                                </div>

                                <div class="col-11 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-primary">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link active" aria-current="page" href="#">Active</a>
                                        <a class="nav-link" href="watchlist.php">My watchlist</a>
                                        <a class="nav-link" href="cart.php">My cart</a>
                                        <a class="nav-link disabled">Recently View</a>
                                    </nav>
                                </div>

                                <?php
                                $products = Database::search("SELECT * FROM watchlist WHERE `user_email`='" . $mail . "'");
                                $productCount = $products->num_rows;
                                if ($productCount == 0) {
                                ?>
                                    <!-- No Items -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 emptyview"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold mb-3">You have no items in your watchlist.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- No Items -->
                                <?php
                                } else {
                                ?>
                                    <!-- Item -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row g-2" id="results">

                                            <?php

                                            for ($x = 0; $x < $productCount; $x++) {
                                                $product = $products->fetch_assoc();
                                                $wid = $product["id"];
                                                $prod_id = $product["product_id"];
                                                $prod_details = Database::search("SELECT * FROM product WHERE `id`='" . $prod_id . "'");
                                                $pn = $prod_details->num_rows;
                                                if ($pn == 1) {
                                                    $pf = $prod_details->fetch_assoc();
                                                    $pid = $pf["id"];
                                            ?>
                                                    <div class="card mb-3 mx-0 mx-lg-2  col-12">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">

                                                                <?php
                                                                $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pf["id"] . "'");
                                                                $img = $img_rs->fetch_assoc();

                                                                ?>
                                                                <img src="<?php echo $img["code"]; ?>" class="img-fluid rounded-start">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $pf["title"]; ?></h5>

                                                                    <br />

                                                                    <?php

                                                                    $con_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $pf["condition_id"] . "'");
                                                                    if ($con_rs->num_rows == 1) {
                                                                        $con = $con_rs->fetch_assoc();
                                                                    }

                                                                    ?>

                                                                    <span class="fw-bold text-black-50">Condition : <?php echo $con["name"]; ?></span>

                                                                    <br />

                                                                    <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                                                    <span class="fw-bold text-black-50 fs-5">Rs.<?php echo $pf["price"]; ?>.00</span>
                                                                    <br />

                                                                    <?php
                                                                    $seller_rs = Database::search("SELECT * FROM user WHERE `email`='" . $pf["user_email"] . "'");
                                                                    if ($seller_rs->num_rows == 1) {
                                                                        $seller = $seller_rs->fetch_assoc();
                                                                    }

                                                                    ?>
                                                                    <span class="fw-bold text-black-50 fs-5">Seller : </span>&nbsp;<br>
                                                                    <span class="fw-bold text-black-50 fs-5"><?php echo $seller["fname"] . " " . $seller["lname"]; ?></span>&nbsp;<br>
                                                                    <span class="fw-bold text-black-50 fs-5"><?php echo $seller["email"]; ?></span>&nbsp;


                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mt-4">
                                                                <div class="card-body d-grid">
                                                                    <a href="#" class="btn btn-outline-success mb-2">Buy now</a>
                                                                    <a href="#" class="btn btn-outline-warning mb-2" onclick="addToCart(<?php echo $prod_id; ?>);">Add Cart</a>
                                                                    <a href="#" class="btn btn-outline-danger mb-2" onclick="deleteFromWatchlist(<?php echo $wid; ?>);">Remove</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }

                                            ?>


                                        </div>
                                    </div>
                                    <!-- Item -->


                                <?php
                                }

                                ?>




                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        </div>
        </div>

        <!-- Footer -->
        <?php require "footer.php"; ?>
        </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        alert("You have to sign in first");
        window.location = "signInSignUp.php";
    </script>
<?php
}

?>