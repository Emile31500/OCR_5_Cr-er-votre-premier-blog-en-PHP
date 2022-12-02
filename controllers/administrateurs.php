<?php

class Administrateurs extends Controller {


    public function index(){

        $this->render_page("index", ["title" => "Se connecter"]);

    }

    public function ajouter(){

        $this->render_page("ajouter", ["title" => "Nouvel administrateur "]);

    }


}


?>