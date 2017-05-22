<?php
    $GLOBALS['peppers'] = "513B1C3D_Cl0m1rg_1G3_Mu51C";

    function hashPassword($password) {
        $options = ['salt' => $GLOBALS['peppers']];
        $hash = password_hash($password, PASSWORD_DEFAULT, $options);
        return $hash;
    }

    // génère un token d'authentification à partir de l'id de l'admin
    function generateToken($admin_id) {
        return password_hash($admin_id,PASSWORD_DEFAULT);
    }
