<?php

class Articles extends Controller {


    public function index(){

        $this->render_page("index", ["title" => "Voilà."]);

    }

}


?>