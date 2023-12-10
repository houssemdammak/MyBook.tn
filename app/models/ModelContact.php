<?php
require_once 'Model.php';
class ModelContact extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'contact');
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
    public function AddContact($name, $email,$subject,$message)
    {

        $sqlInsert = "INSERT INTO contact (name,email,subject,message) VALUES (:name, :email,:subject,:message)";
        $stmt = $this->db->prepare($sqlInsert);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        $stmt->execute();


    }
}