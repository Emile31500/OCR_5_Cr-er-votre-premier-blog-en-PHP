<?php

    class Utilisateurs extends Controller {

        public function sinscrire(){

            $this->render_page("sinscrire", ["title" => "Nouveau utilisateur"]);

        }

    }

?>