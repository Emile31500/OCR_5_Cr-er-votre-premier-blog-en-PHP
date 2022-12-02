<?php
    //Constance chemin 
    define('ROOT', str_replace('index.php', "", $_SERVER['SCRIPT_FILENAME']));
    
                            
    session_start();
    if(isset($_SESSION["id_user"]) && !empty($_SESSION["id_user"])){

        $id_user = $_SESSION["id_user"];

    } else {

        $id_user = false;

    }

    if(isset($_SESSION["id_admin"]) && !empty($_SESSION["id_admin"])){

        $id_admin = $_SESSION["id_admin"];

    } else {

        $id_admin = false;

    }

    require_once(ROOT.'vendor/autoload.php');
    
    $loader = new Twig_loader_Filesystem(ROOT."template");
    $twig = new Twig_Environment($loader, [/*'cache' => ROOT."/tmp"*/]);

    require_once(ROOT.'app/Model.php');
    require_once(ROOT.'app/Controller.php');
    
   
    $params = explode('/', $_GET['p']);

    //Le paramètre existe ?

    if (isset($params[0]) && !empty($params[0])) {

        $controller = ucfirst($params[0]);
        
        if (isset($params[1]) && !empty($params[1])){

            $action = $params[1];

        } else {

            $action = 'index';

        }

        require_once(ROOT.'controllers/'.$controller.'.php');
        $controller = new $controller();

        if (method_exists($controller, $action)){

            $controller->$action();

        } else {

            http_response_code(404);
            echo "La méthode ".$action." n'existe pas"; 

        }

    } else{

    }


?>