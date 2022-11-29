<?php

class Articles extends Controller {


    public function liste(){

        $this->render_page("index", ["title" => "Voilà."]);

    }

    public function lire(){

        $this->render_page("index", ["title" => "Voilà."]);

    }

}


?>