<?php
require_once 'app\controllers\ControllerIndex.php';
require_once('app\controllers\ControllerCart.php')

	?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>MyBook.tn</title>
	<link rel="icon" href="assets/images/icon.png" type="image/x-icon"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="stylesheet" href="assets/css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/animate.css">

	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">

	<link rel="stylesheet" href="assets/css/aos.css">

	<link rel="stylesheet" href="assets/css/ionicons.min.css">

	<link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="assets/css/jquery.timepicker.css">


	<link rel="stylesheet" href="assets/css/flaticon.css">
	<link rel="stylesheet" href="assets/css/icomoon.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<script src="https://kit.fontawesome.com/df57f43f75.js" crossorigin="anonymous"></script>
</head>

<body class="goto-here">
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.php"><img src="assets/images/logo black.png" alt="logo" width="370"
					height="170"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
				aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a href="index.php" class="nav-link" style="font-size: large;">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false" style="font-size: large;">Catalog</a>
						<div class="dropdown-menu" aria-labelledby="dropdown04">
							<a class="dropdown-item" href="app/views/shop.php">Shop</a>
							<?php if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') { ?>

								<a class="dropdown-item" href="app/views/checkout.php">Checkout</a>
							<?php }
							; ?>
						</div>
					</li>
					<li class="nav-item"><a href="app/views/about.php" class="nav-link"
							style="font-size: large;">About</a></li>
					<li class="nav-item"><a href="app/views/contact.php" class="nav-link"
							style="font-size: large;">Contact</a>
					</li>

					<?php if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') { ?>

						<li id="cartItemCount" class="nav-item cta cta-colored"><a
								href="<?php echo isset($_SESSION['username']) ? 'app/views/cart.php' : 'app/views/login.php'; ?>"
								class="nav-link"><span style="font-size:xx-large ;" class="icon-shopping_cart">
								</span>
								<?php
								// Vérifier si la session est vide
								if (!empty($_SESSION['username'])) {

									echo '[' . count($products) . ']';

								}
								?>
							</a></li>
					<?php }
					; ?>

					<!-- <li class="nav-item"><a href="app/views/login.php" class="nav-link"><span class="icon-user"
								style="font-size:xx-large ;"></span></a></li> -->
					<?php


					if (isset($_SESSION['username'])) {
						// L'utilisateur est connecté, afficher les informations de l'utilisateur
						$userFullName = $_SESSION['username'];
						echo '<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="icon-user" style="font-size: xx-large;"></span>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<p class="dropdown-item">' . $userFullName . '</p>
									<div class="dropdown-divider"></div>
									<a id="logoutBtn" class="dropdown-item" href="app\views\logout.php">Deconnexion</a>
								</div>
							</li>';
					} else {
						// L'utilisateur n'est pas connecté, afficher le lien de connexion
						echo '<li class="nav-item"><a href="app/views/login.php" class="nav-link"><span class="icon-user" style="font-size: xx-large;"></span></a></li>';
					}
					?>
					<?php
					if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
						echo '
                    <li id="cartItemCount" class="nav-item cta cta-colored"><a href="app/views/dashboard/booksTable.php"
                            class="nav-link"><span style="font-size:xx-large ;" class="fa-solid fa-desktop">
                            </span>
                        </a></li>';

					} ?>
				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->
	<section id="home-section" class="hero">


		<div class="home-slider owl-carousel">
			<?php foreach ($produitsALL as $produit): ?>
				<?php if ($produit['Category'] === 'New in store'): ?>
					<div class="slider-item js-fullheight">
						<div class="overlay"></div>
						<div class="container-fluid p-0">
							<div class="row d-md-flex no-gutters slider-text align-items-center justify-content-end"
								data-scrollax-parent="true">
								<img class="one-third order-md-last img-fluid" src="<?php echo $produit['Image']; ?>"
									alt="<?php echo $produit['Title']; ?>">
								<div class="one-forth d-flex align-items-center ftco-animate"
									data-scrollax=" properties: { translateY: '70%' }">
									<div class="text">
										<span class="subheading">#New Arrival</span>
										<div class="horizontal">
											<h1 class="mb-4 mt-3">
												<?php echo $produit['Title']; ?>
											</h1>
											<p class="mb-4">
												<?php echo $produit['Description']; ?>
											</p>
											<p><a href="#" class="btn-custom">Voir plus</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>



	</section>

	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<h2 class="mb-4">Books Highlights</h2>
					<p>discover the highlights of our books right here</p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<?php foreach ($produitsALL as $produit): ?>
					<?php if ($produit['Category'] === 'Highlight'): ?>
						<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
							<div class="product d-flex flex-column">
								<a href="#" class="img-prod" onclick="searchSingleProduct('<?php echo $produit['book_id']; ?>')" ><img class="img-fluid" src="<?php echo $produit['Image']; ?>"
										alt="<?php echo $produit['Title']; ?>" style="height: 300px; width:300px;">
									<?php if ($produit['Discount'] != 0): ?>
										<span class="status">
											<?php echo $produit['Discount'] . " %OFF"; ?>
										</span>
									<?php endif; ?>
									<div class="overlay"></div>
								</a>
								<div class="text py-3 pb-4 px-3">
									<div class="d-flex">
										<div class="cat">
											<span>
												<?php echo $produit['Category']; ?>
											</span>
										</div>
									</div>
									<h3><a href="#">
											<?php echo $produit['Title']; ?>
										</a></h3>
									<div class="pricing">
										<p class="price"><span>
												<?php echo ($produit['Price'] - ($produit['Price'] * $produit['Discount'] / 100)) . " DT"; ?>
											</span></p>
										<?php if ($produit['Discount'] != 0): ?>
											<span class="price-sale"><del>
													<?php echo $produit['Price'] . " DT"; ?>
												</del></span>
										<?php endif; ?>

									</div>
									<p class="bottom-area d-flex px-3">
										<!-- <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
													class="ion-ios-add ml-1"></i></span></a> -->
										<?php

										// Vérifiez si la session est vide
										if (!empty($_SESSION['username'])) {

											// La session n'est pas vide, affichez le lien "Add to cart"
											echo '<a href="index.php" class="add-to-cart text-center py-2 mr-1" onclick="addToCart(' . $produit['book_id'] . ')">
                <span>Add to cart <i class="ion-ios-add ml-1"></i></span>
            </a>';
										} else {
											// La session est vide, redirigez vers la page login.php
											echo '<a href="app/views/login.php" class="text-center py-2 mr-1">
                <span>Add to cart <i class="ion-ios-add ml-1"></i></span>
            </a>';
										}
										?>

									</p>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>

			</div>
		</div>
	</section>
	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<h2 class="mb-4">New in store</h2>
					<p>discover the news of our books right here</p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<?php foreach ($produitsALL as $produit): ?>
					<?php if ($produit['Category'] === 'New in store'): ?>
						<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
							<div class="product d-flex flex-column">
								<a href="#" class="img-prod" onclick="searchSingleProduct('<?php echo $produit['book_id']; ?>')"><img class="img-fluid"  src="<?php echo $produit['Image']; ?>"
										alt="<?php echo $produit['Title']; ?>" style="height: 300px; width:300px;">
									<?php if ($produit['Discount'] != 0): ?>
										<span class="status">
											<?php echo $produit['Discount'] . " %OFF"; ?>
										</span>
									<?php endif; ?>

									<div class="overlay"></div>
								</a>
								<div class="text py-3 pb-4 px-3">
									<div class="d-flex">
										<div class="cat">
											<span>
												<?php echo $produit['Category']; ?>
											</span>
										</div>
									</div>
									<h3><a href="#">
											<?php echo $produit['Title']; ?>
										</a></h3>
									<div class="pricing">
										<p class="price"><span>
												<?php echo ($produit['Price'] - ($produit['Price'] * $produit['Discount'] / 100)) . " DT"; ?>
											</span></p>
										<?php if ($produit['Discount'] != 0): ?>
											<span class="price-sale"><del>
													<?php echo $produit['Price'] . " DT"; ?>
												</del></span>
										<?php endif; ?>

									</div>
									<p class="bottom-area d-flex px-3">
										<!-- <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
													class="ion-ios-add ml-1"></i></span></a> -->
										<?php

										// Vérifiez si la session est vide
										if (!empty($_SESSION['username'])) {

											// La session n'est pas vide, affichez le lien "Add to cart"
											echo '<a href="index.php" class="add-to-cart text-center py-2 mr-1" onclick="addToCart(' . $produit['book_id'] . ')">
                <span>Add to cart <i class="ion-ios-add ml-1"></i></span>
            </a>';
										} else {
											// La session est vide, redirigez vers la page login.php
											echo '<a href="app/views/login.php" class="text-center py-2 mr-1">
                <span>Add to cart <i class="ion-ios-add ml-1"></i></span>
            </a>';
										}
										?>

									</p>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-deal bg-primary">
		<div class="container">
			<div class="row">
				<?php
				$selfHelpProducts = array_filter($produitsALL, function ($produit) {
					return $produit['Category'] === 'Self Help';
				});

				if (!empty($selfHelpProducts)) {
					shuffle($selfHelpProducts);

					$randomSelfHelpProduct = reset($selfHelpProducts);
					?>
					<div class="col-md-6">
						<img class="img-fluid" src="<?php echo $randomSelfHelpProduct['Image']; ?>"
							alt="<?php echo $randomSelfHelpProduct['Title']; ?>" style="height: 400px; width:300px;">
					</div>
					<div class="col-md-6">
						<div class="heading-section heading-section-white">
							<span class="subheading">Deal of the month</span>
							<h2 class="mb-3">Deal of the month</h2>
						</div>


						<div class="text-deal">
							<h2><a href="#">
									<?php echo $randomSelfHelpProduct['Title']; ?>
								</a></h2>
							<p class="price">
								<span class="mr-2 price-dc">
									<?php echo $randomSelfHelpProduct['Price'] . " DT"; ?>
								</span>
								<span class="price-sale">
									<?php echo ($randomSelfHelpProduct['Price'] - ($randomSelfHelpProduct['Price'] * $randomSelfHelpProduct['Discount'] / 100)) . " DT"; ?>
								</span>
							</p>
						</div>

					<?php } ?>
					<div id="timer" class="d-flex mb-4">
						<div class="time" id="days"></div>
						<div class="time pl-4" id="hours"></div>
						<div class="time pl-4" id="minutes"></div>
						<div class="time pl-4" id="seconds"></div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section class="ftco-gallery" style="margin-top: 20px;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 heading-section text-center mb-4 ftco-animate">
					<h2 class="mb-4">Follow Us</h2>
					<p>You can find all of our social media likns below. feel free to join</p>
				</div>
			</div>
		</div>


		<div class="bg-light text-center text-white">
			<!-- Grid container -->
			<div class="container p-4 pb-0">
				<!-- Section: Social media -->
				<section class="mb-4">
					<!-- Facebook -->
					<a class="btn text-white btn-floating m-1" style="background-color: #3b5998;"
						href="https://www.facebook.com/" role="button"><i class="fab fa-facebook-f"></i></a>

					<!-- Twitter -->
					<a class="btn text-white btn-floating m-1" style="background-color: #55acee;"
						href="https://www.x.com/" role="button"><i class="fab fa-twitter"></i></a>

					<!-- Google -->
					<a class="btn text-white btn-floating m-1" style="background-color: #dd4b39;"
						href="https://www.google.com/" role="button"><i class="fab fa-google"></i></a>

					<!-- Instagram -->
					<a class="btn text-white btn-floating m-1" style="background-color: #ac2bac;"
						href="https://www.instagram.com/" role="button"><i class="fab fa-instagram"></i></a>

					<!-- Linkedin -->
					<a class="btn text-white btn-floating m-1" style="background-color: #0082ca;"
						href="https://www.linkedin.com/" role="button"><i class="fab fa-linkedin-in"></i></a>
					<!-- Github -->
					<a class="btn text-white btn-floating m-1" style="background-color: #333333;"
						href="https://www.github.com/" role="button"><i class="fab fa-github"></i></a>
				</section>
				<!-- Section: Social media -->
			</div>

		</div>
	</section>
	<footer class="ftco-footer ftco-section">
		<div class="container">
			<div class="row">
				<div class="mouse">
					<a href="#" class="mouse-icon">
						<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
					</a>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">MyBook.tn</h2>
						<p>The best online BookShop in tunisia where you can find all the books from all over the world
							with the lowest prices
						<p>

					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4 ml-md-5">
						<h2 class="ftco-heading-2">Menu</h2>
						<ul class="list-unstyled">
							<li><a href="app/views/shop.php" class="py-2 d-block">Shop</a></li>
							<li><a href="app/views/about.php" class="py-2 d-block">About</a></li>
							<li><a href="app/views/contact.php" class="py-2 d-block">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Help</h2>
						<div class="d-flex">
							<ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
								<li><a href="#" class="py-2 d-block">Shipping Information</a></li>
								<li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
								<li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
								<li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
							</ul>
							<ul class="list-unstyled">
								<li><a href="app/views/about.php" class="py-2 d-block">FAQs</a></li>
								<li><a href="app/views/contact.php" class="py-2 d-block">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Have a Question?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="icon icon-map-marker"></span><span class="text">Sfax Tunisia</span>
								</li>
								<li><a href="#"><span class="icon icon-phone"></span><span class="text">+216 20 22 03
											04</span></a></li>
								<li><a href="#"><span class="icon icon-envelope"></span><span
											class="text">info@mybook.tn</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">

					<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;
						<script>document.write(new Date().getFullYear());</script> All rights reserved | Made by <a
							href="https://colorlib.com" target="_blank">Houssem Dammak & Yasmine Ghorbel</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- loader -->
	<!-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
				stroke="#F96D00" />
		</svg></div> -->


	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery-migrate-3.0.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.easing.1.3.js"></script>
	<script src="assets/js/jquery.waypoints.min.js"></script>
	<script src="assets/js/jquery.stellar.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<script src="assets/js/aos.js"></script>
	<script src="assets/js/jquery.animateNumber.min.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/scrollax.min.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/xhr.js"></script>
	<script>
		function addToCart(code) {
			var xhr = getXMLHttpRequest();
			var data = new FormData();
			data.append('bookID', code);
			data.append('action', 'addtocart');
			xhr.open("POST", "app/controllers/ControllerCart.php", true);
			xhr.send(data);
			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4) {
					if (xhr.status == 200) {
						console.log("aaaaaaaaa");
					} else {
						console.error('Erreur de la requête AJAX :', xhr.status);
					}
				}
			};
		}
		function searchSingleProduct(code) {
		console.log(code);
		var xhr = getXMLHttpRequest();
		xhr.open("GET", "app/views/product-single.php?code=" + code, true);
		xhr.send();
		xhr.onreadystatechange = function () {
			if ((xhr.readyState == 4) && (xhr.status == 200)) {
				obj.innerHTML = xhr.responseText;


			}
			window.location.href = "app/views/product-single.php?code=" + code;
		}

	}
	</script>
</body>

</html>