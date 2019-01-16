<?php

class Product extends Db{
    
    
    // select all data from the database
    public function select(){
        
        $sql = "SELECT * FROM products";
        
        $result = $this->connect()->query($sql);
        
        if($result->rowCount() > 0){
            
            while($row = $result->fetch()){
                
                $data[] = $row;
            
            }
            return $data;
        }
    }
    
    public function insert($fields){
        
        $implodeColumns = implode(', ',array_keys($fields));
        
        $implodePlaceholder = implode(", :",array_keys($fields));
        
        $sql = "INSERT INTO products ($implodeColumns) VALUES (:".$implodePlaceholder.")";
        
        $stmt = $this->connect()->prepare($sql);
        
        foreach($fields as $key => $value){
         
            $stmt->bindValue(':'.$key,$value);
        }
        
        $stmtExec = $stmt->execute();
        
        if($stmtExec){
            header('Location: index.php');
        }
    }

    public function delete($id){

        $sql = "DELETE FROM products WHERE id = :id";

        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(":id",$id);
        $stmt->execute();

    }
}