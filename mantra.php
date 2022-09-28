<?php
require './includes/dbconn.php';
?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->

<head>
    <!-- Page Meta Tags-->
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="keywords" content="" />

    <!-- Custom Google Fonts-->
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
    <!-- <link rel="stylesheet" href="./assets/css/bootstrap.min.css" /> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Fix for custom scrollbar if JS is disabled-->
    <noscript>
        <style>
            /**
          * Reinstate scrolling for non-JS clients
          */
            .simplebar-content-wrapper {
                overflow: auto;
            }
        </style>
    </noscript>
    <!-- Page Title -->
    <title>STRUMO | Category: Electric</title>
</head>

<body class="font">
    <?php
    include './includes/header.php';
    ?>
    <header class="bg-light p-3">
        <div class="container mt-2 mb-1">
            <div class="text-center text-dark font">
                <h1 class="display-4 fw-bolder font">Brand: Mantra</h1>
            </div>
        </div>
    </header>
    <!-- Section-->
    <?php
    $featuredProducts = mysqli_query($mysqli, "SELECT * FROM products WHERE brand = 'Mantra'");
    ?>

    <?php include('includes/recent-products.php'); ?>

    <!-- Bootstrap core JS-->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- Core theme JS-->
    <script src="./assets/js/vendor.bundle.js"></script>
    <!-- Theme JS -->
    <script src="./assets/js/theme.bundle.js"></script>
    <?php
    require './includes/footer.php';
    ?>

</body>

</html>