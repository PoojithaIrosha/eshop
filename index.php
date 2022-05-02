<?php
session_start();
require "connection.php";
?>


<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eShop | Home</title>
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Header -->
            <?php require "header.php"; ?>
            <hr class="hr-break-1" />

            <div class="col-12 justify-content-center">
                <div class="row mb-3">
                    <div class="col-4 col-lg-1 offset-4 offset-lg-1 logo-img"></div>

                    <div class="col-8 col-lg-6">
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">
                            <select class="btn btn-outline-primary" id="basic_search_select" onchange="basicSearch(0);">
                                <option value="0" readonly>All Categories</option>
                                <?php
                                $rs = Database::search("SELECT * FROM category");
                                $n = $rs->num_rows;

                                for ($x = 0; $x < $n; $x++) {
                                    $fa = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $fa["id"] ?>"><?php echo $fa["name"] ?></option>

                                <?php
                                }

                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-2 d-grid gap-2">
                        <button onclick="basicSearch(0);" class="btn btn-primary mt-3 search-btn">Search</button>
                    </div>

                    <div class="col-2 mt-4">
                        <a class="link-secondary link-1" href="advancedSearch.php">Advanced</a>
                    </div>
                </div>
            </div>
            <hr class="hr-break-1" />

            <div class="col-12" id="basicSearchResult">

                <!-- Carousel -->
                <div class="col-12 d-none d-lg-block mb-2">
                    <div class="row">
                        <div id="carouselExampleIndicators" class="carousel col-8 offset-2 slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active ">
                                    <img src="resources/slider images/posterimg.jpg" class="d-block poster-img-1">
                                    <div class="carousel-caption d-none d-md-block poster-caption">
                                        <h5 class="poster-title">Welcome to eShop</h5>
                                        <p class="poster-text">The World's Best Online Store By One Click.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/slider images/posterimg2.jpg" class="d-block poster-img-1">
                                </div>
                                <div class="carousel-item ">
                                    <img src="resources/slider images/posterimg3.jpg" class="d-block poster-img-1">
                                    <div class="carousel-caption d-none d-md-block poster-caption-1">
                                        <h5 class="poster-title">Be Free...</h5>
                                        <p class="poster-text text-muted">Experience the Lowest Delivery Costs With Us.</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                    </div>
                </div>


                <?php
                $rs = Database::search("SELECT * FROM category");
                $n = $rs->num_rows;

                for ($x = 0; $x < $n; $x++) {
                    $cat = $rs->fetch_assoc();
                    $productrs = Database::search("SELECT * FROM `product` WHERE `category`='" . $cat["id"] . "'");
                    if ($productrs->num_rows != 0) {
                ?>

                        <!-- Category Name -->
                        <div class="col-12 mb-3">
                            <a href="#" class="link-dark link2"><?php echo $cat["name"]; ?></a>&nbsp;&nbsp;
                            <a href="#" class="link-dark link3">See All&nbsp; &rarr;</a>
                        </div>
                        <!-- Category Name -->

                        <?php
                        $resultset = Database::search("SELECT * FROM product WHERE category='" . $cat["id"] . "' ORDER BY `date_time_added` DESC LIMIT 4 OFFSET 0");
                        $nr = $resultset->num_rows;
                        ?>
                        <!-- Products -->
                        <div class="col-12 mb-3">
                            <div class="row ">
                                <div class="col-12 col-lg-12">
                                    <div class="row justify-content-center gap-3">
                                        <?php
                                        for ($y = 0; $y < $nr; $y++) {
                                            $product = $resultset->fetch_assoc();
                                        ?>
                                            <!-- card -->
                                            <div class="card col-6 col-lg-2 mt-2 mb-2 " style="width: 18rem;">
                                                <?php
                                                $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'");
                                                $img = $pimage->fetch_assoc();
                                                ?>
                                                <img src="<?php echo $img["code"]; ?>" class="card-img-top card-img-top">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $product["title"] ?>&nbsp;<span class="badge bg-info">New</span></h5>
                                                    <span class="card-text text-primary">Rs. <?php echo $product["price"] ?>.00</span>
                                                    <br />

                                                    <?php
                                                    if ($product["qty"] > 0) {
                                                    ?>
                                                        <span class="card-text text-warning fw-bold">In Stock</span>
                                                        <span class="card-text text-success fw-bold"><?php echo $product["qty"] ?> Items Available</span>
                                                        <a href='<?php echo "singleProductView.php?id=" . ($product["id"]) ?>' class="btn btn-success col-12">Buy Now</a>
                                                        <a class="btn btn-danger col-12 mt-1" onclick="addToCart(<?php echo $product['id']; ?>);">Add to Cart</a>
                                                    <?php
                                                    } else {

                                                    ?>
                                                        <span class="card-text text-danger fw-bold">Out of Stock</span>
                                                        <span class="card-text text-danger fw-bold">0 Items Available</span>
                                                        <button class="btn btn-success col-12 disabled">Buy Now</button>
                                                        <button class="btn btn-danger col-12 mt-1 disabled">Add to Cart</button>
                                                    <?php

                                                    }
                                                    ?>

                                                    <!-- Watchlist Button -->
                                                    <?php

                                                    if(isset($_SESSION["u"])) {
                                                        $watchlistrs = Database::search("SELECT * FROM watchlist WHERE `product_id`='" . $product["id"] . "' AND `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                        if ($watchlistrs->num_rows == 1) {
                                                            ?>
                                                            <a onclick="addToWatchlist('<?php echo $product['id']; ?>');" class="btn btn-secondary col-12 mt-1"><i class="bi bi-heart-fill text-danger " id="<?php echo "heart" . $product['id']; ?>"></i></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a onclick="addToWatchlist('<?php echo $product['id']; ?>');" class="btn btn-secondary col-12 mt-1"><i class="bi bi-heart-fill text-white" id="<?php echo "heart" . $product['id']; ?>"></i></a>
                                                            <?php
                                                        }
                                                    }else {
                                                        ?>
                                                        <a onclick="addToWatchlist('<?php echo $product['id']; ?>');" class="btn btn-secondary col-12 mt-1"><i class="bi bi-heart-fill text-white" id="<?php echo "heart" . $product['id']; ?>"></i></a>
                                                        <?php
                                                    }
                                                    ?>
                                                    <!-- Watchlist Button -->

                                                </div>
                                            </div>
                                            <!-- card end -->
                                        <?php
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <br />
                        <!-- Products -->


                <?php
                    }
                }
                ?>

            </div>


            <!-- Footer -->
            <?php require "footer.php"; ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>