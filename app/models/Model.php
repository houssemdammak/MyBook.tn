<?php
class Model
{
    protected $table;
    protected $db;
    public function __construct($db, $table)
    {
        $this->db = $db;
        $this->table = $table;
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
    public function getIDuser($username){
        if($username !=''){
            $sql = "SELECT user_id FROM users WHERE fullname = :name";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['name' => $username]);
            $result= $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($result[0]['id_user']);
            return $result['user_id'];
        }else{
            return 0 ;
        }
        
    }
    public function findAl()
    {
        try {
            $sql = "SELECT * FROM $this->table";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
        }
    }

    public function create($data)
    {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            die("Error creating data: " . $e->getMessage());
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

            $sql = "UPDATE $this->table SET $setString WHERE code = :code";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
        } catch (PDOException $e) {
            die("Error updating data: " . $e->getMessage());
        }
    }

    public function delete($code)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['code' => $code]);
        } catch (PDOException $e) {
            die("Error deleting data: " . $e->getMessage());
        }
    }

    public function customQuery($sql)
    {
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error selecting data: " . $e->getMessage());
        }
    }

    public function join($table1, $table2, $joinCondition, $columns = '*', $where = '', $params = array())
    {
        $query = "SELECT $columns FROM $table1
                  JOIN $table2 ON $joinCondition";
        if (!empty($where)) {
            $query .= " WHERE $where";
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function joinThreeTables($table1, $table2, $table3, $joinCondition1, $joinCondition2, $columns = '*', $where = '', $params = array())
{
    $query = "SELECT $columns FROM $table1
              JOIN $table2 ON $joinCondition1
              JOIN $table3 ON $joinCondition2";
    if (!empty($where)) {
        $query .= " WHERE $where";
    }
    $stmt = $this->db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}

?>