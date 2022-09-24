<div class="col-12">
    <div class="row mt-1">
        <div class="col-12">
            <div class="row g-1">
                <?php
                require "connection.php";

                $from = $_POST["f"];
                $to = $_POST["t"];

                $product_rs = Database::search("SELECT * FROM `invoice`");
                $product_num = $product_rs->num_rows;

                while ($product_data = $product_rs->fetch_assoc()) {
                    $sold_date = $product_data["date"];

                    $date = explode(" ", $sold_date);
                    $d = $date[0];
                    $t = $date[1];

                    if (!empty($from) && empty($to)) {
                        if ($from <= $d) {
                ?>
                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label text-white fw-bold fs-5"><?php echo $product_data["id"]  ?></label>
                            </div>

                            <?php
                            $item_rs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $product_data["product_id"] . "'");
                            $item_data = $item_rs->fetch_assoc();
                            ?>

                            <div class="col-3 bg-white text-end">
                                <label class="form-label text-black fw-bold fs-5"><?php echo $item_data["title"] ?></label>
                            </div>

                            <?php
                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                            $user_data = $user_rs->fetch_assoc();
                            ?>

                            <div class="col-3 bg-secondary text-end">
                                <label class="form-label text-white fw-bold fs-5"><?php echo $user_data["fname"] . " " . $user_data["lname"] ?></label>
                            </div>
                            <div class="col-2 bg-white text-end">
                                <label class="form-label text-black fw-bold fs-5">Rs.<?php echo $product_data["total"] ?>
                                    .00</label>
                            </div>
                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label text-white fw-bold fs-5"><?php echo $product_data["qty"] ?></label>
                            </div>
                            <div class="col-2 bg-white d-grid ">

                                <?php
                                $x = $product_data["status"];

                                if ($x == 0) {
                                ?>

                                    <button class="btn btn-success mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Confirm Order</button>

                                <?php
                                } else if ($x == 1) {
                                ?>

                                    <button class="btn btn-warning mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Paking</button>

                                <?php
                                } else if ($x == 2) {
                                ?>

                                    <button class="btn btn-info mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Dispatch</button>

                                <?php
                                } else  if ($x == 3) {
                                ?>

                                    <button class="btn btn-primary mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Shipping</button>

                                <?php
                                } else if ($x == 4) {
                                ?>

                                    <button class="btn btn-danger mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>" disabled>Delivered</button>

                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                    } else if (!empty($to) && empty($from)) {
                        if ($to >= $d) {
                        ?>

                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label text-white fw-bold fs-5"><?php echo $product_data["id"]  ?></label>
                            </div>

                            <?php
                            $item_rs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $product_data["product_id"] . "'");
                            $item_data = $item_rs->fetch_assoc();
                            ?>

                            <div class="col-3 bg-white text-end">
                                <label class="form-label text-black fw-bold fs-5"><?php echo $item_data["title"] ?></label>
                            </div>

                            <?php
                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                            $user_data = $user_rs->fetch_assoc();
                            ?>

                            <div class="col-3 bg-secondary text-end">
                                <label class="form-label text-white fw-bold fs-5"><?php echo $user_data["fname"] . " " . $user_data["lname"] ?></label>
                            </div>
                            <div class="col-2 bg-white text-end">
                                <label class="form-label text-black fw-bold fs-5">Rs.<?php echo $product_data["total"] ?>
                                    .00</label>
                            </div>
                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label text-white fw-bold fs-5"><?php echo $product_data["qty"] ?></label>
                            </div>
                            <div class="col-2 bg-white d-grid ">

                                <?php
                                $x = $product_data["status"];

                                if ($x == 0) {
                                ?>

                                    <button class="btn btn-success mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Confirm Order</button>

                                <?php
                                } else if ($x == 1) {
                                ?>

                                    <button class="btn btn-warning mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Paking</button>

                                <?php
                                } else if ($x == 2) {
                                ?>

                                    <button class="btn btn-info mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Dispatch</button>

                                <?php
                                } else  if ($x == 3) {
                                ?>

                                    <button class="btn btn-primary mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Shipping</button>

                                <?php
                                } else if ($x == 4) {
                                ?>

                                    <button class="btn btn-danger mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>" disabled>Delivered</button>

                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                    } else if (!empty($from) && !empty($to)) {
                        if ($from <= $d && $to >= $d) {
                        ?>

                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label text-white fw-bold fs-5"><?php echo $product_data["id"]  ?></label>
                            </div>

                            <?php
                            $item_rs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $product_data["product_id"] . "'");
                            $item_data = $item_rs->fetch_assoc();
                            ?>

                            <div class="col-3 bg-white text-end">
                                <label class="form-label text-black fw-bold fs-5"><?php echo $item_data["title"] ?></label>
                            </div>

                            <?php
                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                            $user_data = $user_rs->fetch_assoc();
                            ?>

                            <div class="col-3 bg-secondary text-end">
                                <label class="form-label text-white fw-bold fs-5"><?php echo $user_data["fname"] . " " . $user_data["lname"] ?></label>
                            </div>
                            <div class="col-2 bg-white text-end">
                                <label class="form-label text-black fw-bold fs-5">Rs.<?php echo $product_data["total"] ?>
                                    .00</label>
                            </div>
                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label text-white fw-bold fs-5"><?php echo $product_data["qty"] ?></label>
                            </div>
                            <div class="col-2 bg-white d-grid ">

                                <?php
                                $x = $product_data["status"];

                                if ($x == 0) {
                                ?>

                                    <button class="btn btn-success mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Confirm Order</button>

                                <?php
                                } else if ($x == 1) {
                                ?>

                                    <button class="btn btn-warning mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Paking</button>

                                <?php
                                } else if ($x == 2) {
                                ?>

                                    <button class="btn btn-info mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Dispatch</button>

                                <?php
                                } else  if ($x == 3) {
                                ?>

                                    <button class="btn btn-primary mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>">Shipping</button>

                                <?php
                                } else if ($x == 4) {
                                ?>

                                    <button class="btn btn-danger mt-2 mb-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id']  ?>);" id="btn<?php echo $product_data['id']   ?>" disabled>Delivered</button>

                                <?php
                                }
                                ?>
                            </div>
                <?php
                        }
                    }
                }

                ?>

            </div>
        </div>
    </div>
</div>