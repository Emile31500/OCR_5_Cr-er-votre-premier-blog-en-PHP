<?php
class Articles extends Controller {


    public function liste(){

        $this->render_page("index", ["title" => "Articles "]);

    }

    public function editer(){
        
        global $params;

        if (isset($params[2]) && !empty($params[2]) && 
            isset($_SESSION["id_admin"]) && !empty($_SESSION["id_admin"])){

            $this->loadModel("Article");
            $this->model->table = "articles";
            $this->model->id = $params[2];
            $res = $this->model->getOne();

            $this->render_page("editer", ["title" => $res['libelle'],
                                        "article" => $res]);
            return true;

        } else {

            header("lcoation:http://127.0.0.1/Projet%20OC5/accueil/index");
            return false;

        }            

    }

    public function edition(){

        if (isset($_POST["id_article"]) && !empty($_POST["id_article"]) &&
            isset($_SESSION["id_admin"]) && !empty($_SESSION["id_admin"])){

            if (isset($_FILES["title_image"]) && !empty($_FILES["title_image"]) ||
                isset($_POST["title_article"]) && !empty($_POST["title_article"]) ||
                isset($_POST["text_area_article"]) && !empty($_POST["text_area_article"])) {

                $date = date("Y-m-d h:i:s");
                $array_values = [
                    "id_redacteur" => $_SESSION["id_admin"],
                    "date_derniere_modification" => $date
                ];

                if (isset($_FILES["title_image"]) && !empty($_FILES["title_image"]) && $_FILES["title_image"]['error'] != 4){

                    $image_name = $_FILES["title_image"]["tmp_name"];
                    $image_size = $_FILES["title_image"]["size"];
                    $image_max_size = 1024^2;

                    if($image_size > $image_max_size) {

                        $random_image_name = uniqid();
                        $random_image_name .= ".png";

                        move_uploaded_file($image_name, "media/image/article_image/".$random_image_name);
                        

                        $array_values["image"] = $random_image_name;
                
                    } else {

                        $this->render_page("edition", ["status" => "error_1"]);
                        return false;

                    }

                }

                if (isset($_POST["title_article"]) && !empty($_POST["title_article"])){

                    $array_values["libelle"] = $_POST["title_article"];

                }

                if (isset($_POST["text_area_article"]) && !empty($_POST["text_area_article"])){

                    $array_values["article"] = $_POST["text_area_article"];

                }
                    
                $this->loadModel("Article");
                $this->model->table = "articles";
                $this->model->id = $_POST["id_article"];
                $this->model->array_value_request = $array_values;
                $res = $this->model->UpdateOne();
                $this->render_page("edition", ["status" => $res]);
                return true;

            } else {

                $this->render_page("edition", ["status" => "error_2"]);
                return false;
        
            }

        } else {

            header("lcoation:http://127.0.0.1/Projet%20OC5/accueil/index");
            return false;

        }

    }

    public function list_admin(){

        if ($_SESSION["id_admin"] != false ){

            $array_selector = array("id_redacteur" => $_SESSION["id_admin"]);

            $this->loadModel("Article");
            $this->model->table = "articles";
            $this->model->array_selector_request = $array_selector;
            $res = $this->model->get_list_admin();
    
            $this->render_page("list_admin", ["articles" => $res]);
            return true;

        }

       

    }

    public function lire(){

        $this->render_page("index", ["title" => "Voilà."]);

    }

    public function supprimer(){

        global $params;

        if (isset($params[2]) && !empty($params[2]) && 
        isset($_SESSION["id_admin"]) && !empty($_SESSION["id_admin"])) {

            $this->loadModel("Article");
            $this->model->id = $params[2];
            $this->model->table = "articles";
            $status = $this->model->supprimer();

            $this->render_page("supprimer", ["status" => $status]);
            return false;    

        } else {

            header("location:http://127.0.0.1/Projet%20OC5/accueil/index");
            return false;

        }

    } 

    public function publier(){

        global $params;

        if (isset($params[2]) && !empty($params[2]) && 
        isset($_SESSION["id_admin"]) && !empty($_SESSION["id_admin"])) {

            $this->loadModel("Article");
            $this->model->id = $params[2];
            $this->model->table = "articles";
            $this->model->array_value_request = ["est_publier" => 1];
            $status = $this->model->updateOne();

            $this->render_page("publier", ["status" => $status]);
            return false;    

        } else {

            header("location:http://127.0.0.1/Projet%20OC5/accueil/index");
            return false;

        }

    } 

    public function nouveau(){

        if ($_SESSION["id_admin"] != false ){

            
            $this->render_page("nouveau", ["title" => "Créer un nouveau article : "]);
            return true;

        } else {

            header("location:http://127.0.0.1/Projet%20OC5/accueil/index");
            return false;

        }


    }

    public function ajout(){
        
       if (isset($_SESSION["id_admin"]) && !empty($_SESSION["id_admin"])){


            if (isset($_POST["text_area_article"]) && !empty($_POST["text_area_article"]) &&  
                isset($_POST["title_article"]) && !empty($_POST["title_article"]) &&  
                isset($_FILES["title_image"]) && !empty($_FILES["title_image"])){

                    $image_name = $_FILES["title_image"]["tmp_name"];
                    $image_size = $_FILES["title_image"]["size"];
                    $image_max_size = 1024^2;

                    if($image_size > $image_max_size) {

                        $random_image_name = uniqid();
                        $random_image_name .= ".png";

                        move_uploaded_file($image_name, "media/image/article_image/".$random_image_name);
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
                        return true;

                    } else {

                        $this->render_page("ajout", ["status" => "error_1"]);
                        return false;

                    }     

            } else {

                
                $this->render_page("ajout", ["status" => "error_2"]);
                return false;

            }

        } else {

            header("location:http://127.0.0.1/Projet%20OC5/accueil/index");
            return false;
        }
    
    }
    
}


?>