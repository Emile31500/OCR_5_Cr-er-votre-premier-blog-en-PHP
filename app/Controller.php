<?php

    abstract class Controller {

        public function loadModel(string $model){

            require_once(ROOT."models/".$model.".php");
            $this->model = new $model();

        }

        public function render_page(string $fichier, $array_values=[]){

            global $twig;
            echo $twig->render(strtolower(get_class($this))."/".$fichier.".twig", $array_values);

        }

        public function render_other_controller(string $path, $array_values=[]){

            global $twig;
            echo $twig->render($path.".twig", $array_values);

        }

        public function is_user_connected(){

            if (isset($_SESSION["id_user"]) && !empty($_SESSION["id_user"])){

                $this->loadModel("Utilisateur");
                $this->model->table = "utilisateurs";
                $this->model->id = $_SESSION["id_user"];
                $user = $this->model->getOne();

            } else {

                $user = false;

            }

            return $user;

        }
    }

?>