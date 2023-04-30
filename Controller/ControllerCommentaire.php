<?php

class ControllerCommentaire extends Controller 
{

    public const RENDER_FOLDER = "Commentaire";

    public function __Construct() {

        $this->renderFolder = self::RENDER_FOLDER;

    }

    public function envoyer() : void {

        if(isset($_SESSION["id_user"])){

            if (isset($_POST["message"])){

                $this->loadModel("Commentaire");
                $commentaire = [
                    "id_utilisateur" => $_SESSION["id_user"],
                    "id_article" => $_POST["id_article"],
                    "message" => $_POST["message"]
                ];
                
                $result = $this->model->insert($commentaire);
                
<<<<<<< HEAD
                header("Content-Type:application/json");
=======
>>>>>>> OCR5/master
                echo json_encode(["status"=> $result]);

            }


        } else {

<<<<<<< HEAD
            header("Content-Type:application/json");
=======
>>>>>>> OCR5/master
            echo json_encode(["status"=> "error_1"]);
        
        }

    }

    public function liste() : void{

        $idCommentaires = $this->thirdUrlParameters;
        if(isset($idCommentaires)){
            
            $this->loadModel("Commentaire");
            $result = $this->model->Liste($idCommentaires);
            
<<<<<<< HEAD
            $this->renderPage("liste", ["commentaires"=> $result]);
=======
            /*ECHO A METTRE*/$this->renderPage("liste", ["commentaires"=> $result]);
>>>>>>> OCR5/master

        } else {

            header("HTTP/1.1 Access Denied");

        }

    }
    
}
 ?>
