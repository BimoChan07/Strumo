<?php
include('./includes/dbconn.php');
?>
<html lang="en">

<head>
    <title>Strumo | Search</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- <script src="./js/validate.js"></script> -->
    <!-- Website Logo -->
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
</head>

<body class="">

    <?php
    require './includes/header.php';
    ?>

    <div class="col-md-12 container mb-5 p-lg-5">
        <h2 class="d-flex mt-2 text-dark font">YOUR SEARCH IS HERE</h2>
        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-bordered border-rounded">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST" action="./addtocart.php">
                            <?php
                            $mysqli = mysqli_connect("localhost", "root", "", "strumo");
                            if (isset($_GET['search'])) {
                                $filtervalues = $_GET['search'];
                                $query = "SELECT * FROM products WHERE CONCAT(name,brand,category) LIKE '%$filtervalues%' ";
                                $query_run = mysqli_query($mysqli, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $featuredProd) {
                            ?>
                                        <tr>
                                            <td class="w-25 "><img class=" card-img-top img-fluid img-thumbnail w-50" src="admin/uploads/products/<?php echo $featuredProd['photo']; ?>" alt="" />
                                            </td>
                                            <td><?= $featuredProd['name']; ?></td>
                                            <td><?= $featuredProd['description']; ?></td>
                                            <td><?= $featuredProd['price']; ?></td>
                                            <td><?php if (isset($_SESSION['username'])) {
                                                    echo '<button type="submit" name="Add_To_cart" class="btn btn-dark text-white">
										Add to cart
									</button>';
                                                } else {
                                                    echo
                                                    '<a href="./login.php" name="" class="btn navigation text-white">
										Please Login
									</a>';
                                                }
                                                ?>
                                                <input type="hidden" name="Item_name" value="<?php echo $featuredProd['name']; ?>">
                                                <input type="hidden" name="price" value="<?php echo $featuredProd['price']; ?>">
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {

                                    ?>
                                    <tr>
                                        <td colspan="5">No Records Found</td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>

                        </form>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="./assets/js/vendor.bundle.js"></script>
    <!-- Theme JS -->
    <script src="./assets/js/theme.bundle.js"></script>
    <?php
    require './includes/footer.php';
    ?>
</body>

</html>