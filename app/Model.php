<?php
abstract class Model {

    private $server = "127.0.0.1"; 
    private $data_base = "mon_blog";
    private $user = "root";
    private $password = "";
    
    public $array_selector_request = [];
    public $public = "";
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

        getConnection();
        $request = "SELECT * FROM ".$this->table." WHERE 1";
        $query = $this->connexion->prepare($request);
        $query->execute();
        return $query->fetchAll();


    }
/*
    public function getBy(){

        getConnection();
        $this->array_selec_
        $request = "SELECT * FROM ".$this->table." WHERE 1";
        $query = $this->connexion->prepare($request);
        $query->execute();
        return $query->fetchAll();


    }
*/

}


?>