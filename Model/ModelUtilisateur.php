<?php

    class Utilisateur extends Model {

        public $array_user_keys = [];
        public const TABLE = "utilisateurs";

        public function __construct(){

            $this->table = self::TABLE;
            $this->getConnection();
            
        }

        public function doesUserExist(){

            $request = "SELECT * FROM utilisateurs WHERE email=:email OR telephone=:telephone LIMIT 1";
            $query = $this->connexion->prepare($request);
            
            $query->bindValue(':email', $this->array_user_keys["email"], PDO::PARAM_STR);
            $query->bindValue(':telephone', $this->array_user_keys["telephone"], PDO::PARAM_STR);


            $query->execute();
            return $query->fetch();
            
        }

    }
 ?>
