<?php

class ControllerCommentaire extends Controller 
{

    public const RENDER_FOLDER = "Commentaire";

    public function __Construct() {

        $this->renderFolder = self::RENDER_FOLDER;

    }

    public function Envoyer() : void {

        if(isset($_SESSION["id_user"])){

            if (isset($_POST["message"])){

                $this->loadModel("Commentaire");
                $commentaire = [
                    "id_utilisateur" => $_SESSION["id_user"],
                    "id_article" => $_POST["id_article"],
                    "message" => $_POST["message"]
                ];
                
                $result = $this->model->insert($commentaire);
                
                echo json_encode(["status"=> $result]);

            }


        } else {

            echo json_encode(["status"=> "error_1"]);
        
        }

    }

    public function Liste() : void{

        global $params;
        $idCommentaires = $params[2];
        if(isset($idCommentaires)){
            
            $this->loadModel("Commentaire");
            $result = $this->model->Liste($idCommentaires);
            
            $this->renderPage("liste", ["commentaires"=> $result]);

        } else {

            header("HTTP/1.1 Access Denied");

        }

    }
    
}



?>