<?php
ini_set('display_errors', 1);
    // Request type
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

    $controllerName = $request['controller'];
    $controllerObj = getController($controllerName, $request);

    $methodName = $request['method'];
    $data = $controllerObj->$methodName();
    echo $data;


    // ======== Functions ======== //

    // Retourne un objet Controller
    function getController($controller, $params) {

        $classController = $controller . "Controller";
        $fileController = "controllers/" . $classController . ".php";

        if (file_exists($fileController)) {
            // Instanciation du contrôleur adapté à la requête
            require($fileController);
            $controller = new $classController($params);
            return $controller;
        }
        else {
            throw new Exception("File '$fileController' not found.");
        }
    }
