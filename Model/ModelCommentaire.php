<?php

class Commentaire extends Model 
{
    
    public $id_article;
    public const TABLE = "commentaires";

    public function __Construct ()
    {
        $this->table= self::TABLE;
    }


    public function liste($id_article) {

        $this->getConnection();
        $request = "SELECT DISTINCT `id_article`, `id_utilisateur`, `message`, `nom`, `prenom` FROM `commentaires`, `utilisateurs` WHERE `commentaires`.`est_supprimer`=0 AND `id_article`=:id_article AND `utilisateurs`.id = `commentaires`.id_utilisateur";
        $query = $this->connexion->prepare($request);
        
        $query->bindValue(':id_article', $id_article, PDO::PARAM_INT);
        
        $query->execute();
        return $query->fetchAll();   
    }
}
 ?>
