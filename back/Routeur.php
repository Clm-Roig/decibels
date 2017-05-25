<?php
ini_set('display_errors', 1);

    // TODO : API... 
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
    else if(!empty($_DELETE)) {
        $request = $_DELETE;
    }

    $controllerName = $request['controller'];
    $controllerObj = getController($controllerName, $request);

    $methodName = $request['method'];
    $data = $controllerObj->$methodName();

    // GET
    if($data !== true && $data !== false) {
        echo json_encode($data);
    }
    else {
    // POST / PUT / DELETE change the http_response_code by theirself in /models
    }

    // ======== Functions ======== //

    // Retuns a controller
    function getController($controller, $params) {

        $classController = $controller . "Controller";
        $fileController = "controllers/" . $classController . ".php";

        if (file_exists($fileController)) {
            // Controller creation
            require($fileController);
            $controller = new $classController($params);
            return $controller;
        }
        else {
            throw new Exception("File '$fileController' not found.");
        }
    }
