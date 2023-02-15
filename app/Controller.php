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

        public function renderPage(string $fichier, array $array_values=[]) : void
        {

            global $twig;
            echo $twig->render($this->renderFolder."/".$fichier.".twig", $array_values);


        }

        public function getUserConnected() : array {

            $user = [];
            if (isset($_SESSION["id_user"])){

                $this->loadModel("Utilisateur");
                $user = $this->model->getOne($_SESSION["id_user"]);

            }

            return $user;

        }
    }

?>