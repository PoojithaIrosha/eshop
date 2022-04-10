<div class="col-10 offset-1 text-center">

    <?php
    require "connection.php";

    session_start();
    $user = $_SESSION["u"];

    $search = $_POST["s"];
    $age = $_POST["a"];
    $qty = $_POST["q"];
    $condition = $_POST["c"];

    $query = "SELECT * FROM product WHERE `user_email`='" . $user["email"] . "' ";

    if ($condition == "1") {
        $query .= "AND `condition_id`='1'";
    } else if ($condition == "2") {
        $query .= "AND `condition_id`='2'";
    } else if (!empty($search)) {
        $query .= "AND `title` LIKE '%" . $search . "%'";
    } else if ($age == "1") {
        $query .= "ORDER BY `date_time_added` DESC";
    } else if ($age == "2") {
        $query .= "ORDER BY `date_time_added` ASC";
    } else if ($qty == "1") {
        $query .= "ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= "ORDER BY `qty` ASC";
    }

    $query1 = $query;

    ?>

    <div class="row justify-content-center">

        <?php

        if ($_POST["page"] != "0") {
            $pageno = $_POST["page"];
        } else {
            $pageno = 1;
        }

        $products = Database::search($query);
        $nProducts = $products->num_rows;
        $userProduct = $products->fetch_assoc();

        $results_per_page = 6;
        $number_of_pages = ceil($nProducts / $results_per_page);

        $page_first_result = ($pageno - 1) * $results_per_page;
        $selectdrs = Database::search($query1 . " LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");
        $srn = $selectdrs->num_rows;

        for ($x = 0; $x < $srn; $x++) {
            $p = $selectdrs->fetch_assoc();

        ?>
            <div class="card mb-3 mt-3 col-12 col-lg-6">
                <div class="row">
                    <div class="col-md-4 mt-4">

                        <?php

                        $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $p["id"] . "'");
                        $pir = $pimgrs->fetch_assoc();
                        ?>


                        <img src="<?php echo $pir["code"] ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $p["title"]; ?></h5>
                            <span class="text-primary card-text fw-bold"><?php echo $p["price"]; ?>0</span>
                            <br />
                            <span class="card-text text-success fw-bold"><?php echo $p["qty"]; ?> Items Left</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="changeStatus(<?php echo $p['id']; ?>);" <?php
                                                                                                                                                                            if ($p["status_id"] == 2) {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            }
                                                                                                                                                                            ?>>


                                <label class="form-check-label text-info fw-bold" for="flexSwitchCheckChecked" id="checkLabel<?php echo $p['id']; ?>">
                                    <?php

                                    if ($p["status_id"] == 2) {
                                        echo "Make your product Active";
                                    } else {
                                        echo "Make your product Deactive";
                                    }

                                    ?>
                                </label>
                            </div>
                            <div class="row">

                                <div class="col-12">
                                    <div class="row g-1">

                                        <div class="col-12 col-lg-6 d-grid">
                                            <a href="#" class="btn btn-success" onclick="sendId(<?php echo $p['id'] ?>);">Update</a>
                                        </div>

                                        <div class="col-12 col-lg-6 d-grid">
                                            <a href="#" class="btn btn-danger">Delete</a>
                                        </div>

                                    </div>
                                </div>
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
<!-- pagination -->

<div class="offset-lg-4 col-12 col-lg-4 text-center mb-3">
    <div class="pagination">
        <a <?php if ($pageno <= 1) {
                echo "#";
            } else {
            ?> onclick="addFilters('<?php echo ($pageno - 1); ?>');" <?php
                                                                    } ?>>&laquo;</a>


        <?php

        for ($page = 1; $page <= $number_of_pages; $page++) {

            if ($page == $pageno) {
        ?>
                <a onclick="addFilters(<?php echo $page ?>);" class="active"><?php echo $page; ?></a>

            <?php
            } else {
            ?>

                <a onclick="addFilters(<?php echo $page ?>);"><?php echo $page; ?></a>
        <?php
            }
        }

        ?>


        <a <?php if ($pageno >= $number_of_pages) {
                echo "href='#'";
            } else {
            ?> onclick="addFilters(<?php echo $pageno + 1; ?>);" <?php
                                                                } ?>>&raquo;</a>
    </div>

</div>

<!-- pagination -->