<?php
require_once 'Model.php';
class ModelCart extends Model {
    public function __construct($db) {
        parent::__construct($db, 'commande_details');
    }
    public function verifyuser($username) {
        $column = 'users.fullname';
        $result = $this->db->join($this->table, 'users', $column);
        $usernameExists = false;

        // Parcourir le tableau résultant
        foreach($result as $row) {
            // Vérifier si le username existe dans la colonne 'client_id'
            if($row['fullname'] == $username) {
                // Le username a été trouvé dans le tableau
                $usernameExists = true;
                break; // Sortir de la boucle dès que le username est trouvé
            }
        }

        return $usernameExists;
    }

    public function findAll($username, $commandeid) {
        try {

            $joinConditionBCD = 'books.book_id = commande_details.book_id';
            $joinConditionBP = 'books.promotion_id = promotions.promotion_id';
            $columnsBCD = 'books.book_id ,books.stock,
                            books.title AS Product, 
                            books.price AS "Price unit",
                            commande_details.id_cd, 
                            commande_details.qte AS Quantity, 
                             (books.price * commande_details.qte) AS Total,
                            books.image_path AS Image,
                             books.promotion_id AS "Promo",
                             books.stock As "stock",
                             promotions.discount AS Discount, 
                             (books.price - (books.price * (promotions.discount / 100))) AS "Discounted Price"';
            $idclient = (string)$this->getIDuser($username);
            $where = 'commande_details.client_id = :client_id AND commande_details.commande_id = :commande_id';


            // Appliquer la première jointure avec le filtre client
            $resultBCD = $this->joinThreeTables('books', 'commande_details', 'promotions', $joinConditionBCD, $joinConditionBP, $columnsBCD, $where, [':client_id' => $idclient, ':commande_id' => $commandeid]);


            return $resultBCD;

        } catch (PDOException $e) {
            die("Erreur lors de la récupération des données : ".$e->getMessage());
        }

    }
    public function update($codeToUpdate, $qte) {
        try {

            $query = "UPDATE $this->table SET qte = :qte WHERE id_cd = :codeToUpdate";

            // Préparer les valeurs pour la requête
            $stmt = $this->db->prepare($query);
            //var_dump(['qte' => $qte, 'codeToUpdate' => $codeToUpdate]);
            $stmt->execute(['qte' => $qte, 'codeToUpdate' => $codeToUpdate]);
        } catch (PDOException $e) {
            die("Erreur lors de la mise à jour : ".$e->getMessage());
        }
    }

