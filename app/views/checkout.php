<?php
require 'header.php';
require_once '..\controllers\ControllerCart.php';

?>
<style>
	/* Styles for the popup and payment form */
	.popup {
		font-family: Arial, Helvetica, sans-serif;
		display: none;
		position: fixed;
		z-index: 1;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		overflow: auto;
		background-color: rgba(0, 0, 0, 0.4);
	}

	.popup .payment-form {
		width: 500px;
		margin: 150px auto;
		padding: 20px;
		background-color: #fff;
		border: 1px solid #ccc;
		border-radius: 5px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	.popup h2 {
		text-align: center;
	}

	.popup .form-group {
		margin-bottom: 15px;
	}

	.popup .form-group label {
		display: block;
		font-weight: bold;
	}

	.popup .form-group input[type="text"] {
		width: calc(100% - 20px);
		padding: 8px;
		border-radius: 4px;
		border: 1px solid #ccc;
	}

	.popup .form-group button {
		background-color: #dbcc8f;
		color: white;
		padding: 10px 15px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		width: 100%;
		font-size: 16px;
	}

	.popup .form-group button:hover {
		background-color: black;
	}

	.popup .close {
		color: #aaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	.popup .close:hover,
	.popup .close:focus {
		color: black;
		text-decoration: none;
		cursor: pointer;
	}
</style>
<div class="hero-wrap hero-bread" style="background-image: url('../../assets/images/checkout_bg.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2">
						<h1 class="mb-0 bread">Checkout</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 ftco-animate">
				<form action="email.php"
					onsubmit="getContentAndSendEmail(); handlePayment(); reset(); return false;"
					class="billing-form" method="post">
					<?php //!empty($_SESSION['commandeID']) ? $_SESSION['commandeID'] : ''; ?>
					<h3 class="mb-4 billing-heading">Billing Details</h3>
					<div class="row align-items-end">
						<div class="col-md-6">
							<div class="form-group">
								<label for="firstname">First Name</label>
								<input type="text" name="firstName" class="form-control" placeholder="" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="lastname">Last Name</label>
								<input type="text" name="lastName" class="form-control" placeholder="" required>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="country">State / Country</label>
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="" id="" class="form-control">
										<option value="">France</option>
										<option value="">Italy</option>
										<option value="">Philippines</option>
										<option value="">South Korea</option>
										<option value="">Tunisia</option>
										<option value="">Japan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="streetaddress">Street Address</label>
								<input type="text" class="form-control" placeholder="House number and street name"
									required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control"
									placeholder="Appartment, suite, unit etc: (optional)">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="towncity">Town / City</label>
								<input type="text" class="form-control" placeholder="" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="postcodezip">Postcode / ZIP *</label>
								<input type="text" class="form-control" placeholder="">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="text" class="form-control" placeholder="" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="emailaddress">Email Address</label>
								<input type="text" name="email" class="form-control" placeholder="" required>
							</div>
						</div>
						<div class="w-100"></div>

					</div>
					<!-- END -->



					<div class="row mt-5 pt-3 d-flex">
						<div class="col-md-6 d-flex">
							<div class="cart-detail cart-total bg-light p-3 p-md-4">
								<h3>Cart Totals</h3>
								<!-- Subtotal -->
								<p class="d-flex">
									<span>Subtotal</span>
									<span id="subtotal">
										<?php
										if (isset($cartData['Total'])) {
											echo number_format($cartData['Total'], 2) . 'D';
										} else {
											echo '0.00D';
										}
										?>
									</span>
								</p>
								<!-- Delivery -->
								<p class="d-flex">
									<span>Delivery</span>
									<span>0.00 D</span>
								</p>
								<!-- Discount -->
								<p class="d-flex">
									<span>Discount</span>
									<span id="discount">
										<?php //echo number_format($cartData['Total Discount Amount'], 2).'D'; 
										if (isset($cartData['Total Discount Amount'])) {
											echo number_format($cartData['Total Discount Amount'], 2) . 'D';
										} else {
											echo '0.00D';
										}
										?>
									</span>

								</p>
								<hr>
								<!-- Total -->
								<p class="d-flex total-price">
									<span>Total</span>
									<span id="totalPrice">
										<?php // echo number_format($cartData['Total Discounted Price'], 2).'D';
										if (isset($cartData['Total Discounted Price'])) {
											echo number_format($cartData['Total Discounted Price'], 2) . 'D';
										} else {
											echo '0.00D';
										}
										?>
									</span>
								</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="cart-detail bg-light p-3 p-md-4">
								<h3 class="billing-heading mb-4">Payment Method</h3>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input type="radio" value="Bank Tranfer" name="paymentMethod"
													class="mr-2" required > Bank Tranfer</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input type="radio" value="Direct Transfer" name="paymentMethod"
													class="mr-2"> Direct Transfer</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="radio">
											<label><input type="radio" value="Paypal" name="paymentMethod"
													id="paypalRadio" class="mr-2">Paypal</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<div class="checkbox">
											<label><input type="checkbox" value="" class="mr-2"> I have read and accept
												the
												terms and conditions</label>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary py-3 px-4">Place an order</button>

							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<div id="paypalPopup" class="popup">
	<div class="payment-form">
		<span class="close" onclick="closePaypalPopup()">&times;</span>

		<center>
			<img src="../../assets/images/paypal1.png" style="width:230px;height:50px; " alt="paypal">

		</center>
		<form id="paypalForm">
			<div class="form-group">
				<label for="cardNumber">Card Number:</label>
				<input type="text" id="cardNumber" name="cardNumber" placeholder="Enter card number (8 digits)"
					pattern="[0-9]{8}" required>
				<small>Must be 8 digits</small>
			</div>
			<div class="form-group">
				<label for="expirationDate">Expiration Date (MM/YY):</label>
				<input type="text" id="expirationDate" name="expirationDate" placeholder="Enter expiration date (MM/YY)"
					pattern="(0[1-9]|1[0-2])\/\d{2}" required>
				<small>Format: MM/YY</small>
			</div>
			<div class="form-group">
				<label for="csc">CSC (3 digits):</label>
				<input type="text" id="csc" name="csc" placeholder="Enter CSC (3 digits)" pattern="[0-9]{3}" required>
				<small>Must be 3 digits</small>
			</div>
			<div class="form-group">
				<button type="submit" onclick="submitPayment()">Pay with PayPal</button>
			</div>
		</form>
	</div>

</div>
<!-- ---------------------------------------------------------------------------------- -->
<div id="bankPopup" class="popup">
	<div class="payment-form">
		<span class="close" onclick="closeBankPopup()">&times;</span>

		<center>
			<img src="../../assets/images/mastercard.png" style="width:230px;height:50px; " alt="paypal">

		</center>
		<form id="BankForm">
			<div class="form-group">
				<label for="cardNumber">Card Number:</label>
				<input type="text" id="cardNumber" name="cardNumber" placeholder="Enter card number (8 digits)"
					pattern="[0-9]{8}" required>
				<small>Must be 8 digits</small>
			</div>
			<div class="form-group">
				<label for="expirationDate">Expiration Date (MM/YY):</label>
				<input type="text" id="expirationDate" name="expirationDate" placeholder="Enter expiration date (MM/YY)"
					pattern="(0[1-9]|1[0-2])\/\d{2}" required>
				<small>Format: MM/YY</small>
			</div>
			<div class="form-group">
				<label for="csc">CSC (3 digits):</label>
				<input type="text" id="csc" name="csc" placeholder="Enter CSC (3 digits)" pattern="[0-9]{3}" required>
				<small>Must be 3 digits</small>
			</div>
			<div class="form-group">
				<button type="submit" onclick="submitPayment()">Pay with MasterCard</button>
			</div>
		</form>
	</div>

</div>
<?php
require 'footer.php';
?>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <script>
function getContentAndSendEmail() {
	Email.send({
	SecureToken : "8cc45a11-e15e-4815-9647-c546897497c1",
	To : 'dammak.houssem@enis.tn',
	From : "houssemdammak2001@gmail.com",
	Subject : "This is the subject",
	Body : "And this is the body"
}).then(
  message => alert(message)
);
		}
	</script> -->

<script>
	function handlePayment() {
  var paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
  console.log(paymentMethod);

  if (paymentMethod === "Paypal" || paymentMethod === "Bank Tranfer") {
    checkout('<?php echo !empty($_SESSION['commandeID']) ? $_SESSION['commandeID'] : ''; ?>');
  } else {
    checkoutwithoutdelete('<?php echo !empty($_SESSION['commandeID']) ? $_SESSION['commandeID'] : ''; ?>');
  }
}
function checkoutwithoutdelete(commandeid){
	var xhr = getXMLHttpRequest();
		var data = new FormData();
		data.append('checkoutwithoutdelete', 'checkoutwithoutdelete');
		data.append('commandeID', commandeid);
		xhr.open("POST", "../controllers/ControllerCart.php", true);
		xhr.send(data);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4) {
				if (xhr.status == 200) {
					//console.log("aaaaaaaaa");
					//;
				} else {
					console.error('Erreur de la requête AJAX :', xhr.status);
				}
			}
		};
}
	function checkout(commandeid) {
		var xhr = getXMLHttpRequest();
		var data = new FormData();
		data.append('checkout', 'checkout');
		data.append('commandeID', commandeid);
		xhr.open("POST", "../controllers/ControllerCart.php", true);
		xhr.send(data);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4) {
				if (xhr.status == 200) {
					console.log("aaaaaaaaa");
					//;
				} else {
					console.error('Erreur de la requête AJAX :', xhr.status);
				}
			}
		};
	}
	function getContentAndSendEmail() {
		var ToEmail=document.querySelector('input[name="email"]').value;
		var firstName = document.querySelector('input[name="firstName"]').value;
		var lastName = document.querySelector('input[name="lastName"]').value;
		var paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
		var totalPrice=document.getElementById('totalPrice').textContent ;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				var emailContent = this.responseText;

				Email.send({
					SecureToken: "13cccd5c-7af3-4f58-a183-09613c7db53f",
					To: ToEmail,
					From: "houssemdammak2001@gmail.com",
					Subject: "MyBook.tn Purchase validated",
					Body: emailContent
				}).then(function (message) {
            Swal.fire({
                title: 'Email Sent!',
                text: 'The email has been sent successfully to ' + ToEmail,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function () {
                location.reload();
            });
        })
        }
    };
		xhttp.open("POST", "email.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("firstName=" + firstName + "&lastName=" + lastName + "&paymentMethod=" + paymentMethod + "&totalPrice=" + totalPrice);

	}


	/*------------------------------------------------Pop up Payment------------------------------------------------------------------ */
	function closeBankPopup() {
		var popup = document.getElementById("bankPopup");
		popup.style.display = "none";
	}
	function closePaypalPopup() {
		var popup = document.getElementById("paypalPopup");
		popup.style.display = "none";
	}
	document.addEventListener("DOMContentLoaded", function () {
		document.getElementById("BankForm").addEventListener("submit", function (event) {
			event.preventDefault();


			closeBankPopup();
		});
	});
	document.addEventListener("DOMContentLoaded", function () {
		document.getElementById("paypalForm").addEventListener("submit", function (event) {
			event.preventDefault();


			closePaypalPopup();
		});
	});

	$(document).ready(function () {

		function openPaypalPopup() {
			var popup = document.getElementById("paypalPopup");
			popup.style.display = "block";
		}
		function openMastercardPopup() {
			var popup = document.getElementById("bankPopup");
			popup.style.display = "block";
		}

		$('input[type="radio"][value="Paypal"]').change(function () {

			openPaypalPopup();

		});
		$('input[type="radio"][value="Bank Tranfer"]').change(function () {
			openMastercardPopup();

		});

		function closePaypalPopup() {
			var popup = document.getElementById("paypalPopup");
			popup.style.display = "none";
		}
		function closeBankPopup() {
			var popup = document.getElementById("bankPopup");
			popup.style.display = "none";
		}

		$('.close').click(function () {
			closePaypalPopup();
		});
		$('.close').click(function () {
			closeBankPopup();
		});


	});
	/*-------------------------------------------------------------------------------------------------------------------------------- */
</script>


</body>

</html>