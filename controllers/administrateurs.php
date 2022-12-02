<?php

class Administrateurs extends Controller {


    public function index(){

        $this->render_page("index", ["title" => "Se connecter"]);

    }

    public function ajouter(){

        $this->render_page("ajouter", ["title" => "Nouvel administrateur "]);

    }

    public function nouveau(){

        if (isset($_POST["name"]) && !empty($_POST["name"]) &&
        isset($_POST["firstname"]) && !empty($_POST["firstname"]) &&
        isset($_POST["email"]) && !empty($_POST["email"]) &&
        isset($_POST["phone_number"]) && !empty($_POST["phone_number"]) &&
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
                    "email" => $_POST["email"],
                    "telephone" => $_POST["phone_number"],
                    "hash_mdp" => $password_hash,
                    "date_enregistrement" => $date_enregistrement

                ];
                
                $this->loadModel("Administrateur");
                $this->model->table = "administrateurs";
                $this->model->array_user_keys = $array_selector;
                $this->model->array_value_request = $array;
                $admin_exist = $this->model->is_admin_exist();
                
                if ($admin_exist){

                    $this->render_page("nouveau", ["res_query" => "error_1"]);
                    return true;

                }

                $status = $this->model->insert();

                if ($status) {

                    $this->render_page("nouveau", ["res_query" => "singed"]);
                    return true;

                } else {

                    return false;

                }
                

        } else {

            $this->render_page("nouveau", ["res_query" => "error_2"]);

        }
    }

    public function connexion(){

        if (isset($_POST["login"]) && !empty($_POST["login"]) && 
        isset($_POST["password"]) && !empty($_POST["password"])) {
            
            $this->loadModel("Administrateur");
            $this->model->table = "administrateurs";
            $this->model->array_user_keys = [
                                                "email" => $_POST["login"],
                                                "telephone" => $_POST["login"]
                                            ];
            $admin = $this->model->is_admin_exist();

            if ($admin) {

                if(password_verify($_POST["password"], $admin["hash_mdp"])){

                    $_SESSION["id_admin"] = $admin["id"];
                    $this->render_page("connexion", ["res_query" => "password_ok"]);
                    return true;

                } else {

                    $this->render_page("connexion", ["res_query" => "error_1"]);
                    return false;

                }
                

            } else {

                $this->render_page("connexion", ["res_query" => "error_2"]); 
                return false;

            }

        } else {

            $this->render_page("connexion", ["res_query" => "error_3"]);
            return false;

        }
        
    }


}


?>