<?php
    //Constance chemin
    define('ROOT', str_replace('index.php', "", $_SERVER['SCRIPT_FILENAME']));
    session_start();

    require_once(ROOT.'vendor/autoload.php');

    $loader = new Twig_loader_Filesystem(ROOT."template");
    $twig = new Twig_Environment($loader, [/*'cache' => ROOT."/tmp"*/]);

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

            if (method_exists($controller, $action)){

                $controller->$action();
    
            } else {
    
                http_response_code(404);
                echo 1;
                echo $twig->render("404.twig");

            }

        } else {

            http_response_code(404);
            echo 2;
            echo $twig->render("404.twig");
            
        }
    
    } else{

        http_response_code(404);
        echo 3;
        echo $twig->render("404.twig");

    }


?>