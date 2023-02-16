<?php

    abstract class Controller {

        public function forbideNotAdmin() : void
        {
            if(isset($_SESSION["id_admin"])) {

                header("lcoation:http://127.0.0.1/Projet%20OC5/accueil/index");

            }

        }

        public function loadModel(string $model) : void
        {
            require_once(str_replace('index.php', "", $_SERVER['SCRIPT_FILENAME'])."Model/Model".$model.".php");
            $this->model = new $model();

        }

        public function renderPage(string $fichier, array $data=[]) : void
        {

            global $twig;

            
            $data["user"] = $this->getUserConnected();
            $data["admin"] = $this->getAdminConnected();
            echo $twig->render($this->renderFolder."/".$fichier.".twig", $data);


        }

        public function getUserConnected() : array {

            $user = [];
            if (isset($_SESSION["id_user"])){

                $this->loadModel("Utilisateur");
                $user = $this->model->getOne($_SESSION["id_user"]);

            }

            return $user;

        }

        public function getAdminConnected() : array {

            $admin = [];
            if (isset($_SESSION["id_admin"])){

                $this->loadModel("Administrateur");
                $admin = $this->model->getOne($_SESSION["id_admin"]);

            }

            return $admin;

        }
    }

 ?>
