<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="col-12">
        <div class="row mt-2 mb-2">

            <div class="col-12 d-flex flex-column d-lg-block justify-content-center justify-content-lg-start col-lg-4 offset-lg-1  align-items-center">
                <span class="text-lg-start label1"><b>Welcome</b>
                    <?php
                    if (isset($_SESSION["u"])) {
                        $data = $_SESSION["u"];
                    ?>
                        <a href="userProfile.php" class="text-primary link-1 fw-bolder underline-when-hover"><i class="bi bi-person-circle"></i>&nbsp; <?php echo $data["fname"] ?> </a>|
                    <?php

                    } else {
                    ?>
                        <a href="signInSignUp.php" class="link-primary">Sign In or Sign Up |</a>
                    <?php
                    }
                    ?>
                </span>
                <span class="text-lg-start label2">Help and Contact&nbsp;<i class="bi bi-info-circle"></i> |</span>
                <?php
                if (isset($_SESSION["u"])) {
                ?>
                    <span onclick="signOut();" class="text-lg-start label2 sign-out"><i class="bi bi-box-arrow-left"></i> Sign Out </span>
                <?php
                }
                ?>
            </div>

            <div class="col-12  mt-2 mt-lg-0 col-lg-3 offset-lg-4 " style="text-align: center;">
                <div class="row d-flex justify-content-center justify-content-lg-end">

                    <div class="col-1 col-lg-3 mt-2">
                        <a href="addProduct.php" class="text-start label2 text-decoration-none text-black">Sell</a>
                    </div>

                    <div class="col-2 col-lg-6 dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            My eShop
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Sellings</a></li>
                            <li><a class="dropdown-item" href="myProducts.php">My Products</a></li>
                            <li><a class="dropdown-item" href="watchlist.php">Watch List</a></li>
                            <li><a class="dropdown-item" href="#">Purchase History</a></li>
                            <li><a class="dropdown-item" href="#">Messages</a></li>
                            <li><a class="dropdown-item" href="#">Saved</a></li>
                        </ul>
                    </div>

                    <a href="cart.php" class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon"></a>
                </div>
            </div>

        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>