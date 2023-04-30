<?php
<<<<<<< HEAD

=======
    //Constance chemin
>>>>>>> OCR5/master
    define('ROOT', str_replace('index.php', "", $_SERVER['SCRIPT_FILENAME']));
    session_start();

    require_once(ROOT.'vendor/autoload.php');

<<<<<<< HEAD
    if (is_dir("./template")){

        $loader = new \Twig\Loader\FilesystemLoader(ROOT.'template');

    } else {

        echo "Il n'existe pas";

    }

    $twig = new Twig_Environment($loader);
=======
    $loader = new Twig_loader_Filesystem(ROOT."template");
    $twig = new Twig_Environment($loader, [/*'cache' => ROOT."/tmp"*/]);
>>>>>>> OCR5/master

    require_once(ROOT.'app/Model.php');
    require_once(ROOT.'app/Controller.php');
    
   
    $params = explode('/', $_GET['p']);

    //Le paramètre existe ?

    if (isset($params[0])) {

<<<<<<< HEAD
       $controller = ucfirst($params[0]);
       $controller = "Controller".$controller;

        if (isset($params[1])){

           $action = $params[1];

        } else {

        $action = 'index';
=======
        $controller = ucfirst($params[0]);
        $controller = "Controller".$controller;

        if (isset($params[1])){

            $action = $params[1];

        } else {

            $action = 'index';
>>>>>>> OCR5/master

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
<<<<<<< HEAD
        
            } else {
        
=======
    
            } else {
    
>>>>>>> OCR5/master
                http_response_code(404);
                echo $twig->render("404.twig");

            }

        } else {

            http_response_code(404);
            echo $twig->render("404.twig");
<<<<<<< HEAD
                
        }

    } else {

        http_response_code(404);
        echo $twig->render("404.twig");
            
    }
?>
=======
            
        }
    
    } else{

        http_response_code(404);
        echo $twig->render("404.twig");

    }


 ?>

>>>>>>> OCR5/master
