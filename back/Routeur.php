<?php
ini_set('display_errors', 1);
    // Type de requête
    if(!empty($_GET)) {
        $request = $_GET;
    }
    else if(!empty($_POST)) {
        $request = $_POST;
    }
    else if(!empty($_PUT)) {
        $request = $_PUT;
    }
    else if(!empty($_UPDATE)) {
        $request = $_UPDATE;
    }

    // format : ?controller=aController&method=aMethod
    $controllerName = $request['controller'];
    $method = $request['method'];
    $controllerObj = getController($controllerName);

    $data = $controllerObj->$method();
    echo $data;


    // ======== Functions ======== //

    // Retourne un objet Controller
    function getController($controller) {

        $classController = $controller . "Controller";
        $fileController = "controllers/" . $classController . ".php";

        if (file_exists($fileController)) {
            // Instanciation du contrôleur adapté à la requête
            require($fileController);
            $controller = new $classController;
            return $controller;
        }
        else {
            throw new Exception("Fichier '$fichierControleur' introuvable.");
        }
    }
