<?php
require_once 'Model.php';
class ModelDashboard extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'books');
    }
    public function findAll()
    {
        try {

            $joinConditionBC = 'books.category_id = categories.category_id';
            $joinConditionBP = 'books.promotion_id = promotions.promotion_id';
            $columnsBCD = 'books.book_id AS "Book ID", 
            books.title AS Title, 
            books.author_name AS "Author Name", 
            books.price AS Price, 
            promotions.discount AS Promotion, 
            books.description AS Description, 
            books.stock_statut AS "Status", 
            books.stock AS Quantity, 
            categories.category_name AS Category,
            books.image_path AS Image';

            // Appliquer la première jointure
            $resultBCD = $this->joinThreeTables('books', 'categories', 'promotions', $joinConditionBC, $joinConditionBP, $columnsBCD);


            return $resultBCD;

        } catch (PDOException $e) {
            die("Erreur lors de la récupération des données : " . $e->getMessage());
        }

    }
    public function delete($code)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE book_id = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['code' => $code]);
        } catch (PDOException $e) {
            die("Error deleting data: " . $e->getMessage());
        }

    }
    public function update($code, $data)
    {
        try {
            $data['code'] = $code;
            $columns = array_keys($data);
            $sets = [];
            $i = 0;
            foreach ($columns as $column) {
                $sets[$i] = "$column = :$column";
                $i++;
            }
            $setString = implode(', ', $sets);

            $sql = "UPDATE $this->table SET $setString WHERE book_id = :code";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($code);
        } catch (PDOException $e) {
            die("Error updating data: " . $e->getMessage());
        }
    }
    public function getAllusers()
    {
        try {
            $columns = 'user_id as "User ID", email as Email ,fullname as Fullname ';
            $sql = "SELECT " . $columns . " FROM users";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }
    public function getAllpromotions()
    {
        try {
            $columns = 'promotion_id as "Promotion ID", 	promo_name as "Promotion Name" ,discount as Discount ';
            $sql = "SELECT " . $columns . " FROM promotions";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }
    public function getAllcommande()
    {
        try {
            $columns = 'commande_id as "Commande ID", 	promo_name as "Promotion Name" ,discount as Discount ';
            $sql = "SELECT " . $columns . " FROM promotions";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }
    public function getAllcategories()
    {
        try {
            $columns = 'category_id  as "Category ID", category_name  as "Category Name" ';
            $sql = "SELECT " . $columns . " FROM categories";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }
    public function UpdateBook($bookID, $title, $price, $author, $category, $promotion, $description, $quantity, $imageFileName)
    {
        $stockStatus = ($quantity == 0) ? 'Not Available' : 'Available';

        $sqlupdate = "UPDATE books SET title = :title, author_name = :author, category_id = :category, image_path = :image,
             price = :price, promotion_id = :promotion, stock = :quantity, description = :description, stock_statut = :stockStatus WHERE book_id = :bookID;";
        $stmt = $this->db->prepare($sqlupdate);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':image', $imageFileName);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':bookID', $bookID);
        $stmt->bindParam(':promotion', $promotion);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':stockStatus', $stockStatus); // Ajout de la condition de stock_statut
        $stmt->execute();
    }
    public function AddBook($title, $price, $author, $category, $promotion, $description, $quantity, $imageFileName)
    {

        $sql = "INSERT INTO books (title, author_name, category_id, image_path, price, promotion_id, stock, description,stock_statut) VALUES
         (:title, :author, :category,:image,:price , :promotion, :quantity ,:description,'Available')";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':image', $imageFileName);
        $stmt->bindParam(':category', $category);
        // $stmt->bindParam(':bookID', $bookID);
        $stmt->bindParam(':promotion', $promotion);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':description', $description);
        $stmt->execute();


    }
    public function getCategoryName($categoryID)
    {
        $sql = "SELECT category_name FROM categories WHERE category_id = :category";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category', $categoryID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
    public function deleteBook($code)
    {
        try {
            $sql = "DELETE FROM books WHERE book_id = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $stmt->execute();

            header('Location: booksTable.php');
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du produit : " . $e->getMessage();
        }

    }

    public function find($code)
    {
        try {

            $joinConditionBC = 'books.category_id = categories.category_id';
            $joinConditionBP = 'books.promotion_id = promotions.promotion_id';
            $columnsBCD = 'books.book_id AS "Book ID", 
            books.title AS "Title", 
            books.author_name AS "Author Name", 
            books.price AS "Price", 
            promotions.promo_name AS "Promotion Name", 
            books.promotion_id AS "Promotion ID",
            books.description AS Description, 
            books.stock_statut AS "Status", 
            books.stock AS Quantity, 
            categories.category_name AS "Category Name",
            books.category_id AS "Category ID",
            books.image_path AS Image';
            $where = 'books.book_id=:code';
            // Appliquer la première jointure
            $resultBCD = $this->joinThreeTables('books', 'categories', 'promotions', $joinConditionBC, $joinConditionBP, $columnsBCD, $where, [':code' => $code]);



            return $resultBCD;

        } catch (PDOException $e) {
            die("Erreur lors de la récupération des données : " . $e->getMessage());
        }
    }
    public function UpdatePromo($editPromotionID, $editPromotionName, $editDiscount)
    {

        $sqlupdate = "UPDATE promotions SET promo_name = :name, discount = :discount WHERE promotion_id = :promoID;";
        $stmt = $this->db->prepare($sqlupdate);

        $stmt->bindParam(':name', $editPromotionName);
        $stmt->bindParam(':discount', $editDiscount);
        $stmt->bindParam(':promoID', $editPromotionID);
        $stmt->execute();


    }
    public function AddPromo($editPromotionName, $editDiscount)
    {

        $sqlInsert = "INSERT INTO promotions (promo_name, discount) VALUES (:name, :discount)";
        $stmt = $this->db->prepare($sqlInsert);

        $stmt->bindParam(':name', $editPromotionName);
        $stmt->bindParam(':discount', $editDiscount);
        $stmt->execute();


    }
    public function DeletePromo($promoId)
    {
        $sqlDelete = "DELETE FROM promotions WHERE promotion_id = :promoID";
        $stmt = $this->db->prepare($sqlDelete);

        $stmt->bindParam(':promoID', $promoId);
        $stmt->execute();

    }
    public function UpdateCategory($editCategoryId, $editCategoryName)
    {
        $sqlUpdate = "UPDATE categories SET category_name = :name WHERE category_id = :categoryID";
        $stmt = $this->db->prepare($sqlUpdate);

        $stmt->bindParam(':name', $editCategoryName);
        $stmt->bindParam(':categoryID', $editCategoryId);
        $stmt->execute();
    }
    public function AddCategory($editCategoryName)
    {
        $sqlInsert = "INSERT INTO categories (category_name) VALUES (:name)";
        $stmt = $this->db->prepare($sqlInsert);

        $stmt->bindParam(':name', $editCategoryName);
        $stmt->execute();
    }
    public function DeleteCategory($categoryId)
    {
        $sqlDelete = "DELETE FROM categories WHERE category_id = :categoryID";
        $stmt = $this->db->prepare($sqlDelete);

        $stmt->bindParam(':categoryID', $categoryId);
        $stmt->execute();
    }
    public function getOrders()
    {
        $sql = "SELECT commande.commande_id AS `Commande ID`,commande.user_id As 'Client ID', users.fullname AS `Client Name`, commande.status AS `Status`
            FROM commande
            INNER JOIN users ON commande.user_id = users.user_id
            WHERE commande.status <> 'Treatment'";

        $stmt = $this->db->query($sql);

        // Vérifiez si la requête a réussi
        if ($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Gérez les erreurs ici
            return false;
        }
    }
    public function getOrderDetails($commandeID)
    {
        $sql = "SELECT
                    commande_details.id_cd,
                    commande_details.commande_id AS 'Commande ID',
                    books.title AS Title ,
                    books.image_path AS 'Image',
                    commande_details.qte AS Quantity
                FROM
                    commande_details
                JOIN
                    books ON commande_details.book_id = books.book_id
                WHERE
                    commande_details.commande_id = :commandeID";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':commandeID', $commandeID);
        $stmt->execute();

        // Récupérer les résultats de la requête
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function UpdateCommande($commandeId, $userId, $status)
    {
        $sqlUpdate = "UPDATE commande SET status = :status, user_id = :userId WHERE commande_id = :commandeId";
        $stmt = $this->db->prepare($sqlUpdate);

        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':commandeId', $commandeId);
        $stmt->execute();
    }


    public function DeleteCommande($commandeId)
    {
        $sqlDelete = "DELETE FROM commande WHERE commande_id = :commandeId";
        $stmt = $this->db->prepare($sqlDelete);

        $stmt->bindParam(':commandeId', $commandeId);
        $stmt->execute();
    }
    public function deleteFromTable($commandeID, $userID)
    {
        // 1. Sélectionner les données nécessaires de la table commande_details
        $selectCommandeDetailsQuery = "SELECT book_id, qte FROM commande_details WHERE commande_id = :commandeID AND client_id = :userID";
        $selectCommandeDetailsStmt = $this->db->prepare($selectCommandeDetailsQuery);
        $selectCommandeDetailsStmt->bindParam(':commandeID', $commandeID, PDO::PARAM_INT);
        $selectCommandeDetailsStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $selectCommandeDetailsStmt->execute();
        $commandeDetailsData = $selectCommandeDetailsStmt->fetchAll(PDO::FETCH_ASSOC);

        // 2. Mettre à jour la table books
        foreach ($commandeDetailsData as $row) {
            $bookID = $row['book_id'];
            $quantite = $row['qte'];

            // Mettre à jour la table books
            $updateBooksQuery = "UPDATE books SET stock = stock - :quantite WHERE book_id = :bookID";
            $updateBooksStmt = $this->db->prepare($updateBooksQuery);
            $updateBooksStmt->bindParam(':quantite', $quantite, PDO::PARAM_INT);
            $updateBooksStmt->bindParam(':bookID', $bookID, PDO::PARAM_INT);
            $updateBooksStmt->execute();

            // Vérifier si le stock est devenu 0
            $checkStockQuery = "SELECT stock FROM books WHERE book_id = :bookID";
            $checkStockStmt = $this->db->prepare($checkStockQuery);
            $checkStockStmt->bindParam(':bookID', $bookID, PDO::PARAM_INT);
            $checkStockStmt->execute();
            $currentStock = (int) $checkStockStmt->fetchColumn();

            // Mettre à jour stock_status si le stock est devenu 0
            if ($currentStock === 0) {
                $updateStockStatusQuery = "UPDATE books SET stock_statut = 'Not Available' WHERE book_id = :bookID";
                $updateStockStatusStmt = $this->db->prepare($updateStockStatusQuery);
                $updateStockStatusStmt->bindParam(':bookID', $bookID, PDO::PARAM_INT);
                $updateStockStatusStmt->execute();
            }
        }

    }
    public function getAllcontacts()
    {
        try {
            $columns = 'contact_id as "Contact ID",name as "Fullname", email as "Email" ,subject as "Subject",message as "Message" ';
            $sql = "SELECT " . $columns . " FROM contact";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }
    public function searchBook($title)
    {
        try {

            $joinConditionBC = 'books.category_id = categories.category_id';
            $joinConditionBP = 'books.promotion_id = promotions.promotion_id';
            $columnsBCD = 'books.book_id AS "Book ID", 
            books.title AS Title, 
            books.author_name AS "Author Name", 
            books.price AS Price, 
            promotions.discount AS Promotion, 
            books.description AS Description, 
            books.stock_statut AS "Status", 
            books.stock AS Quantity, 
            categories.category_name AS Category,
            books.image_path AS Image';

            $whereCD = "books.title LIKE :title"; // Update the condition

            $params = [':title' => "%$title%"]; // Add the parameter

            // Appliquer la première jointure
            $resultBCD = $this->joinThreeTables('books', 'categories', 'promotions', $joinConditionBC, $joinConditionBP, $columnsBCD, $whereCD, $params);


            return $resultBCD;

        } catch (PDOException $e) {
            die("Erreur lors de la récupération des données : " . $e->getMessage());
        }

    }
}