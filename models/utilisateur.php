<?php

    class Utilisateur extends Model {
        
        public function __construct(){

            $this->table = "utilisateurs";
            $this->getConnection();
            
        }

    }


?>