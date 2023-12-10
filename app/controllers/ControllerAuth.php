<?php
//error_reporting(0);
$currentFile = basename($_SERVER['PHP_SELF']);
if ($currentFile === 'index.php') {
    require_once 'app\models\ModelAuth.php';
    require_once 'app\models\Database.php';
    require_once 'app\controllers\Controller.php';
    require_once 'app\controllers\ControllerSession.php';

} else {
    require_once '..\models\ModelAuth.php';
    require_once '..\models\Database.php';
    require_once '..\controllers\Controller.php';
    require_once '..\controllers\ControllerSession.php';

}


class ControllerAuth extends Controller
{
    private $models;

    public function __construct()
    {
        $db = Database::getInstance()->getConnection();
        $this->models = new ModelAuth($db);

    }
    public function index()
    {
        //$products = $this->models->findAll();
        $controller = 'users';
        //var_dump($products);
        require_once '../../views/login.php';
    }
    public function loginUser($email, $password)
    {

        $user = $this->models->selectUserByEmail($email);
        $user = call_user_func_array('array_merge', $user);
        //var_dump($user);

        // Gérer le statut de connexion
        if ($user) {
            $dbemail = $user['email'];
            $dbfullname = $user['fullname'];
            $dbpassword = $user['password'];
            if (($dbemail == $email && password_verify($password, $dbpassword)) || ($dbfullname == $email && password_verify($password, $dbpassword))) {
                $login = true;
            } else {
                $login = false;
            }
        } else {
            $login = false;
        }
        return $login;
    }
    public function getfullname($email){
        $user = $this->models->selectUserByEmail($email);
        $user = call_user_func_array('array_merge', $user);
        return $user;

    }
    public function createCommande($userid){
        $commandeID=$this->models->createCommande($userid);
        return $commandeID ;
    }
    public function insertUser($fullname, $email, $password)
    {
        $this->models->insertUser($fullname, $email, $password);
    }
    public function verifyEmail($email){
        $emails=$this->models->getEmails();
        $emailExists = false;
        foreach ($emails as $emailArray) {
            // Vérifier si l'email existe dans le tableau
            if (isset($emailArray['email']) && $emailArray['email'] === $email) {
                $emailExists = true;
                break; // Si l'email est trouvé, sortir de la boucle
            }
        }
        return $emailExists;
    }
}
$controller = new ControllerAuth();
ControllerSession::startSession();
$loginError = '';
$fullnameError = $emailError = $passwordError = $RepasswordError = "";
$fullname = $email = $password = $Repassword = "";
// if(isset($_SESSION['redirect_url'])){
//     var_dump($_SESSION['redirect_url']);

// }
if (isset($_POST['form_source']) && $_POST['form_source'] === 'login') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $remember = isset($_POST['remember']);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $loginError = '';
        if ($controller->loginUser($username, $password)) {
            $user=$controller->getfullname($username);
            $commandeID=$controller->createCommande($user['user_id']);
            $_SESSION['username'] = $user['fullname'];
            $_SESSION['password'] = $password;
            $_SESSION['user_id']= $user['user_id'];
            $_SESSION['commandeID']=$commandeID;
            
            // Vérification de l'option "Remember me"
            if ($remember) {
                // Créez une session pour l'utilisateur
                setcookie('username', $username, time() + 30 * 86400, "/");
                setcookie('password', $password, time() + 30 * 86400, "/");

            } else {
                setcookie('username', '', time() - 3600, "/");
                setcookie('password', '', time() - 3600, "/");
            }
            if (!empty($_SESSION['redirect_url']) ) {
                header('Location: ' . $_SESSION['redirect_url']);
                exit;
            } else {
                // Si $_SESSION['redirect_url'] n'est pas défini, redirigez l'utilisateur vers une page par défaut
                header('Location: ../../index.php');
                exit;
            }            

        } else {
            $loginError = "Username or Password wrong";
        }
    }
}
if(isset($_POST['action']) && $_POST['action'] === 'lougout'){
    ControllerSession::destroySession();

        header('Location: index.php');
        exit;
}
if (isset($_POST['form_source']) && $_POST['form_source'] === 'signup') {


    // Vérifiez s'il y a des données dans les cookies
    if (isset($_COOKIE['fullname'])) {
        $fullname = $_COOKIE['fullname'];
    }

    if (isset($_COOKIE['email'])) {
        $email = $_COOKIE['email'];
    }

    // Vérifiez si des données ont déjà été soumises
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $Repassword = $_POST['Repassword'];
    if (empty($fullname)) {
        $fullnameError = "Full Name is required";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Email address is not valid";
    }

    if (empty($password) || !preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        $passwordError = "Password must be at least 8 characters, including letters and numbers";
    }

    if (empty($Repassword) || $password !== $Repassword) {
        $RepasswordError = "Passwords do not match. Please try again";
    }
    if(($controller->verifyEmail($email))&& !(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))){
        $emailError = "Email already exists";

    }
    if (empty($fullnameError) && empty($emailError) && empty($passwordError) && empty($RepasswordError)) {
        // Toutes les données sont valides, vous pouvez traiter l'inscription ici
        $controller->insertUser($fullname, $email, $password);
        // Supprimez les cookies après une soumission réussie
        $user=$controller->getfullname($email);
        $_SESSION['username'] = $fullname;
        $_SESSION['password'] = $password;
        $_SESSION['user_id']= $user['user_id'];
        //$commandeID=$controller->createCommande($user['user_id']);
        if (!empty($user['user_id'])) {
            // Proceed to create a new command
            $commandeID = $controller->createCommande($user['user_id']);
            $_SESSION['commandeID']=$commandeID;

        }
            
            
        setcookie('fullname', '', time() - 3600);
        setcookie('email', '', time() - 3600);
        header('Location: ../../index.php ');
        if (!empty($_SESSION['redirect_url'])) {
            header('Location: ' . $_SESSION['redirect_url']);
            exit;
        } else {
            // Si $_SESSION['redirect_url'] n'est pas défini, redirigez l'utilisateur vers une page par défaut
            header('Location: ../../index.php');
            exit;
        }
  
    }
    
}