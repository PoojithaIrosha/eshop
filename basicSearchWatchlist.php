<?php
session_start();
require "connection.php";

$txt = $_POST["txt"];
// echo $txt;
// $pageno;

// if ($_POST["page"] != "0") {
//     $pageno = $_POST["page"];
// } else {
//     $pageno = 1;
// }

$watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
if ($watchlistrs->num_rows != 0) {
    while ($watchlistrow = $watchlistrs->fetch_assoc()) {
        $products = Database::search("SELECT * FROM `product` WHERE `id`='" . $watchlistrow["product_id"] . "' AND `title` LIKE '%" . $txt . "%'");
        while ($product = $products->fetch_assoc()) {
?>

            <div class="card mb-3 mx-0 mx-lg-2  col-12">
                <div class="row g-0">
                    <div class="col-md-4">

                        <?php
                        $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'");
                        $img = $img_rs->fetch_assoc();

                        ?>
                        <img src="<?php echo $img["code"]; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product["title"]; ?></h5>

                            <br />

                            <?php

                            $con_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product["condition_id"] . "'");
                            if ($con_rs->num_rows == 1) {
                                $con = $con_rs->fetch_assoc();
                            }

                            ?>

                            <span class="fw-bold text-black-50">Condition : <?php echo $con["name"]; ?></span>

                            <br />

                            <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                            <span class="fw-bold text-black-50 fs-5">Rs.<?php echo $product["price"]; ?>.00</span>
                            <br />

                            <?php
                            $seller_rs = Database::search("SELECT * FROM user WHERE `email`='" . $product["user_email"] . "'");
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
                            <a href="#" class="btn btn-outline-warning mb-2">Add Cart</a>
                            <a href="#" class="btn btn-outline-danger mb-2" onclick="deleteFromWatchlist(<?php echo $wid; ?>);">Remove</a>
                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }
}
