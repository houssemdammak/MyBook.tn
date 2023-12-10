<?php
require_once 'app\models\ModelIndex.php';
require_once 'app\models\Database.php';
require_once 'app\controllers\Controller.php';
require_once 'app\controllers\ControllerSession.php';
class ControllerIndex extends Controller
{
    private $models;
    public function __construct()
    {
        $db = Database::getInstance()->getConnection();
        $this->models = new ModelIndex($db);

    }
    public function index()
    {
        require_once('index.php');
        return $produits;
    }

    public function getProduitsfindAllProducts()
    {
        return $this->models->findAllProducts();
    }

}
$controller = new ControllerIndex();
$produitsALL = $controller->getProduitsfindAllProducts();

//ControllerSession::startSession();
//var_dump($_SESSION['username']);
//var_dump($_SESSION['user_id']);
//var_dump($_SESSION['commandeID']);
?>