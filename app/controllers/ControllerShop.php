<?php  
require_once '../models/ModelShop.php';
require_once '../models/Database.php';
require_once '../controllers/Controller.php';
require_once '../controllers/ControllerSession.php';
class ControllerShop extends Controller {   
    private $models;
    public function __construct() {
        $db=Database::getInstance()->getConnection() ;
        $this->models=new ModelShop($db);

    }
    public function index() {
        require_once ('shop.php') ;
        return $produits;
    }

    public function getProduitsfindAllProducts() {
        return $this->models->findAllProducts();
    }

    public function getProduitsfindAllCategories() {
        return $this->models->findAllCategories();
    }
    public function searchProduct($search) {
        return $this->models->searchProduct($search);
    
    }

}

$controller = new ControllerShop();
$produitsALL=$controller->getProduitsfindAllProducts();
$categoriesNames=$controller->getProduitsfindAllCategories();
//var_dump($_SESSION['username']);
//$produitsALL = $controller->getProduitsfindAllProducts(); // Fetch all products

$filteredProducts = [];
if (isset($_GET['code'])) {
    $selectedCategory = $_GET['code'];
    $filteredProducts = array_filter($produitsALL, function ($produit) use ($selectedCategory) {
        return $produit['Category'] === $selectedCategory;
    });

}
if (isset($_GET['codePromotion'])) {
    $selectedCategory = $_GET['codePromotion'];
    $filteredProducts = array_filter($produitsALL, function ($produit) use ($selectedCategory) {
        return $produit['Discount'] != 0;
    });

}
/*-------------------button search-----------------*/
if (isset($_GET['codeSearch'])) {
    $search = $_GET['codeSearch'];
    $filteredProducts=$controller->searchProduct($search);

}
?>