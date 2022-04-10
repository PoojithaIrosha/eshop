<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | Invoice</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="mt-2" style="background-color: #f7f7ff;">

    <div class="container-fluid">
        <div class="row">
            <?php require "header.php"; ?>

            <div class="col-12">
                <hr />
            </div>

            <div class="col-12 btn-toolbar justify-content-end">
                <button class="btn btn-dark me-2" onclick="printInvoice();">Print</button>
                <button class="btn btn-danger me-2" onclick="generatePDF();">Export as PDF</button>
            </div>

            <div class="col-12">
                <hr />
            </div>

            <div class="col-12 " id="page">
                <div class="row px-3">

                    <div class="col-6">
                        <div class="invoiceHeaderImg"></div>
                    </div>

                    <div class="col-6">
                        <div class="row">

                            <div class="col-12 text-end text-primary text-decoration-underline ">
                                <h2>eShop</h2>
                            </div>
                            <div class="col-12 text-end d-flex flex-column">
                                <span>Maradana, Colombo 10, Sri Lanka</span>
                                <span>+94112546978</span>
                                <span>eshop@gmail.com</span>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="border border-1 border-primary" />
                    </div>

                    <div class="col-12 mb-4">
                        <div class="row">

                            <div class="col-6">
                                <h5 class="fw-bold">Invoice To:</h5>
                                <h2>Lahiru Viraj</h2>
                                <span>Colombo rd, Horana</span><br />
                                <span>lahiru@gmail.com</span>
                            </div>

                            <div class="col-6 text-end mt-4">
                                <h1 class="text-primary">INVOICE 01</h1>
                                <span class="fw-bold">Date & Time of Invoice :</span>&nbsp;
                                <span class="fw-bold">2022-04-09 21:00:00</span>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr class="border border-1 border-white">
                                    <th>#</th>
                                    <th>Order id & Product</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr style="height: 72px">
                                    <td class="bg-primary text-white fs-3">01</td>
                                    <td>
                                        <span class="fw-bold p-2 text-primary text-decoration-underline">00000001</span>
                                        <br>
                                        <span class="w-bold p-2 fs-3 text-primary ">Apple Iphone 13</span>
                                    </td>
                                    <td class="text-end fs-6 pt-3 bg-secondary text-white">Rs.350000.00</td>
                                    <td class="text-end fs-6 pt-3">1</td>
                                    <td class="text-end fs-6 pt-3 bg-primary text-white">Rs.350000.00</td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="3" class="border-0"></td>
                                    <td class="text-end fs-5">SUBTOTAL</td>
                                    <td class="text-end">Rs.350000.00</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="border-0"></td>
                                    <td class="text-end fs-5 border-primary">DISCOUNT</td>
                                    <td class="text-end border-primary">Rs.00.00</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="border-0"></td>
                                    <td class="text-end fs-5 fw-bold border-0 text-primary">GRAND TOTAL</td>
                                    <td class="text-end border-0 text-primary fs-5">Rs.00.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="col-4 text-center" style="margin-top: -100px; margin-bottom: 50px;">
                        <span class="fs-1">Thank You!</span>
                    </div>

                    <div class="col-12 my-3 border border-5 border-primary border-start border-top-0 border-bottom-0 border-end-0 rounded" style="background-color: #e7f2ff;">
                        <div class="row">
                            <div class="col-12 mt-3 mb-3">
                                <label class="form-label fs-5 fw-bold">NOTICE :</label><br>
                                <label class="form-label fs-6">Purchased items can return befor 7 days of delivery.</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="border border-1 border-primary" />
                    </div>

                    <div class="col-12 text-center mb-3">
                        <label class="form-label fs-5 text-black-50">Invoice was created on a computer and is valid without the Signature and Seal</label>
                    </div>

                </div>
            </div>

            <?php require "footer.php"; ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>