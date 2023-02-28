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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" defer></script>
    <script src="./assets/js/gt.js" defer></script>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
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

                            <form method="POST" class="my-0" enctype="multipart/form-data" id="cart-form">
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
                                    <!-- <input class="form-check-input border-success" checked type="radio" name="pay_mode" value="COD" id="flexRadioDefault1"> -->
                                    <select name="pay_mode" required id="select" class="form-control">
                                        <option value="">Select Payment Method</option>
                                        <option value="COD">Cash On Delivery</option>
                                        <option value="khalti">Khalti</option>
                                    </select>

                                </div>
                                <button class="btn btn-dark text-white m-auto d-flex justify-content-center" id="purchase" name="purchase">Purchase</button>
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
    <script type="text/javascript" defer>
        const btn = document.getElementById("purchase");
        const payment = document.getElementById("select");
        payment.onchange = function() {
            if (payment.value === "khalti") {
                btn.style.backgroundColor = "#5e338dff";
                btn.innerHTML = "Pay with Khalti";
            } else {
                btn.style.backgroundColor = "black";
                btn.innerHTML = "Purchase"
            }
        }
        btn.onclick = function(event) {
            const form = document.getElementById("cart-form");
            const formdata = new FormData(form);
            const dataObject = {};
            formdata.forEach((value, key) => {
                dataObject[key] = value;
            })
            if (payment.value === "COD") {
                event.preventDefault();
                $.post("./purchase.php", dataObject, result => {
                    if (result === 'Order Placed')
                        alert("Order placed");
                    window.location.href = "index.php";
                })
            } else {
                event.preventDefault();
                const pay_mode = document.getElementById("select").value;
                const address = document.getElementById("address").value;
                var config = {
                    "publicKey": "test_public_key_1059426c6e474dcd8aba71df6f39df8f",
                    "productIdentity": "rgfasdgse",
                    "productName": "354tfdff",
                    "productUrl": "http://localhost/products.php",
                    "paymentPreference": [
                        "KHALTI",
                    ],
                    "eventHandler": {
                        onSuccess(payload) {
                            $.post("./purchase.php", dataObject, result => {
                                if (result === 'Order Placed')
                                    alert(result);
                                window.location.href = "index.php";
                            })
                            console.log(payload)
                        },
                        onError(error) {
                            console.log(error);
                        },
                        onClose() {
                            console.log('widget is closing');
                        }
                    }
                };

                var checkout = new KhaltiCheckout(config);
                checkout.show({
                    amount: 1000
                })
            }
        }
    </script>
    <?php
    require './includes/footer.php';
    ?>

</body>

</html>