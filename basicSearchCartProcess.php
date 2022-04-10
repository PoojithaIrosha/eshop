<?php
require "connection.php";
session_start();

$user_mail = $_SESSION["u"]["email"];

$search_input = $_POST["input"];

$cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user_mail . "'");
$cartnum = $cartrs->num_rows;
if ($cartrs->num_rows != 0) {
    while ($cartrow = $cartrs->fetch_assoc()) {
        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cartrow["product_id"] . "' AND `title` LIKE '%" . $search_input . "%'");
        while ($productrow = $productrs->fetch_assoc()) {
            // echo $productrow["title"];

            $total = $total + ($productrow["price"] * $cartrow["qty"]);

            $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $mail . "'");
            $ar = $addressrs->fetch_assoc();
            $cityid = $ar["city_id"];

            $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityid . "'");
            $xr = $districtrs->fetch_assoc();
            $districtid = $xr["district_id"];

            $ship = 0;

            if ($districtid == 5) {
                $ship = $productrow["delivery_fee_colombo"];
                $shipping += $ship;
            } else {
                $ship = $productrow["delivery_fee_other"];
                $shipping += $ship;
            }

            $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $productrow["user_email"] . "'");
            $userrow = $userrs->fetch_assoc();
?>
            <!-- have products -->
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="card mb-3 mx-0 col-12">
                        <div class="row g-0">
                            <div class="col-md-12 mt-3 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                        <span class="fw-bold text-black fs-5"><?php echo $userrow["fname"] . " " . $userrow["lname"]; ?></span>&nbsp;
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-md-4">
                                <?php
                                $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $productrow["id"] . "'");
                                $imagerow = $imagers->fetch_assoc();

                                ?>

                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $productrow["description"]; ?>" title="Product Description">
                                    <img src="<?php echo $imagerow['code']; ?>" class="img-fluid rounded-start" style="max-width: 200px;" disabled>
                                </span>

                            </div>
                            <div class="col-md-5">
                                <div class="card-body">

                                    <h3 class="card-title"><?php echo $productrow["title"]; ?></h3>

                                    <?php
                                    $colorrs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $productrow["colour_id"] . "'");
                                    $colorrow = $colorrs->fetch_assoc();

                                    ?>
                                    <span class="fw-bold text-black-50">Colour : <?php echo $colorrow["name"]; ?></span> &nbsp; |

                                    <?php

                                    $conditionrs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $productrow["condition_id"] . "'");
                                    $conditionrow = $conditionrs->fetch_assoc();

                                    ?>
                                    &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo $conditionrow["name"]; ?></span>
                                    <br>
                                    <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                    <span class="fw-bold text-black fs-5">Rs.<?php echo $productrow["price"]; ?>.00</span>
                                    <br>
                                    <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                    <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="<?php echo $cartrow['qty']; ?>">
                                    <br><br>
                                    <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                    <span class="fw-bold text-black fs-5">Rs.<?php echo $ship ?>.00</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-body d-grid">
                                    <a class="btn btn-outline-success mb-2">Buy Now</a>
                                    <a class="btn btn-outline-danger mb-2" onclick="deleteFromCart(<?php echo $cartrow['id']; ?>);">Remove</a>
                                </div>
                            </div>

                            <hr>

                            <div class="col-md-12 mt-3 mb-3">
                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                    </div>
                                    <div class="col-6 col-md-6 text-end">
                                        <?php
                                        $requested_total = ($productrow["price"] * $cartrow["qty"]) + $ship;
                                        ?>
                                        <span class="fw-bold fs-5 text-black-50">Rs.<?php echo $requested_total; ?>.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- have products -->
    <?php
        }
    }

    ?>
    <div class="col-12 col-lg-3">
        <div class="row">

            <div class="col-12">
                <label class="form-label fs-3 fw-bold">Summary</label>
            </div>

            <div class="col-12">
                <hr />
            </div>

            <!-- Items -->
            <div class="col-6 mb-3">
                <span class="fs-6 fw-bold">Items (<?php echo $cartnum; ?>)</span>
            </div>

            <div class="col-6 text-end">
                <span>Rs.<?php echo $total; ?>.00</span>
            </div>
            <!-- Items -->

            <!-- Shipping -->
            <div class="col-6">
                <span class="fs-6 fw-bold">Shipping</span>
            </div>

            <div class="col-6 text-end">
                <span>Rs.<?php echo $shipping; ?>.00</span>
            </div>
            <!-- Shipping -->

            <div class="col-12 mt-3">
                <hr />
            </div>

            <!-- Total -->
            <div class="col-6 mt-2">
                <span class="fs-4 fw-bold">Total</span>
            </div>

            <div class="col-6 mt-2 text-end">
                <span class="fs-4 fw-bold">Rs.<?php echo $total + $shipping; ?>.00</span>
            </div>
            <!-- Total -->

            <div class="col-12 mt-3 mb-3 d-grid">
                <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
            </div>


        </div>
    </div>
<?php
}


?>