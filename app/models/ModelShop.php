<?php 
require_once 'Model.php'  ;
class ModelShop extends Model {
   
    public function __construct($db)
    {
        parent::__construct($db, 'books');
    }
    public function save($data)
    {

        try {
            if (isset($data['code'])) {
                $columns = array_keys($data);
                $sets = [];
                $i = 0;
                foreach ($columns as $column) {
                    $sets[$i] = "$column= :$column";
                    $i++;
                }
                $setString = implode(",", $sets);
                $sql = "UPDATE $this->table Set $setString where code =:code";
            } else {
                $colums = implode(', ', array_keys($data));
                $placeholders = ':' . implode(', :', array_keys($data));
                $sql = "INSERT INTO  $this->table ($colums) VALUES ($placeholders)";

            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
        } catch (PDOException $e) {
            die("Error saving data: " . $e->getMessage());
        }
    }
    public function find($code)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['code' => $code]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }
    public function findAllProducts()
    {
        try {
            $joinConditionBCD = 'books.category_id = categories.category_id';
            $joinConditionBP = 'books.promotion_id = promotions.promotion_id';
            $columnsBCD = ' books.book_id,
                            books.title AS Title, 
                            books.author_name as Author,
                            books.price AS "Price",
                            books.stock_statut AS Statut,
                            books.image_path AS Image,
                            books.description as Description,
                            books.stock AS Stock,
                            categories.category_name as Category,
                            promotions.discount AS Discount  
                          ';
            $whereCD = "";

            $resultBCD = $this->joinThreeTables('books', 'categories', 'promotions', $joinConditionBCD, $joinConditionBP, $columnsBCD,$whereCD);
            return $resultBCD;
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des données : " . $e->getMessage());
        }
    }
    public function findAllCategories()
    {
        try {
            $sql = "SELECT category_name FROM categories WHERE category_name NOT IN ('Highlight', 'New in store')";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }
    public function searchProduct($title)
    {

        try {
            $joinConditionBCD = 'books.category_id = categories.category_id';
            $joinConditionBP = 'books.promotion_id = promotions.promotion_id';
            $columnsBCD = ' books.book_id,
                            books.title AS Title, 
                            books.author_name as Author,
                            books.price AS "Price",
                            books.stock_statut AS Statut,
                            books.image_path AS Image,
                            books.description as Description,
                            books.stock AS Stock,
                            categories.category_name as Category,
                            promotions.discount AS Discount  
                          ';
                          $whereCD = "books.title LIKE :title"; // Update the condition

                          $params = [':title' => "%$title%"]; // Add the parameter
                  
                          $resultBCD = $this->joinThreeTables('books', 'categories', 'promotions', $joinConditionBCD, $joinConditionBP, $columnsBCD, $whereCD, $params);
                          return $resultBCD;
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des données : " . $e->getMessage());
        }
    }
}

  
?>


