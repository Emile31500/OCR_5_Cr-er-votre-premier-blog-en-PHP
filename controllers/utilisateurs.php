<?php

    class Utilisateurs extends Controller {

        public function sinscrire(){

            $user = $this->is_user_connected();
            $this->render_page("sinscrire", ["title" => "Nouveau utilisateur",
                                            "user" => $user]);

        }

        public function seconnecter(){

            $user =  $this->is_user_connected();
            $this->render_page("seconnecter", ["title" => "Connectez-vous !",
                                                "user" => $user]);

        }

        public function sedeconnecter(){

            $user = false;
            unset($_SESSION['id_user']);
            $this->render_other_controller("accueil/index", ["title" => "Accueil",
                                                            "description" => [
                                                                "Passionné d'informatique depuis ma 3em, je suis diplômé d'un BTS Services Informatiques aux Organisations spécialité administration réseau. Suite à cela, je en formation de développement PHP/Symfony.",
                                                                "Dans l'avenir, après avoir continué vers un diplôme d'ingénieure dans le même domaine, je proposerai par la suite mes services de développeur full stack Symfony et JavaScript sur Toulouse et environ en présentiel, et sur toute la France en télétravail."
                                                            ],"user" => $user]);

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
                        "date_naissance" => $_POST["birth_day"],
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

                        $_SESSION["id_user"] = $user["id"];
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