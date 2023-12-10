<?php
$allowedFiles = ['booksTable.php', 'filter_table.php','searchBook.php','contactUs.php', 'categoriesTable.php', 'commandeTable.php','promotionsTable.php','usersTable.php','UpdateBook.php','AddBook.php'];
$currentFile = basename($_SERVER['PHP_SELF']);
if ($currentFile === 'index.php') {
    require 'config/App.php';
} 

else if (in_array($currentFile, $allowedFiles)) {
    require '../../../config/App.php';
}
else {
    require '../../config/App.php';
}

class DataBase
{
    private static $instance = null;
    private $pdo;
    private $sql;

    private function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=".App::DB_HOST.";dbname=".App::DB_NAME, App::DB_USER, App::DB_PASS);
            // set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connexion établie";
        } catch (PDOException $except) {
            echo "Echec de la connexion: " . $except->getMessage();
            die();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }


    function prepareData($data)
    {
        return $this->pdo->quote($data);
    }

    /*function logIn($table, $email, $password)
    {
        
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        if ($result) {
            $row = $result[0] ;
            if ($row) {
                $dbemail = $row['email'];
                $dbpassword = $row['password'];
                if ($dbemail == $email && password_verify($password, $dbpassword)) {
                    $login = true;
                } else {
                    $login = false;
                }
            } else {
                $login = false;
            }
        } else {
            $login = false;
        }
        //var_dump($result);   
        return $login;
    }*/
    public function signUp($table, $fullname, $email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO $table (fullname, email, password) VALUES (:fullname, :email, :password)");
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        return $stmt->execute();
    }

}

?>