<?php
class ControllerAccueil extends Controller {

    public const RENDER_FOLDER = "Accueil";
    

    public function __Construct() {

        $this->renderFolder = self::RENDER_FOLDER;

    }

    public function index() : void {

 
        $this->renderPage("index", [
                                    "title" => "Accueil",
                                    "description" => [
                                        "Passionné d'informatique depuis ma 3em, je suis diplômé d'un BTS Services Informatiques aux Organisations spécialité administration réseau. Suite à cela, je en formation de développement PHP/Symfony.",
                                        "Dans l'avenir, après avoir continué vers un diplôme d'ingénieure dans le même domaine, je proposerai par la suite mes services de développeur full stack Symfony et JavaScript sur Toulouse et environ en présentiel, et sur toute la France en télétravail."
                                    ]]);

    }


}
 ?>
