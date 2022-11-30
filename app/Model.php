<?php
abstract class Model {

    private $server = "127.0.0.1"; 
    private $data_base = "mon_blog";
    private $user = "root";
    private $password = "";
    
    public $array_selector_request = [];
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
        $request = "SELECT * FROM ".$this->table." WHERE 1";
        $query = $this->connexion->prepare($request);
        $query->execute();
        return $query->fetchAll();
    
    }

    public function getOne(){

        $this->getConnection();
        $request = "SELECT * FROM ".$this->table." WHERE id=".$this->id;
        $query = $this->connexion->prepare($request);
        $query->execute();
        return $query->fetch();
    
    }

    public function getBy(){

        $this->getConnection();
        foreach ($array_selector_request as $selector){

            $where = $where.array_keys($selector)."=".array_values($selector)." AND ";

        }

        $where = substr($where, 0, -5);

        $request = "SELECT * FROM ".$this->table." WHERE ".$where;
        $query = $this->connexion->prepare($request);
        $query->execute();
        return $query->fetchAll();

    }

    public function insert(){

        $this->getConnection();
        $array_values = array_values($this->array_selector_request);
        $array_keys = array_keys($this->array_selector_request);
        $keys = "";
        $values = "";

        foreach ($array_keys as $array_key){

            $keys = $keys."`".$array_key."`, ";

        }

        foreach ($array_values as $array_value){

            $values = $values."'".$array_value."', ";

        }

        $keys = substr($keys, 0, -2);
        $values = substr($values, 0, -2);

        $request = "INSERT INTO `".$this->table."`(".$keys.") VALUES (".$values.")";
        $query = $this->connexion->prepare($request);
        $status = $query->execute();
        return $status;
    }

    public function update(){

        $this->getConnection();

        foreach ($array_value_request as $value){

            $values = "`".$where.array_keys($value)."`=".array_values($value).", ";

        }


        foreach ($array_selector_request as $selector){

            $selector = "`".$selector.array_keys($selector)."`=".array_values($selector)." AND ";

        }
       
        $values = substr($values, 0, -5);
        $selector = substr($selector, 0, -5);

        $request = "UPDATE ".$this->table." SET ".$value." WHERE ".$selector;
        $query = $this->connexion->prepare($request);
        return $query->execute();
    }

}


?>