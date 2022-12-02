<?php

class Administrateur extends Model {
    
    public function __construct(){

        $this->table = "administrateurs";
        $this->getConnection();

    }

    public function is_admin_exist(){

        $request = "SELECT * FROM ".$this->table." WHERE email='".$this->array_user_keys["email"]."' OR telephone='".$this->array_user_keys["telephone"]."' LIMIT 1";
        $query = $this->connexion->prepare($request);
        $query->execute();
        return $query->fetch();

    }

}


?>