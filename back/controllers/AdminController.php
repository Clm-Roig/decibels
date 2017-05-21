<?php
require('models/admin.php');
class AdminController {

    private $Admin;
    private $params;

    function __construct($params = null) {
        $this->Admin = new admin();
        if($params != null) {
            $this->params = $params;
        }
    }

    // Check for admin connection
    function signIn() {
        $token = "";

        $admin = $this->Admin->getAdminsByUsername($this->params['admin_username']);
        if(!empty($admin)) {
            $admin = $admin[0];
            if(is_a($admin,'admin')) {
                // check password
                $isLogOk = password_verify($this->params['admin_password'],$admin->admin_password);
                if($isLogOk) {
                    $token = ["token" => "admin"];
                }
                else {
                    // unauthorized (wrong password)
                    http_response_code(401);
                }
            }
            else {
            // unauthorized (wrong username)
            http_response_code(401);
            }
        }
        else {
            // unauthorized (wrong username)
            http_response_code(401);
        }

        return $token;
    }

}
