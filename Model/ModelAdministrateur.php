<?php

class Administrateur extends Model {

    public const TABLE = "administrateurs";
    
    public function __construct(){

        $this->table = self::TABLE;
        $this->getConnection();

    }

    public function isAdminExist($email, $telephone){

        $request = "SELECT * FROM `administrateurs` WHERE email=:email OR telephone=:telephone LIMIT 1";
        $query = $this->connexion->prepare($request);
        
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':telephone', $telephone, PDO::PARAM_STR);

        $query->execute();
        return $query->fetch();

    }

}


?>