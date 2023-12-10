<?php
require_once "../controllers/ControllerShop.php";
$itemsPerPage = 40;
$totalItems = count($filteredProducts);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $itemsPerPage;
$itemsOnPage = array_slice($filteredProducts, $start, $itemsPerPage);
session_start();
?>
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-10 order-md-last">
                <div class="row" id="new-category">
                    <?php foreach ($itemsOnPage as $produit): ?>
                        <div class="col-sm-12 col-md-12 col-lg-4  d-flex">
                            <div class="product d-flex flex-column">
                                <a href="#" class="img-prod"
                                    onclick="searchSingleProduct('<?php echo $produit['book_id']; ?>')"><img
                                        class="img-fluid" src="<?php echo '../../' . $produit['Image']; ?>"
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
                                        <!-- <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                    class="ion-ios-add ml-1"></i></span></a> -->
                                        <?php
                                        //var_dump($_SESSION['username']);
                                        
                                        //var_dump($_SESSION);
                                        // Vérifiez si la session est vide
                                        if (!empty($_SESSION['username'])) {

                                            // La session n'est pas vide, affichez le lien "Add to cart"
                                            echo '<a href="#" class="add-to-cart text-center py-2 mr-1" onclick="addToCart(' . $produit['book_id'] . ')">
                <span>Add to cart <i class="ion-ios-add ml-1"></i></span>
            </a>';
                                        } else {
                                            //$_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
                                            if (strpos($_SERVER['REQUEST_URI'], 'filter_shop.php?') !== false) {
                                                $_SESSION['redirect_url'] = '/mybooktnNew/app/views/shop.php#';
                                            } else {
                                                $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
                                            }
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
                                                    <li><a href="#" data-value="<?php echo $category['category_name']; ?>"
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
<script>
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
                    //window.location.reload(true);

                } else {
                    console.error('Erreur de la requête AJAX :', xhr.status);
                }
            }
        };
    }
</script>