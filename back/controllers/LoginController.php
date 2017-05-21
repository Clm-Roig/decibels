<?php
require('models/admin.php');
class LoginController {

    private $Login;
    private $params;

    function __construct($params = null) {
        $this->Login = new band();
        if($params != null) {
            $this->params = $params;
        }
    }

    function signIn() {
        $req = myPDO()->query('SELECT * FROM bands ORDER BY band_name');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "band");
        return $object;
    }



}
