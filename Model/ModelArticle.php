<?php

    class Article extends Model {  

        public const TABLE = "articles";

        public function __Construct(Type $var = null)
        {
            $this->table = self::TABLE;
            
        }

        public function lire($id)
        {
            $this->getConnection();
            $request = "SELECT DISTINCT `articles`.`id`, `libelle`, `article`, `image`, `date_derniere_modification`, `articles`.`date_enregistrement`, `nom`, `prenom` FROM `articles`, `administrateurs` WHERE `articles`.`est_supprimer`=0 AND `articles`.`est_publier`=1 AND `articles`.`id`=:id";
            $query = $this->connexion->prepare($request);

            $query->bindValue(':id', $id, PDO::PARAM_INT);

            $query->execute();
            return $query->fetch();  
        }

        public function getListAdmin()
        {

            $this->getConnection();
            $request = "SELECT DISTINCT `articles`.`id`, `id_redacteur`, `libelle`, `article`, `image`, `date_derniere_modification`, `articles`.`date_enregistrement`, `articles`.`est_supprimer`, `nom`, `prenom` FROM `articles`, `administrateurs` WHERE `articles`.`est_supprimer`=0";
            $query = $this->connexion->prepare($request);
            $query->execute();
            return $query->fetchAll();   
    
        }

        public function getList()
        {

            $this->getConnection();
            $request = "SELECT DISTINCT `articles`.`id`, `libelle`, `article`, `image`, `date_derniere_modification`, `articles`.`date_enregistrement`, `nom`, `prenom` FROM `articles`, `administrateurs` WHERE `articles`.`est_supprimer`=0 AND `articles`.`est_publier`=1";
           
            $query = $this->connexion->prepare($request);
            $query->execute();
            return $query->fetchAll();   
    
        }

        public function supprimer($id){

            $this->getConnection();
            $request = "UPDATE `articles` SET `est_supprimer`=1 WHERE `id`=:id LIMIT 1";
            $query = $this->connexion->prepare($request);

            $query->bindValue(':id', $id, PDO::PARAM_INT);

            $status = $query->execute(); 
            return $status;

        }

    }
 ?>
