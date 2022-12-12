<?php

    class Article extends Model {  

        public function __Construct(Type $var = null)
        {
            $this->table = "articles";
            
        }

        public function lire()
        {
            $this->getConnection();
            $request = "SELECT DISTINCT `articles`.`id`, `libelle`, `article`, `image`, `date_derniere_modification`, `articles`.`date_enregistrement`, `nom`, `prenom` FROM `articles`, `administrateurs` WHERE `articles`.`est_supprimer`=0 AND `articles`.`est_publier`=1 AND `articles`.`id`=".$this->id."";
            $query = $this->connexion->prepare($request);
            $query->execute();
            return $query->fetch();  
        }

        public function get_list_admin(){

            $this->getConnection();
            $request = "SELECT DISTINCT `articles`.`id`, `id_redacteur`, `libelle`, `article`, `image`, `date_derniere_modification`, `articles`.`date_enregistrement`, `articles`.`est_supprimer`, `nom`, `prenom` FROM `articles`, `administrateurs` WHERE `articles`.`est_supprimer`=0";
            $query = $this->connexion->prepare($request);
            $query->execute();
            return $query->fetchAll();   
    
        }

        public function get_list(){

            $this->getConnection();
            $request = "SELECT DISTINCT `articles`.`id`, `libelle`, `article`, `image`, `date_derniere_modification`, `articles`.`date_enregistrement`, `nom`, `prenom` FROM `articles`, `administrateurs` WHERE `articles`.`est_supprimer`=0 AND `articles`.`est_publier`=1";
           
            $query = $this->connexion->prepare($request);
            $query->execute();
            return $query->fetchAll();   
    
        }

        public function supprimer(){

            $this->getConnection();
            $request = "UPDATE `articles` SET `est_supprimer`=1 WHERE `id`=".$this->id." LIMIT 1";
            $query = $this->connexion->prepare($request);
            $status = $query->execute(); 
            return $status;

        }

    }

?>