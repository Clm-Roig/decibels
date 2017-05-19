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

    // format : ?controller=aController&method=aMethod&id=3
    $controllerName = $request['controller'];
    $method = $request['method'];
    $controllerObj = getController($controllerName);


    // Request with id
    if(!empty($request['id'])){
        $data = $controllerObj->$method($request['id']);
        echo $data;

    }
    // Request with limit
    else if(!empty($request['limit'])){
        $data = $controllerObj->$method($request['limit']);
        echo $data;
    }
    // Simple function without parameter
    else {
        $data = $controllerObj->$method();
        echo $data;
    }

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
            throw new Exception("File '$fileController' not found.");
        }
    }
