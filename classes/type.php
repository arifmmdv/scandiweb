<?php

class Type extends Db{


    // select all data from the database
    public function select(){

        $sql = "SELECT * FROM types";

        $result = $this->connect()->query($sql);

        if($result->rowCount() > 0){

            while($row = $result->fetch()){

                $data[] = $row;

            }
            return $data;
        }
    }

    public function selectType($id){

        $sql = "SELECT * FROM types WHERE id = :id";

        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}