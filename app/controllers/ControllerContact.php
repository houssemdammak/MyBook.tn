<?php

require_once '..\models\ModelContact.php';
require_once '..\models\Database.php';
require_once 'Controller.php';

class ControllerContact extends Controller
{
    private $models;

    public function __construct()
    {
        $db = Database::getInstance()->getConnection();
        $this->models = new ModelContact($db);

    }
    public function index()
    {
        $controller = 'contact';
    }
 
    public function AddContact($name, $email, $subject, $message)
    {
        $this->models->AddContact($name, $email, $subject, $message);
    }

}
$controller = new ControllerContact();
/*------------------------------------Add contact-------------------------------------------*/

if (($_SERVER['REQUEST_METHOD'] === 'POST') && (isset($_POST['name_contact']))) {
    $name = $_POST['name_contact'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $controller->AddContact($name, $email, $subject, $message);
    header("location: ../../index.php");

}
?>