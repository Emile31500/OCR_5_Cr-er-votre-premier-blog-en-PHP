<?php

    class Utilisateur extends Model {

        public $array_user_keys = [];

        public function __construct(){

            $this->table = "administrateurs";
            $this->getConnection();
            
        }

        public function is_exist_user(){

            $request = "SELECT * FROM :table WHERE email=':email' OR telephone=':telephone' LIMIT 1";
            $query = $this->connexion->prepare($request);

            $query->bindValue(':table', $this->table, PDO::PARAM_STRING);
            $query->bindValue(':email', $this->array_user_keys["email"], PDO::PARAM_STRING);
            $query->bindValue(':telephone', $this->array_user_keys["telephone"], PDO::PARAM_STRING);


            $query->execute();
            return $query->fetch();
            
        }

    }

?>