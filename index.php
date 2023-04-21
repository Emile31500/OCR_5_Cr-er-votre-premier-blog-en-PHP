<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

    //Constance chemin
    define('ROOT', str_replace('index.php', "", $_SERVER['SCRIPT_FILENAME']));
    session_start();

    require_once(ROOT.'vendor/autoload.php');

    if (is_dir("./template")){

        $loader = new \Twig\Loader\FilesystemLoader(ROOT.'template');
        
        // $loader = new Twig_loader_Filesystem(__DIR__."/template");

    } else {

        echo "Il n'existe pas";

    }

    $twig = new Twig_Environment($loader);

    require_once(ROOT.'app/Model.php');
    require_once(ROOT.'app/Controller.php');
    
   
    $params = explode('/', $_GET['p']);

    //Le paramètre existe ?

    if (isset($params[0])) {

       $controller = ucfirst($params[0]);
       $controller = "Controller".$controller;

        if (isset($params[1])){

           $action = $params[1];

        } else {

        $action = 'index';

        }

        if(file_exists(ROOT.'Controller/'.$controller.'.php')){

            require_once(ROOT.'Controller/'.$controller.'.php');

            $controller = new $controller();
            $controller->setTwig($twig);

            if (isset($params[2])) {

                $controller->thirdUrlParameters = $params[2];

            }

            if (method_exists($controller, $action)){

                $controller->$action();
        
            } else {
        
                http_response_code(404);
                echo $twig->render("404.twig");

            }

        } else {

            http_response_code(404);
            echo $twig->render("404.twig");
                
        }

    } else {

        http_response_code(404);
        echo $twig->render("404.twig");
            
    }
?>