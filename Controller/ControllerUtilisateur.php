<?php

    class ControllerUtilisateur extends Controller {

        public const RENDER_FOLDER = "Utilisateur";

        public function __Construct() {

            $this->renderFolder = self::RENDER_FOLDER;
    
        }

        public function sinscrire() : void { 

            $this->renderPage("sinscrire", ["title" => "Nouveau utilisateur"]);

        }

        public function seconnecter() : void{

            $this->renderPage("seconnecter", ["title" => "Connectez-vous !"]);

        }

        public function sedeconnecter() : void{

            $user = false;
            unset($_SESSION['id_user']);
            header('location:http://127.0.0.1/Projet%20OC5/accueil/index');
        }

        public function inscription() : void{

            if (isset($_POST["name"]) &&
                isset($_POST["firstname"]) &&
                isset($_POST["user_name"]) &&
                isset($_POST["email"]) &&
                isset($_POST["phone_number"]) &&
                isset($_POST["birth_day"]) &&
                isset($_POST["password"]) &&
                isset($_POST["confirm_password"])){

                    $array_selector = [
                        "email" => $_POST['email'],
                        "telephone" => $_POST["phone_number"]
                    ];

                    $this->loadModel("Utilisateur");
                    $this->model->array_user_keys = $array_selector;
                    $utilisateur_exist = $this->model->doesUserExist();

                    if ($utilisateur_exist){

                        /*ECHO A METTRE*/$this->renderPage("inscription", ["res_query" => "utilisateur_existe"]);

                    } else {

                        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                        $date_enregistrement = date("Y-m-d");
                        $utilisateur = [
                            "nom" => $_POST["name"],
                            "prenom" => $_POST["firstname"],
                            "nom_utilisateur" => $_POST["user_name"],
                            "date_naissance" => $_POST["birth_day"],
                            "email" => $_POST["email"],
                            "hash_mdp" => $password_hash,
                            "date_enregistrement" => $date_enregistrement
                        ];
                        
                        $status = $this->model->insert($utilisateur);

                        /*ECHO A METTRE*/$this->renderPage("inscription", ["res_query" => $status]);

                    }

            } else {

                /*ECHO A METTRE*/$this->renderPage("inscription", ["res_query" => "parametres_manquant"]);

            }
       
        }
        
        // : string avec json
        public function connexion(){

            if (isset($_POST["login"]) &&
                isset($_POST["password"])) {
                
                $this->loadModel("Utilisateur");
                $this->model->array_user_keys = [
                                                    "email" => $_POST["login"],
                                                    "telephone" => $_POST["login"]
                                                ];
                $user = $this->model->doesUserExist();

                if ($user) {

                    if(password_verify($_POST["password"], $user["hash_mdp"])){

                        $_SESSION["id_user"] = $user["id"];
                        unset($_SESSION["id_admin"]);
                        
                        echo json_encode(["status" => "password_ok"]);
                    } else {

                        echo json_encode(["status" => "password_notok"]);

                    }
                    

                } else {

                    echo json_encode(["status" => "user_not_exist"]);

                }

            } else {

                echo json_encode(["status" => "miss_parameters"]);

            }
            
        }

    }
 ?>
