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
                isset($_POST["phone_number"]) && !empty($_POST["phone_number"]) &&
                isset($_POST["password"]) && !empty($_POST["password"]) &&
                isset($_POST["confirm_password"]) && !empty($_POST["confirm_password"])){

                    $date_enregistrement = date("Y-m-d");

             /*       $this->loadModel("tilisateur");

                    $this->model->array_selector_request = ["email" => $_POST["email"]];
                    $status_1 = $this->mdoel->getBy();

                    $this->mdoel->array_selector_request = ["telephone" => $_POST["phone_number"]];
                    $status_2 = $this->mdoel->getBy();

                    $status = (isset($status_1) && !empty($status_1) && $status_1 && isset($status_2) && !empty($status_2) && $status_2);

                    if ($status) {

                        $this->render_page("sinscrire", ["res_query" => "utilisateur_existe"]);
                        return false;
                    }*/

                    $array_selector = [
                                        "email" => $_POST['email'],
                                        "telephone" => $_POST["phone_number"]
                                    ];


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
                    $this->model->array_user_keys = $array_selector;
                    $this->model->array_value_request = $array;
                    $utilisateur_exist = $this->model->is_exist_user();
                    
                    if ($utilisateur_exist){

                        $this->render_page("sinscrire", ["res_query" => "utilisateur_exist"]);
                        return true;

                    }

                    $status = $this->model->insert();

                    $this->render_page("sinscrire", ["res_query" => $status]);
                    return true;

            } else {

                $this->render_page("sinscrire", ["res_query" => "parametres_manquant"]);

            }


            

        }

    }

?>