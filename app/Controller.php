<?php

    
    abstract class Controller {

        public function loadModel(string $model) : bool{

            require_once(str_replace('index.php', "", $_SERVER['SCRIPT_FILENAME'])."models/".$model.".php");
            $this->model = new $model();
            return true;

        }

        public function render_page(string $fichier, $array_values=[]) : bool{

            global $twig;
            echo $twig->render(strtolower(get_class($this))."/".$fichier.".twig", $array_values);
            return true;

        }

        public function render_other_controller(string $path, $array_values=[]) : bool{

            global $twig;
            echo $twig->render($path.".twig", $array_values);
            return true;

        }

        public function is_user_connected() : array {

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