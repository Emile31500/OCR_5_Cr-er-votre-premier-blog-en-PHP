<?php

class ControllerArticle extends Controller {

    public const RENDER_FOLDER = "Article";

    public function __Construct() {

        $this->renderFolder = self::RENDER_FOLDER;

    }

    public function liste() : void
    {

        $this->loadModel("Article");
        $result = $this->model->getList();
        $this->renderPage("liste", ["title" => "Articles ",
                                    "articles" => $result]);

    }

    public function editer() : void
    {
        $this->forbideNotAdmin();
        $idArticle = $this->thirdUrlParameters;

        if (isset($idArticle) && isset($_SESSION["id_admin"])){

            $this->loadModel("Article");
            $res = $this->model->getOne($idArticle);

             $this->renderPage("editer", ["title" => $res['libelle'],
                                         "article" => $res]);


        } else {

            header("lcoation:http://127.0.0.1/Projet%20OC5/accueil/index");

        }            

    }

    public function edition() : void
    {

        if (isset($_POST["id_article"]) &&
            isset($_SESSION["id_admin"])){

            if (isset($_FILES["title_image"]) ||
                isset($_POST["title_article"]) ||
                isset($_POST["editor"])) {

                $date = date("Y-m-d h:i:s");
                $article_modife = [
                    "id_redacteur" => $_SESSION["id_admin"],
                    "date_derniere_modification" => $date
                ];

                if (isset($_FILES["title_image"]) && $_FILES["title_image"]['error'] != 4){

                    $image_name = $_FILES["title_image"]["tmp_name"];
                    $image_size = $_FILES["title_image"]["size"];
                    $image_max_size = 1024^2;

                    if($image_size > $image_max_size) {

                        $random_image_name = uniqid();
                        $random_image_name .= ".png";

                        move_uploaded_file($image_name, "media/image/article_image/".$random_image_name);
                        

                        $article_modife["image"] = $random_image_name;
                
                    } else {

                        header("Content-Type: application/json");
                        echo json_encode(["status" => "error_1"]);

                    }

                }

                if (isset($_POST["title_article"])){

                    $article_modife["libelle"] = $_POST["title_article"];

                }

                if (isset($_POST["editor"])){

                    $article_modife["article"] = $_POST["editor"];

                }
                    
                $this->loadModel("Article");
                $res = $this->model->UpdateOne($article_modife, $_POST["id_article"]);

                header("location:http://127.0.0.1/Projet%20OC5/article/editer/".$_POST["id_article"]);


            } else {

                header("location:http://127.0.0.1/Projet%20OC5/article/editer/".$_POST["id_article"]);
        
            }

        } else {

            header("lcoation:http://127.0.0.1/Projet%20OC5/accueil/index");

        }

    }

    public function listAdmin() : void
    {
        
        header("Content-Type: application/json");

        if (isset($_SESSION["id_admin"])) {

            $array_selector = array("id_redacteur" => $_SESSION["id_admin"]);

            $this->loadModel("Article");
            $this->model->array_selector_request = $array_selector;
            $res = $this->model->getListAdmin();
            
            $res_json = json_encode($res);
            echo $res_json;

        } else {

            header("HTTP/1.1 Access Denied");

        }

       

    }

    public function lire() : void
    {
        $idArticle = $this->thirdUrlParameters;
        if (isset($idArticle)){

            $this->loadModel("Article");
            $res = $this->model->lire($idArticle);

            $this->renderPage("lire", ["title" => $res["libelle"],
                                        "article" => $res]);
        
        }

    }

    public function supprimer() : void
    {
        $idArticle = $this->thirdUrlParameters;

        if (isset($idArticle) && isset($_SESSION["id_admin"])) {

            $this->loadModel("Article");
            $status = $this->model->supprimer($idArticle);

            echo json_encode(["status" => $status]);

        } else {

            header("HTTP/1.1 Access Denied");

        }

    } 

    public function publier() : void
    {
        
        $idArticle = $this->thirdUrlParameters;
        if (isset($idArticle) &&
            isset($_SESSION["id_admin"])) {

            $this->loadModel("Article");
            $article = $this->model->getOne($idArticle);
            $article_a_publier = ["est_publier" => !($article["est_publier"])];

            $status = $this->model->updateOne($article_a_publier, $idArticle);

            echo json_encode(["status" => $status]);

        } else {

            header("HTTP/1.1 Access Denied");

        }

    } 

    public function nouveau() : void
    {

        if (isset($_SESSION["id_admin"])){

            $this->renderPage("nouveau", ["title" => "Créer un nouveau article : "]);

        } else {

            header("HTTP/1.1 Access Denied");

        }


    }

    public function ajout() : void
    {
        
       if (isset($_SESSION["id_admin"])){


            if (isset($_POST["editor"]) &&  
                isset($_POST["title_article"]) &&  
                isset($_FILES["title_image"])){

                    $image_name = $_FILES["title_image"]["tmp_name"];
                    $image_size = $_FILES["title_image"]["size"];
                    $image_max_size = 1024^2;

                    if($image_size > $image_max_size) {

                        $random_image_name = uniqid();
                        $random_image_name .= ".png";

                        move_uploaded_file($image_name, "media/image/article_image/".$random_image_name);
                        $date = date("Y-m-d h:i:s");

                        $article = [
                                    "id_redacteur" => $_SESSION["id_admin"],
                                    "libelle" => $_POST["title_article"],
                                    "article" => $_POST["editor"],
                                    "image" => $random_image_name, 
                                    "date_derniere_modification" => $date,
                                    "date_enregistrement" => $date
                                ];

                        $this->loadModel("Article");
                        $status = $this->model->insert($article);
                        
                       echo json_encode(["status" => $status]);

                    } else {

                       echo json_encode(["status" => "error_1"]);

                    }     

            } else {

                
               echo json_encode(["status" => "error_2"]);

            }

        } else {

            header("HTTP/1.1 Access Denied");
        }
    
    }
    
}
 ?>
