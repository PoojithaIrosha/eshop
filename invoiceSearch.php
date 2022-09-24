<div class="col-12">
    <div class="row mt-1">
        <div class="col-12">
            <div class="row">
                <?php

                require "connection.php";

                if (isset($_GET["t"])) {
                    $txt = $_GET["t"];

                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id` ='" . $txt . "'");
                    $invoice_num = $invoice_rs->num_rows;

                    if ($invoice_num == 1) {

                        $invoice_data = $invoice_rs->fetch_assoc();

                ?>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label text-white fw-bold fs-5"><?php echo $invoice_data["id"]  ?></label>
                        </div>
                        <?php
                        $q = Database::search("SELECT product.title,user.fname,user.lname FROM `invoice`
         INNER JOIN `product` ON invoice.product_id=product.id INNER JOIN `user`
          ON invoice.user_email = user.email  WHERE `invoice`.`id` ='" . $txt . "'");

                        $qdata = $q->fetch_assoc();
                        ?>
                        <div class="col-3 bg-white text-end">
                            <label class="form-label text-black fw-bold fs-5"><?php echo $qdata["title"] ?></label>
                        </div>
                        <div class="col-3 bg-secondary text-end">
                            <label class="form-label text-white fw-bold fs-5"><?php echo $qdata["fname"] . " " . $qdata["lname"] ?></label>
                        </div>
                        <div class="col-2 bg-white text-end">
                            <label class="form-label text-black fw-bold fs-5">Rs.<?php echo $invoice_data["total"] ?>
                                .00</label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label text-white fw-bold fs-5"><?php echo $invoice_data["qty"] ?></label>
                        </div>
                        <div class="col-2 bg-white d-grid ">

                            <?php
                            $x = $invoice_data["status"];

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
                <?php

                    } else {
                        echo "Invalid Invoice Number";
                    }
                } else {
                    echo "Sorry for the disturb";
                }
                ?>
            </div>
        </div>
    </div>
</div>