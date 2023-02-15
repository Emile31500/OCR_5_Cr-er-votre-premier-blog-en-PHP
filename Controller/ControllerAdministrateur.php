<?php

use \EditorJS\EditorJS;

class ControllerAdministrateur extends Controller {

    public const RENDER_FOLDER = "Administrateur";

    public function __Construct() {

        $this->renderFolder = self::RENDER_FOLDER;

    }

    public function index() : void
    {

        $this->renderPage("index", ["title" => "Se connecter"]);

    }

    public function ajouter() : void
    {

        if ($_SESSION["id_admin"] != false ){

            $this->renderPage("ajouter", ["title" => "Nouvel administrateur "]);
        
        } else {

            header("location:http://127.0.0.1/Projet%20OC5/accueil/index");
        }

    }

    public function dashbord() : void
    {
        

        if (isset($_SESSION["id_admin"])){

            $this->renderPage("dashbord", [
                "title" => "Tableau de bord "
            ]);

        } else {
            
            header("location:http://127.0.0.1/Projet%20OC5/accueil/index");
        
        }
        
       

    }

    public function nouveau() : void
    {
    
        if (isset($_POST["name"]) &&
            isset($_POST["firstname"]) &&
            isset($_POST["email"]) &&
            isset($_POST["phone_number"]) &&
            isset($_POST["password"]) &&
            isset($_POST["confirm_password"])){

                    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

                    $date_enregistrement = date("Y-m-d");
                    $array_selector = [
                                        "email" => $_POST['email'],
                                        "telephone" => $_POST["phone_number"]
                                    ];


                    $administrateur = [
                        "nom" => $_POST["name"],
                        "prenom" => $_POST["firstname"],
                        "email" => $_POST["email"],
                        "telephone" => $_POST["phone_number"],
                        "hash_mdp" => $password_hash,
                        "date_enregistrement" => $date_enregistrement

                    ];
                    
                    $this->loadModel("Administrateur");
                    $admin_exist = $this->model->isAdminExist($administrateur["email"], $administrateur["telephone"]);
                    
                    if ($admin_exist){

                        $this->renderPage("nouveau", ["res_query" => "error_1"]);

                    }

                    $status = $this->model->insert();

                    if ($status) {

                        $this->renderPage("nouveau", ["res_query" => "singed"]);

                    }

            } else {

                $this->renderPage("nouveau", ["res_query" => "error_2"]);

            }
    }

    public function connexion()// : void
    {

        if (isset($_POST["login"]) &&
            isset($_POST["password"])) {
            
            $this->loadModel("Administrateur");
            $admin = $this->model->isAdminExist($_POST["login"], $_POST["login"]);

            if ($admin) {

                if(password_verify($_POST["password"], $admin["hash_mdp"])){

                    $_SESSION["id_admin"] = $admin["id"];
                    unset($_SESSION["id_user"]);
                    
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode(["status" => "password_ok"]);

                } else {

                    echo json_encode(["status" => "error_1"]);
                
                }
                

            } else {

                echo json_encode(["status" => "error_2"]);
            
            }

        } else {

            echo json_encode(["status" => "error_3"]); 

        }
        
    }


}


?>