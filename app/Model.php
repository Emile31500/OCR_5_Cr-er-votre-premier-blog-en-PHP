<?php
abstract class Model {

    private $server = "127.0.0.1"; 
    private $data_base = "mon_blog";
    private $user = "root";
    private $password = "";
    
    public $array_selector_request = [ ];
    public $array_value_request = [];

    public $table = "";
    public $id = "";
    
    public $connexion;

    public function getConnection(){
        try{ 

            $this->connexion = new PDO('mysql:host='.$this->server.';dbname=' . $this->data_base, $this->user, $this->password);

        } catch(PDOException $exception) {

            echo 'Erreur : '.$exception->getMessage();

            
        }


    }

    public function getAll(){

        $this->getConnection();
        $request = "SELECT * FROM :table WHERE 1";
        $query = $this->connexion->prepare($request);

        $query->bindValue(':table', $this->table, PDO::PARAM_STRING);

        $query->execute($this->table);
        return $query->fetchAll();
    
    }

    public function getOne(){

        $this->getConnection();
        $request = "SELECT * FROM :table WHERE id=:id";
        $query = $this->connexion->prepare($request);

        $query->bindValue(':table', $this->table, PDO::PARAM_STRING);
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);

        $query->execute();
        return $query->fetch();
    
    }

    public function getBy(){

        $this->getConnection();
        $keys = array_keys($this->array_selector_request);
        $values = array_values($this->array_selector_request);
        $where = "";

        for ($i=0; $i < sizeof($keys); $i++) {

            $where = $where.$keys[$i]."='".$values[$i]."' AND ";

        }
        
        $where = substr($where, 0, -5);

        $request = "SELECT * FROM :table WHERE :where";
        $query = $this->connexion->prepare($request);

        $query->bindValue(':table', $this->table, PDO::PARAM_STRING);
        $query->bindValue(':where', $where, PDO::PARAM_STRING);

        $query->execute();
        return $query->fetchAll();   

    }

    public function insert(){

        $this->getConnection();
        $array_values = array_values($this->array_value_request);
        $array_keys = array_keys($this->array_value_request);
        $keys = "";
        $values = "";

        foreach ($array_keys as $array_key){

            $keys = $keys."`".$array_key."`, ";

        }

        foreach ($array_values as $array_value){

            $array_value = str_replace('\'', "\\'", $array_value);
            $values = $values."'".$array_value."', ";

        }

        $keys = substr($keys, 0, -2);
        $values = substr($values, 0, -2);
        $table = htmlentities($this->table);

        $request = "INSERT INTO `:table`(:keys) VALUES (:values)";
        $query = $this->connexion->prepare($request);

        $query->bindValue(':table', $this->table, PDO::PARAM_STRING);
        $query->bindValue(':keys', $keys, PDO::PARAM_STRING);
        $query->bindValue(':values', $values, PDO::PARAM_STRING);

        $status = $query->execute();
        return $status;
        
    }

    public function update(){

        $this->getConnection();
        
        $selector = "";
        $value = "";
        
        foreach ($array_value_request as $value){

            $values = "`".$where.array_keys($value)."`=".array_values($value).", ";

        }


        foreach ($array_selector_request as $selector){

            $selector = "`".$selector.array_keys($selector)."`=".array_values($selector)." AND ";

        }
       
        $values = substr($values, 0, -5);
        $selector = substr($selector, 0, -5);

        $request = "UPDATE :table SET :values WHERE :selector";
        $query = $this->connexion->prepare($request);

        $query->bindValue(':table', $this->table, PDO::PARAM_STRING);
        $query->bindValue(':values', $values, PDO::PARAM_STRING);
        $query->bindValue(':selector', $selector, PDO::PARAM_STRING);

        return $query->execute();
    }

    public function updateOne(){

        $this->getConnection();
        $keys = array_keys($this->array_value_request);
        $values = array_values($this->array_value_request);
        $value_to_update = "";

        for ($i=0; $i < sizeof($keys); $i++) { 
            
            $value_to_update = "`".$keys[$i]."`='".$values[$i]."', ";

        }

        $value_to_update  = substr($value_to_update , 0, -2);

        $request = "UPDATE ".$this->table." SET ".$value_to_update." WHERE id=".$this->id;
        $query = $this->connexion->prepare($request);

        $query->bindValue(':table', $this->table, PDO::PARAM_STRING);
        $query->bindValue(':value_to_update', $value_to_update, PDO::PARAM_STRING);
        $query->bindValue(':id', $this->id, PDO::PARAM_STRING);


        return $query->execute();

    }

}


?>