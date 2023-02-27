<?php
include('./includes/dbconn.php');

$productid = $_GET['pid'];
$productDetail = mysqli_query($mysqli, "SELECT * FROM products WHERE productid = '$productid'");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$propertyID = $productid;
	$username = $_SESSION["username"];
	header("Location:products.php?pid=" . $productid);
}
// Save Business Contact Info
?>

<!DOCTYPE html>
<html lang="">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Strumo | Product Info</title>
	<!-- Website Logo-->
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

<body class="">

	<?php require 'includes/header.php'; ?>

	<?php while ($product = mysqli_fetch_array($productDetail)) { ?>
		<!-- Section-->

		<div class="container-fluid mt-5 font">
			<!-- Product Top Section-->
			<div class="row g-9" data-sticky-container="">

				<!-- Product Images-->
				<div class="col-12 col-md-6 col-xl-7">
					<div class="row g-3">
						<div class="col-12">

							<picture>
								<img class="card-img-top mb-2" src="admin/uploads/products/<?php echo $product['photo']; ?>" alt="" />
							</picture>
						</div>
					</div>
				</div>
				<!-- /Product Images-->

				<!-- Product Information-->
				<div class="col-12 col-md-6 col-lg-5">
					<div class="sticky-top top-5">
						<div class="pb-3">

							<div class="d-flex align-items-center mb-3">
								<p class="small fw-bolder text-uppercase tracking-wider text-muted m-0 me-4"><?php echo $product['brand']; ?></p>

							</div>
							<form method="POST" action="./addtocart.php">
								<h1 class="mb-3	 fs-2 fw-bold"><?php echo $product['name']; ?></h1>
								<!-- Product Accordion -->
								<div class="accordion" id="accordionProduct">
									<div class="accordion-item">
										<!-- <h1 class="accordion-header" id="headingOne"> -->
										<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											<h5>Product Details</h5>
										</button>

										<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionProduct">
											<div class="accordion-body">
												<p class="fs-4 m-0">Rs.&nbsp;<?php echo $product['price']; ?></p>

												<p class="m-0"><?php echo $product['description'] ?></p>
											</div>
											<div class="text-center Reveal-block-body">
												<?php if ($product['stock'] == 0) {
													echo '<h5 class="mb-2 text-danger">Out of Stock</h5>';
												} else {
													echo '<h5 class="mb-2 mt-2 text-success">Available stock: ' . $product['stock'];
													'</h5>';
												}
												?>
											</div>
										</div>
									</div>
									<div class="text-center Reveal-block-body">
										<?php
										if (isset($_SESSION['username'])) {
											if ($product['stock'] != 0) {
												echo '<input type="number" name="Mod_Quantity" id="Mod_Quantity" class="form-control" required placeholder="Quantity">';
											} else {
												echo '<a href="./index.php" class="a d-flex justify-content-end">Go back</a>';
											}
										} ?>
									</div>
									<div class="d-flex justify-content-between mt-3	">
										<?php if (isset($_SESSION['username'])) {
											if ($product['stock'] != 0) {
												echo '<button type="submit" value="Add To Cart" name="Add_To_cart" class="btn btn-dark text-white m-auto">
										Add to cart
									</button>';
											}
										} else {
											echo
											'<a href="./login.php" name="" class="btn btn-dark m-auto">
										Please Login
									</a>';
										} ?>
										<input type="hidden" name="Item_name" value="<?php echo $product['name']; ?>">
										<input type="hidden" name="price" value="<?php echo $product['price']; ?>">
										<!-- / Product Accordion-->
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- / Product Information-->
				</div>

				<!-- / Product Top Section-->
			</div>
		<?php } ?>

		<?php include('includes/footer.php'); ?>
		<!-- Bootstrap core JS-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
		<!-- Core theme JS-->

</body>

</html>