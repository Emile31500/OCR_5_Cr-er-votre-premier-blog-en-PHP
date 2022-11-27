<?php
    //var_dump($twig);

    abstract class Controller {

        public function loadModel(string $model){

            require_once(ROOT.'models/'.$model.'.php');
            $this->model = new $model();

        }

        public function render_page(string $fichier, $array_values=[]){

            /*require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$fichier.'.twig');*/
            global $twig;
            echo $twig->render(strtolower(get_class($this)).".twig", $array_values);
        }

    }
?>