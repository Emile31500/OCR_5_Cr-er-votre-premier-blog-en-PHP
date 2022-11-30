<?php

    class Utilisateurs extends Controller {

        public function sinscrire(){

            $this->render_page("sinscrire", ["title" => "Nouveau utilisateur"]);

        }

        public function inscription(){

            if (isset($_POST["name"]) && !empty($_POST["name"]) &&
                isset($_POST["firstname"]) && !empty($_POST["firstname"]) &&
                isset($_POST["user_name"]) && !empty($_POST["user_name"]) &&
                isset($_POST["email"]) && !empty($_POST["email"]) &&
                isset($_POST["password"]) && !empty($_POST["password"]) &&
                isset($_POST["confirm_password"]) && !empty($_POST["confirm_password"])){

                    $date_enregistrement = date("Y-m-d");

                    $array = [
                        "nom" => $_POST["name"],
                        "prenom" => $_POST["firstname"],
                        "nom_utilisateur" => $_POST["user_name"],
                        "email" => $_POST["email"],
                        "hash_mdp" => $_POST["password"],
                        "date_enregistrement" => $date_enregistrement
                    ];

                    $this->loadModel("Utilisateur");
                    $this->model->table = "utilisateurs";
                    $this->model->array_value_request = $array;
                    $status = $this->model->insert();

                    $this->render_page("sinscrire", ["res_query" => $status]);

            } else {

                $this->render_page("sinscrire", ["res_query" => "parametres_manquant"]);

            }


            

        }

    }

?>