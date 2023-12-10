<!DOCTYPE html>
<html lang="en">
<?php
require_once('../controllers/ControllerCart.php') ;
require_once('../controllers/ControllerContact.php');
    ?>

<head>
    <title>MyBook.tn</title>
    <link rel="icon" href="../../assets/images/icon.png" type="image/x-icon" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="../../assets/js/xhr.js" type="text/javascript"></script>

    <link rel="stylesheet" href="../../assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/animate.css">

    <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../../assets/css/magnific-popup.css">

    <link rel="stylesheet" href="../../assets/css/aos.css">

    <link rel="stylesheet" href="../../assets/css/ionicons.min.css">

    <link rel="stylesheet" href="../../assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../assets/css/jquery.timepicker.css">



    <link rel="stylesheet" href="../../assets/css/flaticon.css">
    <link rel="stylesheet" href="../../assets/css/icomoon.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="https://kit.fontawesome.com/df57f43f75.js" crossorigin="anonymous"></script>
</head>

<body class="goto-here">
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="../../index.php"><img src="../../assets/images/logo black.png" alt="logo"
                    width="220" height="80"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="../../index.php" class="nav-link"
                            style="font-size: bold;">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" style="font-size: bold;">Catalog</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="shop.php">Shop</a>
                            <?php if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') { ?>
                                <a class="dropdown-item" href="checkout.php">Checkout</a>
                            <?php }
                            ; ?>
                        </div>
                    </li>
                    <li class="nav-item"><a href="about.php" class="nav-link" style="font-size: bold;">About</a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link" style="font-size: bold;">Contact</a>
                    </li>
                    <?php if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') { ?>

                        <li id="cartItemCount" class="nav-item cta cta-colored"><a
                                href="<?php echo isset($_SESSION['username']) ? 'cart.php' : 'login.php'; ?>"
                                class="nav-link"><span style="font-size:large ;" class="icon-shopping_cart">
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
                    <!-- <li class="nav-item"><a href="login.php" class="nav-link"><span class="icon-user"
                                style="font-size:large ;"></span></a></li> -->

                    <?php


                    if (isset($_SESSION['username'])) {
                        // L'utilisateur est connecté, afficher les informations de l'utilisateur
                        $userFullName = $_SESSION['username'];
                        echo '<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="icon-user" style="font-size:large;"></span>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<p class="dropdown-item">' . $userFullName . '</p>
									<div class="dropdown-divider"></div>
									<a id="logoutBtn" class="dropdown-item" href="logout.php">Deconnexion</a>
								</div>
							</li>';
                    } else {
                        // L'utilisateur n'est pas connecté, afficher le lien de connexion
                        echo '<li class="nav-item"><a href="login.php" class="nav-link"><span class="icon-user" style="font-size: large;"></span></a></li>';
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
                        echo '
                    <li id="cartItemCount" class="nav-item cta cta-colored"><a href="dashboard/booksTable.php"
                            class="nav-link"><span style="font-size:large ;" class="fa-solid fa-desktop">
                            </span>
                        </a></li>';

                    } ?>






                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
</body>

</html>