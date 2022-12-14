<?php

class Commentaires extends Controller 
{

    public function Envoyer(){

        if(isset($_SESSION["id_user"]) && !empty($_SESSION["id_user"])){

            if (isset($_POST["message"]) && !empty($_POST["message"])){

                $this->loadModel("Commentaire");
                $this->model->table = "commentaires";
                $this->model->array_value_request = ["id_utilisateur" => $_SESSION["id_user"],
                                                    "id_article" => $_POST["id_article"],
                                                    "message" => $_POST["message"]];
                $result = $this->model->insert();
                
                $this->render_page("envoyer", ["status"=> $result]);

            }


        } else {

            $this->render_page("envoyer", ["status"=> "error_1"]);
        
        }

    }

    public function Liste(){

        global $params;

        if(isset($params[2]) && !empty($params[2])){
            
            $this->loadModel("Commentaire");
            $this->model->table = "commentaires";
            $this->model->id_article = $params[2];
            $result = $this->model->Liste();
            
            $this->render_page("liste", ["commentaires"=> $result]);

        } else {

            header("location:http://127.0.0.1/Projet%20OC5/accueil/index/");

        }

    }
    
}



?>