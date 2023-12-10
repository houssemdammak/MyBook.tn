<?php
require_once 'Model.php';
class ModelAuth extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'users');
    }
    public function selectUserByEmail($email)
    {

        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function insertUser($fullname, $email, $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO $this->table (fullname, email, password) VALUES (:fullname, :email, :password)");
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        return $stmt->execute();
    }
    public function createCommande($userId) {
        // Vérifiez si l'utilisateur a déjà une commande en cours avec le statut "traitement"
        $existingCommandeStmt = $this->db->prepare("SELECT commande_id FROM commande WHERE user_id = :user_id AND status = 'Treatment'");
        $existingCommandeStmt->bindParam(':user_id', $userId);
        $existingCommandeStmt->execute();
        
        $existingCommande = $existingCommandeStmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$existingCommande) {
            // L'utilisateur n'a pas de commande en cours avec le statut "traitement", donc nous créons une nouvelle commande
            $newCommandeStmt = $this->db->prepare("INSERT INTO commande (user_id, status) VALUES (:user_id, 'Treatment')");
            $newCommandeStmt->bindParam(':user_id', $userId);
            $newCommandeStmt->execute();
    
            // Retournez l'ID de la nouvelle commande
            return $this->db->lastInsertId('commande');
        } else {
            // Retournez l'ID de la commande existante
            return $existingCommande['commande_id'];
        }
    }
    
    public function getEmails(){
        $stmt = $this->db->prepare("SELECT email FROM $this->table");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}