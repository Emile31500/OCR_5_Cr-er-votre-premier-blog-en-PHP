<?php

class Articles extends Controller {


    public function liste(){

        $this->render_page("index", ["title" => "Articles "]);

    }

    public function lire(){

        $this->render_page("index", ["title" => "Voilà."]);

    }

    public function nouveau(){

        if ($_SESSION["id_admin"] != false ){

            
            $this->render_page("nouveau", ["title" => "Créer un nouveau article : "]);

        } else {

            header("location:http://127.0.0.1/Projet%20OC5/accueil/index");

        }


    }

    public function ajout(){
        //if ($_SESSION["id_admin"] != false ){


            if (isset($_POST["text_area_article"]) && !empty($_POST["text_area_article"]) &&  
                isset($_POST["title_article"]) && !empty($_POST["title_article"]) &&  
                isset($_FILES["title_image"]) && !empty($_FILES["title_image"])){

                    $image_name = $_FILES["title_image"]["name"];
                    $image_size = $_FILES["title_image"]["size"];
                    $image_max_size = 1024^2;

                    if($image_size > $image_max_size) {

                        $random_image_name = uniqid();

                        move_uploaded_file($image_name, "media/image/article_image".$random_image_name);
                        $date = date("Y-m-d h:i:s");

                        $array_values = [
                                    "id_redacteur" => $_SESSION["id_admin"],
                                    "libelle" => $_POST["title_article"],
                                    "article" => $_POST["text_area_article"],
                                    "image" => $random_image_name, 
                                    "date_derniere_modification" => $date,
                                    "date_enregistrement" => $date
                                ];

                        $this->loadModel("Article");
                        $this->model->table = "articles";
                        $this->model->array_value_request = $array_values;
                        $status = $this->model->insert();
                        
                        $this->render_page("ajout", ["status" => $status]);

                    } else {

                        $this->render_page("ajout", ["status" => "error_1"]);

                    }     

            } else {

                
                $this->render_page("ajout", ["status" => "error_2"]);

            }

       /* } else {

            header("location:http://127.0.0.1/Projet%20OC5/accueil/index");

        }*/
    
    }
    
}


?>