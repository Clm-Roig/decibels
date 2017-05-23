<?php
ini_set('display_errors', 1);

    // Request type
    $request = $_.$_SERVER['REQUEST_METHOD'];

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
