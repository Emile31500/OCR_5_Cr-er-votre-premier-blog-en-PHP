<?php

class Messages extends Controller {
    
    public function envoyer(){

        if (isset($_POST["name"]) && !empty($_POST["name"]) &&
            isset($_POST["firstname"]) && !empty($_POST["firstname"]) &&
            isset($_POST["message"]) && !empty($_POST["message"]) &&
            isset($_POST["email"]) && !empty($_POST["email"])) {

                if(isset($_POST["objet"]) && !empty($_POST["objet"])){

                    $objet = $_POST['objet'];

                } 

                $array = [
                    "nom" => $_POST["name"],
                    "prenom" => $_POST["firstname"],
                    "message" => $_POST["message"],
                    "email" => $_POST["email"],
                    "objet" => $objet,
                    "est_supprimer" => 0
                ];
                
                $this->loadModel("Message");
                $this->model->table = "messages";
                $this->model->array_value_request = $array;
                $status = $this->model->insert();
                
                $this->render_page("envoyer", ["status" => $status]);
            
            } else {

                $this->render_page("envoyer", ["status" => 'erreur']);

            }
    }

    public function get_messages(){

        $this->loadModel("Message");
        $this->model->table = "messages";
        $messages = $this->model->getAll();

        $this->render_page("get_messages", ["messages" => $messages]);       
    }

}


?>