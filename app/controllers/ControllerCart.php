<?php  
//error_reporting(0);
$currentFile = basename($_SERVER['PHP_SELF']);
if ($currentFile === 'index.php') {
    require_once 'app\models\ModelCart.php';
    require_once 'app\models\Database.php';
    require_once 'app\controllers\Controller.php';
    require_once 'app\controllers\ControllerSession.php';
} else{
    require_once '..\models\ModelCart.php';
    require_once '..\models\Database.php';
    require_once '..\controllers\Controller.php';
    require_once '..\controllers\ControllerSession.php';
}


class ControllerCart extends Controller {
    private $models;

    public function __construct() {
        $db=Database::getInstance()->getConnection() ;
        $this->models=new ModelCart($db);

    }
    public function index() {
        //$products=$this->models->findAll();
        $controller='commande_details' ;
        //var_dump($products);
        require_once '../../views/home/cart.php' ;
    }
    public function getProducts($username, $commandeid) {
       
        return $this->models->findAll($username,$commandeid);
    }
    public function getCart($products) {
        
        return cart_total($products);
    }
    function update($code,$qte){
        return $this->models->update($code,$qte);
    }
    public function delete($code){
        $this->models->delete($code);
    }
    public function addToCart($code,$username,$commandeid){
        $this->models->addtocart($code,$username,$commandeid);
    }
    public function addToCartFromSingleProduct($code,$username,$qte,$commandeid){
        $this->models->addToCartFromSingleProduct($code,$username,$qte,$commandeid);
    }
    public function checkout($commandeid,$user_id){
        return $this->models->checkout($commandeid,$user_id);
    }
    public function checkoutwithoutdelete($commandeid,$user_id){
        return $this->models->checkoutwithoutdelete($commandeid,$user_id);
    }
    public function  deleteFromTable($commandeID, $userID){
        $this->models->deleteFromTable($commandeID, $userID);

    }

}
//require_once '../../views/home/cart1.php' ;
$controller = new ControllerCart();
ControllerSession::startSession() ;
//$username=$_SESSION['username'];
//$user_id=$_SESSION['user_id'];
//var_dump($username,$user_id);
//$_SESSION['commandeID']='7';
//var_dump($_SESSION['commandeID']);

if(isset($_SESSION['username'])&&isset($_SESSION['commandeID'])){
    $username=$_SESSION['username'];
    $user_id=$_SESSION['user_id'];
    $commandeID=$_SESSION['commandeID'];
    //var_dump($commandeID);

    if (!isset($_POST['id_cd']) && !isset($_POST['quantity']) && !isset($_POST['rowId'])) {
        $products = $controller->getProducts($username,$commandeID);
        $cartData= $controller->getCart($products);
        //var_dump($cartData) ;
    if(isset($_POST['action'])){
    if($_POST['action']==='addtocart' &&isset($_POST['bookID'])){
        $controller->addToCart($_POST['bookID'],$user_id, $commandeID);
    }   
    } 
    if(isset($_POST['actionSP'])){
        if($_POST['actionSP']==='addtocartSP' && isset($_POST['bookID']) && isset($_POST['qte'])){            
            $controller->addToCartFromSingleProduct($_POST['bookID'],$user_id,$_POST['qte'],$commandeID);
        }   
        }     
    }

    if(isset($_POST['checkout'])){
        if($_POST['checkout']==='checkout' && isset($_POST['commandeID'])){            
            $newcommandeID=$controller->checkout($_POST['commandeID'],$user_id);
            $controller->deleteFromTable($_POST['commandeID'], $user_id);
            $_SESSION['commandeID']=$newcommandeID['commande_id'];
            //var_dump($newcommandeID);
        }
    }  
        ///////////////////////////////////////////////////////////////////////////////////////////////// 
        if(isset($_POST['checkoutwithoutdelete'])){
            if($_POST['checkoutwithoutdelete']==='checkoutwithoutdelete' && isset($_POST['commandeID'])){            
                $newcommandeID=$controller->checkoutwithoutdelete($_POST['commandeID'],$user_id);
                //$controller->deleteFromTable($_POST['commandeID'], $user_id);
                $_SESSION['commandeID']=$newcommandeID['commande_id'];
                //var_dump($newcommandeID);
            } 
     ///////////////////////////////////////////////////////////////////////////////////////////////// 
    
    }elseif (isset($_POST['id_cd']) && isset($_POST['quantity'])) {
        
        $codeToUpdate = $_POST['id_cd'];
        $updateData = $_POST['quantity'];
        //var_dump($codeToUpdate, $updateData);

        $controller->update($codeToUpdate, $updateData);
        $newproducts = $controller->getProducts($username,$commandeID);
        //var_dump($newproducts);
        echo json_encode(['success' => true, 'newproducts' => $newproducts]);
        //var_dump($newproducts);
    } elseif (isset($_POST['rowId'])){
            $code = $_POST['rowId'];
            //var_dump($code);
            //error_log("Row ID: " . $code); // Vérifiez le journal des erreurs

            $controller->delete($code);
            $newproducts = $controller->getProducts($username,$commandeID);
            $count = count($newproducts);
            echo json_encode(['success' => true, 'newproducts' => $newproducts,'count'=>$count]);

    } else {
            // Gérer le cas où les paramètres sont manquants
            //echo json_encode(['error' => 'Paramètres manquants']);
    }
    
}else{
    $username='';
    $products = array();
}

?>