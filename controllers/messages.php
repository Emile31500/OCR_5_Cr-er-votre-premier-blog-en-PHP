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
                $this->Message->table="Messages";
                $messages = $this->Message->insert($array);


            }
            
        $this->render_page("index", [
                                    "title" => "Accueil",
                                    "description" => [
                                        "Passionné d'informatique depuis ma 3em, je suis diplômé d'un BTS Services Informatiques aux Organisations spécialité administration réseau. Suite à cela, je en formation de développement PHP/Symfony.",
                                        "Dans l'avenir, après avoir continué vers un diplôme d'ingénieure dans le même domaine, je proposerai par la suite mes services de développeur full stack Symfony et JavaScript sur Toulouse et environ en présentiel, et sur toute la France en télétravail."
                                    ]

                                    
                                ]);

    }


}


?>