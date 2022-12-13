<?php

class Commentaire extends Model 
{
    
    public $id_article;

    public function __Construct ()
    {
        $this->table= "commentaires";
    }


    public function Liste() {

        $this->getConnection();
        $request = "SELECT DISTINCT `id_article`, `id_utilisateur`, `message`, `nom`, `prenom` FROM `commentaires`, `utilisateurs` WHERE `commentaires`.`est_supprimer`=0 AND `id_article`=".$this->id_article;
        $query = $this->connexion->prepare($request);
        $query->execute();
        return $query->fetchAll();   
    }
}




?>