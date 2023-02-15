<?php

class ControllerMessage extends Controller {
    
    public const RENDER_FOLDER = "Message";

    public function __Construct() {

        $this->renderFolder = self::RENDER_FOLDER;

    }

    public function envoyer() : void{

        if (isset($_POST["name"]) &&
            isset($_POST["firstname"]) &&
            isset($_POST["message"]) &&
            isset($_POST["email"])) {

                $date_send = date("Y-m-d h:i:s");

                if (isset($_POST["objet"])){

                    $objet = $_POST['objet'];

                } 

                $message = [
                    "nom" => $_POST["name"],
                    "prenom" => $_POST["firstname"],
                    "message" => $_POST["message"],
                    "date_envoie" => $date_send,
                    "email" => $_POST["email"],
                    "objet" => $objet,
                    "est_supprimer" => 0
                ];
                
                $this->loadModel("Message");
                $status = $this->model->insert($message);

                echo json_encode(["status" => $status]);
            
            } else {

                echo json_encode(["status" => 'erreur']);

            }
    }

    public function getMessages() : string {

        $this->loadModel("Message");
        $messages = $this->model->getAll();

        echo json_encode($messages);
        //$this->renderPage("get_messages", ["messages" => $messages]);       
    }

}


?>