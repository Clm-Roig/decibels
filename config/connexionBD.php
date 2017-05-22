<?php
function myPDO() {

    // Base de données Heroku Décibels
    $dsn = "pgsql:host=ec2-54-228-189-223.eu-west-1.compute.amazonaws.com;dbname=d1enc09350ri9e";
    $login = "trzeopyajwsdwj";
    $mdp = "44f19d23c2e8c16215425f29e99bbe2335b6fa434cd7883500eb0f93412764eb";

    // Création de la connexion
    try {
        $bd = new PDO($dsn, $login, $mdp);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        echo 'Error creating PDO -> ';
        var_dump($e->getMessage());
    }
    return $bd;
}
