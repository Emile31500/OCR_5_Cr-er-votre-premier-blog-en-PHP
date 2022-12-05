<?php

    class Utilisateur extends Model {

        public $array_user_keys = [];

        public function __construct(){

            $this->table = "administrateurs";
            $this->getConnection();
            
        }

        public function is_exist_user(){

            $request = "SELECT * FROM ".$this->table." WHERE email='".$this->array_user_keys["email"]."' OR telephone='".$this->array_user_keys["telephone"]."' LIMIT 1";
            $query = $this->connexion->prepare($request);
            $query->execute();
            return $query->fetch();
            
        }

    }

?>