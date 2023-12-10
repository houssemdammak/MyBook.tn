<?php
//error_reporting(0);
$currentFile = basename($_SERVER['PHP_SELF']);
//if( ($currentFile === 'dashboard1.php')||($currentFile === 'filter_table.php')) {
require_once '..\..\models\ModelDashboard.php';

require_once '..\..\models\Database.php';
require_once '..\..\controllers\Controller.php';
/*}
 else {
    require_once '..\models\ModelDashboard.php';
    require_once '..\models\Database.php';
    require_once 'Controller.php';
}*/
class ControllerDashboard extends Controller
{
    private $models;

    public function __construct()
    {
        $db = Database::getInstance()->getConnection();
        $this->models = new ModelDashboard($db);

    }
    public function index()
    {
        $products = $this->models->findAll();
        $controller = 'books';
        //var_dump($products);
        require_once '../../views/home/cart.php';
    }
    public function getProducts()
    {
        return $this->models->findAll();
    }
    public function getAllusers()
    {
        return $this->models->getAllusers();
    }
    public function getAllpromotions()
    {
        return $this->models->getAllpromotions();
    }
    public function getAllcategories()
    {
        return $this->models->getAllcategories();
    }
    public function find($code)
    {
        return $this->models->find($code);
    }
    public function UpdateBook($bookID, $title, $price, $author, $category, $promotion, $description, $quantity, $imageFileName)
    {
        $this->models->UpdateBook($bookID, $title, $price, $author, $category, $promotion, $description, $quantity, $imageFileName);
    }
    
    public function AddBook($title, $price, $author, $category, $promotion, $description, $quantity, $imageFileName)
    {
        $this->models->AddBook($title, $price, $author, $category, $promotion, $description, $quantity, $imageFileName);
    }
    public function getCategoryName($categoryID)
    {
        return $this->models->getCategoryName($categoryID);
    }
    public function deleteBook($code)
    {
        return $this->models->deleteBook($code);
    }
    public function UpdatePromo($editPromotionID,$editPromotionName,$editDiscount)
    {
        $this->models->UpdatePromo($editPromotionID,$editPromotionName,$editDiscount);

    }
    public function AddPromo($editPromotionName,$editDiscount)
    {
        $this->models->AddPromo($editPromotionName,$editDiscount);

    }
    public function DeletePromo($promoID)
    {
        $this->models->DeletePromo($promoID);

    }
    public function UpdateCategory($editCategoryID,$editCategoryName)
    {
        $this->models->UpdateCategory($editCategoryID,$editCategoryName);

    }
    public function AddCategory($editCategoryName)
    {
        $this->models->AddCategory($editCategoryName);

    }
    public function DeleteCategory($CategoryID)
    {
        $this->models->DeleteCategory($CategoryID);

    }
    public function UpdateCommande($commandeId, $userId, $status)
    {
        $this->models->UpdateCommande($commandeId, $userId, $status);

    }
    public function getOrders()
    {
        return $this->models->getOrders();

    }
    public function getOrderDetails($commandeID)
    {
        return $this->models->getOrderDetails($commandeID);

    }
    public function DeleteCommande($commandeId)
    {
        $this->models->DeleteCommande($commandeId);

    }
    public function  deleteFromTable($commandeID, $userID){
        $this->models->deleteFromTable($commandeID, $userID);

    }
    public function getAllcontacts()
    {
        return $this->models->getAllcontacts();

    }
    public function searchBook($title)
    {
        return $this->models->searchBook($title);

    }
}

$controller = new ControllerDashboard();
$products = $controller->getProducts();
$users = $controller->getAllusers();
$promotions = $controller->getAllpromotions();
$categories = $controller->getAllcategories();
$orders=$controller->getOrders();
$contacts = $controller->getAllcontacts();
if (isset($_GET['codeB'])) {
    $bookID = $_GET['codeB'];
    $products = call_user_func_array('array_merge', $controller->find($bookID));
    // var_dump($products);
}
/*-------------------button search-----------------*/
if (isset($_GET['codeSearch'])) {
    $search = $_GET['codeSearch'];
    $filteredbooks=$controller->searchBook($search);

}
/*------------------------------------Update Book-------------------------------------------*/
if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['book_id']))) {
    $bookID = $_POST['book_id'];
    $title = $_POST['title'];
    $price = floatval($_POST['price']);
    $author = $_POST['author'];
    $category = $_POST['category'];
    $promotion = $_POST['promotion'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    if ($_FILES['image']['error'] === 0) {
        $imageFileName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imagePath = "assets\images\ " . $imageFileName;
        move_uploaded_file($imageTmpName, $imagePath);
    } else {
        $imageFileName = $_POST['existing_image'];
    }
    $controller->UpdateBook($bookID, $title, $price, $author, $category, $promotion, $description, $quantity, $imageFileName);
    header("location: booksTable.php");

}

/*------------------------------------------Add Book--------------------------------------------*/
if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['book_id_add']))) {
    //$bookID = $_POST['book_id_add'];
    $title = $_POST['title'];
    $price = floatval($_POST['price']);
    $author = $_POST['author'];
    $category = $_POST['category'];
    $categoryName = ($controller->getCategoryName($category))['category_name'];
    $promotion = $_POST['promotion'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $imageFileName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    if ($categoryName == "Highlight" || $categoryName == "New in store") {
        $imagePath = "assets\images\\" . $categoryName . "\\" . $imageFileName;
        $imagePath2 = "C:\wamp64\www\mybooktnNew\assets\images\\" . $categoryName . "\\" . $imageFileName;
    } else {
        $imagePath = "assets\images\Categorie\\" . $categoryName . "\\" . $imageFileName;
        $imagePath2 = "C:\wamp64\www\mybooktnNew\assets\images\Categorie\\" . $categoryName . "\\" . $imageFileName;

    }
    move_uploaded_file($imageTmpName, $imagePath2);
    $controller->AddBook($title, $price, $author, $category, $promotion, $description, $quantity, $imagePath);
    header("location: booksTable.php");

}
/*------------------------------------------Delete Book--------------------------------------------*/

if (isset($_GET['codeBDelete'])) {
    $codeProduit = $_GET['codeBDelete'];
    $controller->deleteBook($codeProduit);
}
if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['codePromoE']))) {
    $bookID = $_POST['book_id'];
    $title = $_POST['title'];
    $price = floatval($_POST['price']);
    $author = $_POST['author'];
    $category = $_POST['category'];
    $promotion = $_POST['promotion'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    if ($_FILES['image']['error'] === 0) {
        $imageFileName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imagePath = "assets\images\ " . $imageFileName;
        move_uploaded_file($imageTmpName, $imagePath);
    } else {
        $imageFileName = $_POST['existing_image'];
    }
    $controller->UpdateBook($bookID, $title, $price, $author, $category, $promotion, $description, $quantity, $imageFileName);
    header("location: booksTable.php");

}
/*------------------------------------Update Book-------------------------------------------*/
//var_dump($_POST);
if (($_SERVER['REQUEST_METHOD'] === 'POST') &&isset($_POST['editPromotionID'])) {
    $editPromotionID = $_POST['editPromotionID'];
    $editPromotionName = $_POST['editPromotionName'];
    $editDiscount = $_POST['editDiscount'];
    $controller->UpdatePromo($editPromotionID,$editPromotionName,$editDiscount);
    var_dump($editDiscount,$editPromotionID,$editPromotionName);
    //exit();
}



?>