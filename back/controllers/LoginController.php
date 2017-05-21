<?php
require('models/admin.php');
class LoginController {

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
        $admin = $this->Admin->getAdminsByUsername($this->params['admin_username'])[0];
        if(is_a($admin,'admin')) {
            // check password
            $pswHashed = password_hash($this->password['admin_password'],PASSWORD_DEFAULT);
            $isLogOk = $this->Admin->getAdminsByPassword($pswHashed);
            if(is_a($isLogOk,'admin')) {
                $token = ["token" => "dsq56qsd"];
            }
            else {
                // unauthorized
                http_response_code(401);
            }
        }
        else {
            // unauthorized
            http_response_code(401);
        }

        return $obj;
    }

    // Create a new Admin
    function signUp() {
        $pswHashed = password_hash($this->password['admin_password'],PASSWORD_DEFAULT);
        $admin = $this->Admin->insertAdmin($this->params['admin_username'],$pswHashed);
    }

}
