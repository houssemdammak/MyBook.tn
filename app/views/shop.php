<?php
require 'header.php';
require_once '../controllers/ControllerShop.php';
?>
<style>
	.search {
		width: 100%;
		height: 10%;
		background-color: transparent;
		padding: .8rem 1rem;
		margin-top: 40px;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.search .input-group {
		width: 35%;
		height: 100%;
		background-color: #fff5;
		padding: 0 .8rem;
		border-radius: 2rem;

		display: flex;
		justify-content: center;
		align-items: center;

		transition: .2s;
	}

	.search .input-group:hover {
		width: 45%;
		background-color: #fff8;
		box-shadow: 0 .1rem .4rem #0002;
	}

	.search .input-group img {
		width: 1.2rem;
		height: 1.2rem;
	}

	.search .input-group input {
		width: 100%;
		padding: 0 .5rem 0 .3rem;
		background-color: transparent;
		border: none;
		outline: none;
	}
</style>
<div class="hero-wrap hero-bread" style="background-image: url('../../assets/images/books-shop_bg.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-0 bread">Books Shop</h1>
			</div>
		</div>
	</div>
	<div class="search">
		<div class="input-group">
			<input type="search" name="produitName" placeholder="Search Book..." onChange="searchProduct(this.value)">
		</div>
	</div>
</div>

<!-- product-single.php?Title=<?php echo urlencode($produit['Title']); ?> -->
<div id="jdida">
	<?php
	$itemsPerPage = 9;
	$totalItems = count($produitsALL);
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $itemsPerPage;
	$itemsOnPage = array_slice($produitsALL, $start, $itemsPerPage);
	?>

	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-10 order-md-last">
					<div class="row">
						<?php foreach ($itemsOnPage as $produit): ?>
							<div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
								<div class="product d-flex flex-column">
									<a href="#" class="img-prod"
										onclick="searchSingleProduct('<?php echo $produit['book_id']; ?>')">
										<img class="img-fluid" src="<?php echo '../../' . $produit['Image']; ?>"
											alt="<?php echo $produit['Title']; ?>" style="height: 300px; width:250px;">
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
											<div class="rating">
												<p class="text-right mb-0">
													<a href="#"><span class="ion-ios-star-outline"></span></a>
													<a href="#"><span class="ion-ios-star-outline"></span></a>
													<a href="#"><span class="ion-ios-star-outline"></span></a>
													<a href="#"><span class="ion-ios-star-outline"></span></a>
													<a href="#"><span class="ion-ios-star-outline"></span></a>
												</p>
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
											<?php
											// Vérifiez si la session est vide
											if (!empty($_SESSION['username'])) {

												// La session n'est pas vide, affichez le lien "Add to cart"
												echo '<a href="#" class="add-to-cart text-center py-2 mr-1" onclick="addToCart(' . $produit['book_id'] . ')">
                <span>Add to cart <i class="ion-ios-add ml-1"></i></span>
            </a>';
											} else {
												$_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];

												// La session est vide, redirigez vers la page login.php
												echo '<a href="login.php" class="add-to-cart text-center py-2 mr-1">
                <span>Add to cart <i class="ion-ios-add ml-1"></i></span>
            </a>';
											}
											?>

										</p>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="row mt-5">
						<div class="col text-center">
							<div class="block-27">
								<ul>
									<?php
									$totalPages = ceil($totalItems / $itemsPerPage);

									// Create pagination links
									for ($i = 1; $i <= $totalPages; $i++) {
										echo '<li ' . ($page == $i ? 'class="active"' : '') . '><a href="?page=' . $i . '">' . $i . '</a></li>';
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-lg-2">
					<div class="sidebar">
						<div class="sidebar-box-2">
							<h2 class="heading"><a href="shop.php">Categories</a></h2>
							<div class="fancy-collapse-panel">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingOne">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
													aria-expanded="true" aria-controls="collapseOne">Types
												</a>
											</h4>
										</div>
										<div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
											aria-labelledby="headingOne">
											<div class="panel-body">
												<ul>
													<?php foreach ($categoriesNames as $category): ?>
														<li><a href="#"
																data-value="<?php echo $category['category_name']; ?>"
																onclick="searchPropositions(this.getAttribute('data-value'))">
																<?php echo $category['category_name']; ?>
															</a>
														</li>
													<?php endforeach; ?>

												</ul>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingTwo">
											<h4 class="panel-title">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion"
													data-value="Highlight"
													onclick="searchPropositions(this.getAttribute('data-value'))"
													href="#collapseTwo" aria-expanded="false"
													aria-controls="collapseTwo">Highlights
												</a>
											</h4>
										</div>
										<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
											aria-labelledby="headingTwo">

										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingThree">
											<h4 class="panel-title">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion"
													href="#collapseThree" data-value="New in store"
													onclick="searchPropositions(this.getAttribute('data-value'))"
													aria-expanded="false" aria-controls="collapseThree">New In store
												</a>
											</h4>
										</div>
										<div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
											aria-labelledby="headingThree">
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingThree">
											<h4 class="panel-title">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion"
													href="#collapseThree" data-value="Our Promotion"
													onclick="searchPromotions(this.getAttribute('data-value'))"
													aria-expanded="false" aria-controls="collapseThree">Our Promotions
												</a>
											</h4>
										</div>
										<div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
											aria-labelledby="headingThree">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	function searchPropositions(code) {
		var xhr = getXMLHttpRequest();
		obj = document.getElementById("jdida");
		xhr.withCredentials = true; // Inclure les cookies

		obj.innerHTML = "";

		xhr.open("GET", "filter_shop.php?code=" + code, true);
		xhr.send();
		xhr.onreadystatechange = function () {
			if ((xhr.readyState == 4) && (xhr.status == 200)) {
				obj.innerHTML = xhr.responseText;
			}
		}

	}
	function searchPromotions(code) {
		var xhr = getXMLHttpRequest();
		obj = document.getElementById("jdida");
		xhr.withCredentials = true; // Inclure les cookies

		obj.innerHTML = "";

		xhr.open("GET", "filter_shop.php?codePromotion=" + code, true);
		xhr.send();
		xhr.onreadystatechange = function () {
			if ((xhr.readyState == 4) && (xhr.status == 200)) {
				obj.innerHTML = xhr.responseText;
			}
		}

	}

	function searchSingleProduct(code) {
		var xhr = getXMLHttpRequest();
		xhr.open("GET", "product-single.php?code=" + code, true);
		xhr.send();
		xhr.onreadystatechange = function () {
			if ((xhr.readyState == 4) && (xhr.status == 200)) {
				obj.innerHTML = xhr.responseText;


			}
			window.location.href = "product-single.php?code=" + code;
		}

	}
	function addToCart(code) {
		var xhr = getXMLHttpRequest();
		var data = new FormData();

		data.append('bookID', code);
		data.append('action', 'addtocart');
		xhr.open("POST", "../controllers/ControllerCart.php", true);
		xhr.send(data);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4) {
				if (xhr.status == 200) {
					console.log("aaaaaaaaa");
					window.location.reload(true);

				} else {
					console.error('Erreur de la requête AJAX :', xhr.status);
				}
			}
		};
	}

</script>
<script type="text/javascript">
	function searchProduct(code) {
		var xhr = getXMLHttpRequest();
		obj = document.getElementById("jdida");
		obj.innerHTML = "";
		xhr.open("GET", "search.php?codeSearch=" + code, true);
		xhr.send();
		xhr.onreadystatechange = function () {
			if ((xhr.readyState == 4) && (xhr.status == 200)) {
				obj.innerHTML = xhr.responseText;
			}
		}
	}
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<?php
require 'footer.php';
?>