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

    // format : ?controller=aController&method=aMethod&id=3
    $controllerName = $request['controller'];
    $method = $request['method'];
    $controllerObj = getController($controllerName);
    // S'il n'y a pas d'id, on exécute une fonction simple sans paramètre
    if(empty($request['id'])){
        $data = $controllerObj->$method();
        echo $data;
    }
    // sinon on file l'id et le nom de la méthode au controleur
    else {
        $data = $controllerObj->$method($request['id']);
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
            throw new Exception("Fichier '$fileController' introuvable.");
        }
    }
