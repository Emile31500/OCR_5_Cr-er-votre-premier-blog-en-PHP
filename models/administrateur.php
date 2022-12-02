<?php

class Administrateur extends Model {
    
    public function __construct(){

        $this->table = "administrateurs";
         $this->getConnection();
         
    }

}


?>