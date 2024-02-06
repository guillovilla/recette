<?php
abstract class CRUD extends PDO {
    public function __construct(){
        // parent::__construct('mysql:host=localhost; dbname=stampee; port=3306; charset=utf8', 'root', 'root');  //mac
        parent::__construct('mysql:host=localhost; dbname=recete; port=3306; charset=utf8', 'root', '');  //windows
        // parent::__construct('mysql:host=localhost; dbname=e2296789; port=3306; charset=utf8', 'e2296789', 'JLl2AH6eOoD6Ru7pOjhO');
    }

    public function select($field='id', $order='ASC'){
        $sql="SELECT * FROM $this->table ORDER BY $field $order";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    public function selectId($value){
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = '$value'";
        $stmt = $this->query($sql);
        $count = $stmt->rowCount();
        // print_r($stmt->fetch());die();
        if($count == 1){
            return $stmt->fetch();
        }else{
            // RequirePage::url('home/error/404');
            return $stmt->errorInfo();
        }  
    }


    public function selectValue($key, $value){
        $sql = "SELECT * FROM $this->table WHERE $key = '$value'";
        $stmt = $this->query($sql);
        $count = $stmt->rowCount();
        // print_r($stmt->fetch());die();
        if($count == 1){
            return $stmt->fetch();
            // return "1";
        }else{
            // RequirePage::url('home/error/404');
            // return $stmt->errorInfo();
            return '0';
        }  
    }

    public function insert($data){
        $data_keys = array_fill_keys($this->fillable, '');
        $data = array_intersect_key($data, $data_keys);

        $nomChamp = implode(", ",array_keys($data));
        $valeurChamp = ":".implode(", :", array_keys($data));

        $sql = "INSERT INTO $this->table ($nomChamp) VALUES ($valeurChamp)";



  
        $stmt = $this->prepare($sql);
        foreach($data as $key => $value){
            // $stmt->bindValue(":$key", $value);
            $stmt->bindValue(":$key", $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();
        return $this->lastInsertId();
    }

    public function delete($value){
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        if($stmt->execute()){
            return true;
        }else{
            return $stmt->errorInfo();
        }
    }

    public function deleteValue($columnName, $columnValue){
        $sql = "DELETE FROM $this->table WHERE $columnName = :columnValue";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':columnValue', $columnValue);
        if($stmt->execute()){
            return true;
        }else{
            return $stmt->errorInfo();
        }
    }

    public function deleteRecord($table, $primaryKey, $value){
        try {
            if ($table == 'user') {
                $this->deleteRelatedRecords('mise', 'user_id', $value);
            }
    
            $sql = "DELETE FROM $table WHERE $primaryKey = :$primaryKey";
            $stmt = $this->prepare($sql);
            $stmt->bindValue(":$primaryKey", $value);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return $stmt->errorInfo();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    private function deleteRelatedRecords($relatedTable, $foreignKey, $value){
        $sql = "DELETE FROM $relatedTable WHERE $foreignKey = :$foreignKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$foreignKey", $value);
        $stmt->execute();
    }
    
    public function update($data){
        $queryField = null;
        foreach($data as $key=>$value){
            $queryField .="$key =:$key, ";
        }
        $queryField = rtrim($queryField, ", ");
        $sql = "UPDATE $this->table SET $queryField WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        foreach($data as $key => $value){
            $stmt->bindValue(":$key", $value);
        }
        if($stmt->execute()){
            return true;
        }else{
            return $stmt->errorInfo();
        }
    }
}
?>