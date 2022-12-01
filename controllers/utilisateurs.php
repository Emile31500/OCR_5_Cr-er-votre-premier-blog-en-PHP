<?php

    class Utilisateurs extends Controller {

        public function sinscrire(){

            $this->render_page("sinscrire", ["title" => "Nouveau utilisateur"]);

        }

        public function seconnecter(){

            $this->render_page("seconnecter", ["title" => "Connectez-vous !"]);

        }

        public function inscription(){

            if (isset($_POST["name"]) && !empty($_POST["name"]) &&
                isset($_POST["firstname"]) && !empty($_POST["firstname"]) &&
                isset($_POST["user_name"]) && !empty($_POST["user_name"]) &&
                isset($_POST["email"]) && !empty($_POST["email"]) &&
                isset($_POST["phone_number"]) && !empty($_POST["phone_number"]) &&
                isset($_POST["birth_day"]) && !empty($_POST["birth_day"]) &&
                isset($_POST["password"]) && !empty($_POST["password"]) &&
                isset($_POST["confirm_password"]) && !empty($_POST["confirm_password"])){

                    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

                    $date_enregistrement = date("Y-m-d");
                    $array_selector = [
                                        "email" => $_POST['email'],
                                        "telephone" => $_POST["phone_number"]
                                    ];


                    $array = [
                        "nom" => $_POST["name"],
                        "prenom" => $_POST["firstname"],
                        "nom_utilisateur" => $_POST["user_name"],
                        "email" => $_POST["email"],
                        "hash_mdp" => $password_hash,
                        "date_enregistrement" => $date_enregistrement
                    ];
                    
                    $this->loadModel("Utilisateur");
                    $this->model->table = "utilisateurs";
                    $this->model->array_user_keys = $array_selector;
                    $this->model->array_value_request = $array;
                    $utilisateur_exist = $this->model->is_exist_user();
                    
                    if ($utilisateur_exist){

                        $this->render_page("inscription", ["res_query" => "utilisateur_existe"]);
                        return true;

                    }

                    $status = $this->model->insert();

                    $this->render_page("inscription", ["res_query" => $status]);
                    return true;

            } else {

                $this->render_page("inscription", ["res_query" => "parametres_manquant"]);

            }
       
        }

        public function connexion(){

            if (isset($_POST["login"]) && !empty($_POST["login"]) && 
            isset($_POST["password"]) && !empty($_POST["password"])) {
                
                $this->loadModel("Utilisateur");
                $this->model->table = "utilisateurs";
                $this->model->array_user_keys = [
                                                    "email" => $_POST["login"],
                                                    "telephone" => $_POST["login"]
                                                ];
                $user = $this->model->is_exist_user();

                if ($user) {

                    if(password_verify($_POST["password"], $user["hash_mdp"])){

                        $this->render_page("connexion", ["status" => "password_ok"]);
                        return true;

                    } else {

                        $this->render_page("connexion", ["status" => "password_notok"]);
                        return false;

                    }
                    

                } else {

                    $this->render_page("connexion", ["status" => "user_not_exist"]); 
                    return false;

                }

        } else {

            $this->render_page("connexion", ["status" => "miss_parameters"]);
            return false;

        }


        }

    }

?>