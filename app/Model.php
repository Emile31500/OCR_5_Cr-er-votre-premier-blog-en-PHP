<?php
abstract class Model {

    private $server = "127.0.0.1"; 
    private $data_base = "mon_blog";
    private $user = "root";
    private $password = "";
   
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
        $prepare = $this->connexion->prepare($request);


    }


}


?>