    public function delete($rowId) {
        try {
            $sql = "DELETE FROM $this->table WHERE id_cd = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['code' => $rowId]);
        } catch (PDOException $e) {
            die("Error deleting data: ".$e->getMessage());
        }
    }
    public function addToCart($code, $user_id, $commandeid) {
        try {
            // Vérifier si le produit existe déjà dans le panier
            $checkIfExists = "SELECT * FROM commande_details WHERE book_id = :book_id AND client_id = :client_id AND commande_id = :commande_id";
            $stmtCheck = $this->db->prepare($checkIfExists);
            $stmtCheck->bindParam(':book_id', $code, PDO::PARAM_INT);
            $stmtCheck->bindParam(':client_id', $user_id, PDO::PARAM_INT);
            $stmtCheck->bindParam(':commande_id', $commandeid, PDO::PARAM_INT);  // Correction ici
            $stmtCheck->execute();
            $existingProduct = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    
            if ($existingProduct) {
                // Le produit existe déjà, incrémenter la quantité
                $updateQuantity = "UPDATE commande_details SET qte = qte + 1 WHERE book_id = :book_id AND client_id = :client_id AND commande_id = :commande_id";
                $stmtUpdate = $this->db->prepare($updateQuantity);
                $stmtUpdate->bindParam(':book_id', $code, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':client_id', $user_id, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':commande_id', $commandeid, PDO::PARAM_INT);
                $stmtUpdate->execute();
            } else {
                // Le produit n'existe pas, l'ajouter au panier
                $insertProduct = "INSERT INTO commande_details (book_id, client_id, qte, commande_id) VALUES (:book_id, :client_id, 1, :commande_id)";
                $stmtInsert = $this->db->prepare($insertProduct);
                $stmtInsert->bindParam(':book_id', $code, PDO::PARAM_INT);
                $stmtInsert->bindParam(':client_id', $user_id, PDO::PARAM_INT);
                $stmtInsert->bindParam(':commande_id', $commandeid, PDO::PARAM_INT);
                $stmtInsert->execute();
            }
    
            //return true; // Opération réussie
        } catch (PDOException $e) {
            die("Erreur lors de l'ajout au panier : " . $e->getMessage());
        }
    }
    public function deleteFromTable($commandeID, $userID) {
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
        }

    }
    public function checkout($commandeID, $userID) {
        // Supprimer la commande existante
        $deleteQuery = "UPDATE commande SET status = 'Refunded' WHERE commande_id = :commandeID";
        $deleteStatement = $this->db->prepare($deleteQuery);
        $deleteStatement->bindParam(':commandeID', $commandeID, PDO::PARAM_INT);
        
        // Exécuter la requête de suppression
        $result = $deleteStatement->execute();
        if ($result) {
            // Insérer une nouvelle commande
            $insertQuery = "INSERT INTO commande (user_id, status) VALUES (:userID, 'Treatment')";
            $insertStatement = $this->db->prepare($insertQuery);
            $insertStatement->bindParam(':userID', $userID, PDO::PARAM_INT);
            
            // Exécuter la requête d'insertion
            $resultInsert = $insertStatement->execute();
        
            if ($resultInsert) {
                // Récupérer la dernière commande insérée
                $lastInsertedID = $this->db->lastInsertId();
    
                // Retourner la nouvelle commande directement
                return array('commande_id' => $lastInsertedID);
            } else {
                // Gérer l'échec de l'insertion
                return false;
            }
        } else {
            // Gérer l'échec de la mise à jour
            return false;
        }
    }
    public function checkoutwithoutdelete($commandeID, $userID) {
        // Supprimer la commande existante
        $deleteQuery = "UPDATE commande SET status = 'Waiting Payment' WHERE commande_id = :commandeID";
        $deleteStatement = $this->db->prepare($deleteQuery);
        $deleteStatement->bindParam(':commandeID', $commandeID, PDO::PARAM_INT);
        
        // Exécuter la requête de suppression
        $result = $deleteStatement->execute();
        if ($result) {
            // Insérer une nouvelle commande
            $insertQuery = "INSERT INTO commande (user_id, status) VALUES (:userID, 'Treatment')";
            $insertStatement = $this->db->prepare($insertQuery);
            $insertStatement->bindParam(':userID', $userID, PDO::PARAM_INT);
            
            // Exécuter la requête d'insertion
            $resultInsert = $insertStatement->execute();
        
            if ($resultInsert) {
                // Récupérer la dernière commande insérée
                $lastInsertedID = $this->db->lastInsertId();
    
                // Retourner la nouvelle commande directement
                return array('commande_id' => $lastInsertedID);
            } else {
                // Gérer l'échec de l'insertion
                return false;
            }
        } else {
            // Gérer l'échec de la mise à jour
            return false;
        }
    }
    
    
    public function addToCartFromSingleProduct($code, $user_id, $quantity, $commandeid) {
        try {
            // Vérifier si le produit existe déjà dans le panier
            $checkIfExists = "SELECT * FROM commande_details WHERE book_id = :book_id AND client_id = :client_id AND commande_id = :commande_id";
            $stmtCheck = $this->db->prepare($checkIfExists);
            $stmtCheck->bindParam(':book_id', $code, PDO::PARAM_INT);
            $stmtCheck->bindParam(':client_id', $user_id, PDO::PARAM_INT);
            $stmtCheck->bindParam(':commande_id', $commandeid, PDO::PARAM_INT);
            $stmtCheck->execute();
            $existingProduct = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    
            if ($existingProduct) {
                // Le produit existe déjà, incrémenter la quantité
                $updateQuantity = "UPDATE commande_details SET qte = qte + :quantity WHERE book_id = :book_id AND client_id = :client_id AND commande_id = :commande_id";
                $stmtUpdate = $this->db->prepare($updateQuantity);
                $stmtUpdate->bindParam(':book_id', $code, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':client_id', $user_id, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':commande_id', $commandeid, PDO::PARAM_INT);
                $stmtUpdate->execute();
            } else {
                // Le produit n'existe pas, l'ajouter au panier
                $insertProduct = "INSERT INTO commande_details (book_id, client_id, qte, commande_id) VALUES (:book_id, :client_id, :quantity, :commande_id)";
                $stmtInsert = $this->db->prepare($insertProduct);
    
                $stmtInsert->bindParam(':book_id', $code, PDO::PARAM_INT);
                $stmtInsert->bindParam(':client_id', $user_id, PDO::PARAM_INT);
                $stmtInsert->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmtInsert->bindParam(':commande_id', $commandeid, PDO::PARAM_INT);  // Correction ici
                $stmtInsert->execute();
            }
    
            //return true; // Opération réussie
        } catch (PDOException $e) {
            die("Erreur lors de l'ajout au panier : " . $e->getMessage());
        }
    }
    

}
function cart_total($cartData) {
    if (empty($cartData)) {
        return array(
            'Total' => 0.0,
            'Total Discount Amount' => 0.0,
            'Total Discounted Price' => 0.0
        );
    }

    $totalTotal = 0.0;
    $totalDiscountAmount = 0.0;
    $totalDiscountedPrice = 0.0;

    foreach ($cartData as $item) {
        // Assurez-vous que les clés nécessaires existent dans chaque élément du tableau
        if (isset($item['Total'], $item['Discount'], $item['Discounted Price'])) {
            // Convertir les valeurs en float
            $totalTotal += (float)$item['Total'];
            $totalDiscountAmount += (float)($item['Price unit'] - (float)$item['Discounted Price']) * $item['Quantity'];
            $totalDiscountedPrice += (float)$item['Discounted Price'] * $item['Quantity'];
        }
    }

    // Retourner un tableau associatif contenant les totaux
    return array(
        'Total' => $totalTotal,
        'Total Discount Amount' => $totalDiscountAmount,
        'Total Discounted Price' => $totalDiscountedPrice
    );
}

?>