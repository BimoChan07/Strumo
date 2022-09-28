<?php
include("./includes/dbconn.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strumo | Cart</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600&family=Roboto:wght@300;400;700&display=auto" rel="stylesheet" />
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/logos/webw.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/logos/webw.png" />
    <link rel="mask-icon" href="./assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5" />
    <meta name="msapplication-TileColor" content="#da532c" />
    <meta name="theme-color" content="#ffffff" />
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="./assets/css/libs.bundle.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="./assets/css/theme.bundle.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="font">
    <?php
    include("./includes/header.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center text-white border rounded bg-dark my-5">
                <h1>MY CART</h1>
            </div>

            <div class="col-lg-9 font">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Serial No.</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $total = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $sr = $key + 1;
                                echo "<tr>
                                <td>$sr</td>
                                <td>$value[Item_name]</td>
                                <td>$value[price]<input type='hidden' class='iprice' value='$value[price]'></td>
                                <td>
                                <form action='./addtocart.php' method='POST'>
                                $value[Quantity]<input class='text-center iquantity' name='Mod_Quantity' id='Mod_Quantity' onchange='this.form.submit();' type='hidden' value='$value[Quantity]' min='1' max=''>                                </td>
                                <input type='hidden' name='Item_name' value='$value[Item_name]'>
                                </form>
                                </td>
                                <td class='itotal'></td>
                                <td>
                                <form action='./addtocart.php' method='POST'>
                                <button name='Remove_Item' class='btn btn-sm btn-danger'>REMOVE</button>
                                <input type='hidden' name='Item_name' value='$value[Item_name]'>
                                </form>
                                </td>
                                </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <?php
            $uname = $_SESSION['username'];
            $userDetail = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$uname'");

            while ($userinfo = mysqli_fetch_array($userDetail)) { ?>
                <div class="col-lg-3 font">
                    <div class="border border-dark mb-5 border-2 bg-light rounded p-4">
                        <h4>Grand Total:</h4>
                        <h5 class="text-right" id="gtotal"></h5>
                        <?php
                        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        ?>
                            <!--customer details for payment -->

                            <form action="./purchase.php" method="POST" class="my-0" enctype="multipart/form-data">
                                <div class="form-group mt-3 mb-3">
                                    <b><label>Username: </label></b>
                                    <?php echo $userinfo['fullname']; ?><input type="hidden" name="fullname" id="fullname" value="<?php echo $userinfo['fullname']; ?>" placeholder="Full Name" class="form-control border-success" required>
                                </div>
                                <div class="form-group mt-3 mb-3">
                                    <b><label>Phone: </label></b>
                                    <?php echo $userinfo['phone'] ?><input type="hidden" name="phone_no" id="phone_no" value="<?php echo $userinfo['phone'] ?>" placeholder="Phone Number" class="form-control border-success" required>
                                </div>
                                <div class="form-group mt-3 mb-3">
                                    <b><label>Address: </label></b>
                                    <?php echo $userinfo['address'] ?><input type="hidden" name="address" id="address" value="<?php echo $userinfo['address'] ?>" placeholder="Address" class="form-control border-success" required>
                                </div>
                                <div class="form-group mt-3 mb-3">
                                    <input class="form-check-input border-success" checked type="radio" name="pay_mode" value="COD" id="flexRadioDefault1">
                                    <b><label class="form-check-label" for="flexRadioDefault1">Cash On Delivery
                                        </label></b>
                                </div>
                                <button class="btn btn-dark text-white m-auto d-flex justify-content-center" name="purchase">Purchase</button>
                            </form>

                        <?php
                        } ?>
                    </div>

                </div>
            <?php
            } ?>
        </div>
    </div>

    <!--for grand total of the items-->
    <script type="text/javascript">
        var gt = 0; //grand total
        var iprice = document.getElementsByClassName('iprice');
        var iquantity = document.getElementsByClassName('iquantity');
        var itotal = document.getElementsByClassName('itotal');
        var gtotal = document.getElementById('gtotal');

        function subTotal() {
            gt = 0;
            for (i = 0; i < iprice.length; i++) {
                itotal[i].innerText = (iprice[i].value) * (iquantity[i].value);
                gt = gt + (iprice[i].value) * (iquantity[i].value);
                /* price 650 quantity 1      gt=0+(650*1)
                price 750 quantity 2          gt= 650+(750*2) === gt = 2150
                price 850 quantity 1          gt= 2150+(850*1)=== gt = 3000 */
            }
            gtotal.innerText = gt;
        }
        subTotal();
    </script>
    <?php
    require './includes/footer.php';
    ?>

</body>

</html>