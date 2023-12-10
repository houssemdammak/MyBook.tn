<?php
require 'header.php';

require_once "../controllers/ControllerShop.php";

$controller = new ControllerShop();
$produitsALL = $controller->getProduitsfindAllProducts();

if (isset($_GET['code'])) {
	$selectedBookId = $_GET['code'];

	foreach ($produitsALL as $book) {
		if ($book['book_id'] == $selectedBookId) {
			$single_product = $book;
			break;
		}
	}
}
?>

<div class="hero-wrap hero-bread" style="background-image: url('../../assets/images/books-shop_bg.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2">
						<h1 class="mb-0 bread">Shop</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mb-5 ftco-animate">
				<a href="#" class="img-prod"><img style="width: 300px;height: 450px;" class="img-fluid"
						src="<?php echo '../../' . $single_product['Image']; ?>"
						alt="<?php echo $single_product['Title']; ?>">

					<div class="overlay"></div>
				</a>
			</div>
			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
				<h3>
					<?php echo $single_product['Title']; ?>
				</h3>
				<div class="rating d-flex">
					<p class="text-left mr-4">
						<a href="#" class="mr-2">5.0</a>
						<a href="#"><span class="ion-ios-star-outline"></span></a>
						<a href="#"><span class="ion-ios-star-outline"></span></a>
						<a href="#"><span class="ion-ios-star-outline"></span></a>
						<a href="#"><span class="ion-ios-star-outline"></span></a>
						<a href="#"><span class="ion-ios-star-outline"></span></a>
					</p>

				</div>
				<p class="price"><span>
						<?php echo ($single_product['Price'] - ($single_product['Price'] * $single_product['Discount'] / 100)) . " DT"; ?>
					</span></p>
				<p>
					<?php echo $single_product['Description']; ?>
				</p>

				<div class="row mt-4">
					<div class="w-100"></div>
					<div class="input-group col-md-6 d-flex mb-3">
						<span class="input-group-btn mr-2">
							<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
								<i class="ion-ios-remove"></i>
							</button>
						</span>
						<input type="text" id="quantity" name="quantity" class="quantity form-control input-number"
							value="1" min="1" max="100">
						<span class="input-group-btn ml-2">
							<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
								<i class="ion-ios-add"></i>
							</button>
						</span>


					</div>
					<div class="w-100"></div>
					<div class="col-md-12">
						<div>
							<span id="error-message" class="error-message" style="font-size: 12px; color: red;"></span>
							<span id="hiddenQuantity" class="hidden-value" style="display: none;" type="hidden">1</span>
						</div>
						<p style="color: #000;">

							<input type="hidden" id="stock" name="stock"
								value="<?php echo $single_product['Stock'] ?> ">

							<?php echo $single_product['Stock']; ?> piece available
						</p>

					</div>
				</div>
				<p>
					<!-- <a href="cart.html" class="btn btn-black py-3 px-5 mr-2">Add to Cart</a> -->
					<?php
					
					// Vérifiez si la session est vide
					if (!empty($_SESSION['username'])) {
						
						// La session n'est pas vide, affichez le lien "Add to cart"
						echo '<a href="#" class="btn btn-black py-3 px-5 mr-2" onclick="addToCart(' . $single_product['book_id'] . ')">
                <span>Add to cart <i class="ion-ios-add ml-1"></i></span>
            </a>';
					} else {
						$_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];

						// La session est vide, redirigez vers la page login.php
						echo '<a href="login.php" class="btn btn-black py-3 px-5 mr-2">
                <span>Add to cart <i class="ion-ios-add ml-1"></i></span>
            </a>';
					}
					?>
				</p>
			</div>
		</div>





	</div>
</section>

<?php
require 'footer.php';
?>
<script>
	var nouvelleValeur = 1;
	function updateNouvelleValeur(value) {
		nouvelleValeur = value;
		$('#hiddenQuantity').text(nouvelleValeur);
	}

	//var nouvelleValeur=1;
	$(document).ready(function () {

		var quantitiy = 0;
		$('.quantity-right-plus').click(function (e) {
			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantityInput = $('#quantity');
			var quantity = parseInt($('#quantity').val());
			var stock = parseInt($('#stock').val());
			var errorMessageElement = $('#error-message');

			if (quantity < stock) {
				errorMessageElement.text('');
				errorMessageElement.removeClass('error-message');
				$('#quantity').val(quantity + 1);
				$('#quantity').text(quantity + 1)
				//var nouvelleValeur = quantityInput.val();
				updateNouvelleValeur(quantityInput.val());

				//console.log("Nouvelle valeur de quantity :", nouvelleValeur);

			} else {
				errorMessageElement.text('Insufficient Stock');
				errorMessageElement.addClass('error-message');
			}
		});

		$('.quantity-left-minus').click(function (e) {
			// Stop acting like a button
			var quantityInput = $('#quantity');
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());
			var quantityInput = $('#quantity');
			var errorMessageElement = $('#error-message');
			//var quantity = parseInt(quantityInput.val());
			// If is not undefined

			// Increment
			if (quantity > 1) {
				errorMessageElement.text('');
				errorMessageElement.removeClass('error-message');
				$('#quantity').val(quantity - 1);
				//var nouvelleValeur = quantityInput.val();
				updateNouvelleValeur(quantityInput.val());

			}

		});

	});


	function addToCart(code) {
		var Quantity =parseInt($('#hiddenQuantity').text());
		//console.log("Nouvelle valeur de quantity :", parseInt(hiddenQuantityValue));
		var xhr = getXMLHttpRequest();
		var data = new FormData();
		data.append('bookID', code);
		data.append('qte', Quantity);
		data.append('actionSP', 'addtocartSP');
		xhr.open("POST", "../controllers/ControllerCart.php", true);
		xhr.send(data);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4) {
				if (xhr.status == 200) {
					console.log("aaaaaaaaa");
					location.reload();
				} else {
					console.error('Erreur de la requête AJAX :', xhr.status);
				}
			}
		};
	}
</script>

</body>

</html>