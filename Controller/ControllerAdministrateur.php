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

<<<<<<< HEAD
        if (isset($_SESSION["id_admin"]) || true){
=======
        if (isset($_SESSION["id_admin"])){
>>>>>>> OCR5/master

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

                        header("Content-Type: application/json");
<<<<<<< HEAD
                        echo json_encode(["status" => false]);
=======
                        echo json_encode(["res_query" => "error_1"]);
>>>>>>> OCR5/master


                    }

                    $status = $this->model->insert($administrateur);

                    if ($status) {

                        header("Content-Type: application/json");
<<<<<<< HEAD
                        echo json_encode(["status" => "singed"]);
=======
                        echo json_encode(["res_query" => "singed"]);
>>>>>>> OCR5/master

                    }

            } else {

                header("Content-Type: application/json");
<<<<<<< HEAD
                echo json_encode(["status" => false]);
=======
                echo json_encode(["res_query" => "error_2"]);
>>>>>>> OCR5/master

            }
    }

    public function connexion() : void
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

<<<<<<< HEAD
                    header('Content-Type: application/json');
=======
>>>>>>> OCR5/master
                    echo json_encode(["status" => "error_1"]);
                
                }
                

            } else {

<<<<<<< HEAD
                header('Content-Type: application/json');
=======
>>>>>>> OCR5/master
                echo json_encode(["status" => "error_2"]);
            
            }

        } else {

<<<<<<< HEAD
            header('Content-Type: application/json');
=======
>>>>>>> OCR5/master
            echo json_encode(["status" => "error_3"]); 

        }
        
    }
    

    public function seDeconnecter() : void
    {
        if(isset($_SESSION['id_admin'])){

            unset($_SESSION['id_admin']);
            header("location:http://127.0.0.1/Projet%20OC5/accueil/index");

        }

    }


}
 ?>
