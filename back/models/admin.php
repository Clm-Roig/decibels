<?php
require_once('../config/connexionBD.php');

class admin {

    // ========= ATTRIBUTES ========= //
    var $admin_id;          // integer
    var $admin_username;    // text
    var $admin_password;    // text
    // ============================= //


    // ==== Simple requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(admin_id) FROM admins');
        return $maxId->fetch()[0];
    }

    public function getAllAdmins() {
        $req = myPDO()->query('SELECT * FROM admins');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "admin");
        return $object;
    }

    public function countAdmins() {
        $req = myPDO()->query('SELECT admin_id FROM admins');
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getAdmin($adminId) {
        $req = myPDO()->prepare('SELECT * FROM admins WHERE admin_id = :admin_id');
        $req->execute(array(':admin_id' => $adminId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "admin");
        return $object;
    }

    public function getAdminsByUsername($adminUsername) {
        $req = myPDO()->prepare('SELECT * FROM admins WHERE admin_username = :admin_username');
        $req->execute(array(':admin_username' => $adminUsername));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "admin");
        return $object;
    }

    public function getAdminByPassword($adminPassword) {
        $req = myPDO()->prepare('SELECT * FROM admins WHERE admin_password = :admin_password');
        $req->execute(array(':admin_password' => $adminPassword));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "admin");
        return $object;
    }
    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertAdmin($adminUsername, $adminPassword) {
        $adminId = $this->getIdMax() + 1;
        $sql = "INSERT INTO admins VALUES (:admin_id, :admin_username, :admin_password)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':admin_id' => $adminId,
          ':admin_username' => $adminUsername,
          ':admin_password' => $adminPassword
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }

    public function updateAdmin($adminId, $adminUsername, $adminPassword) {
        $sql = myPdo()->prepare("UPDATE admins SET admin_username=:admin_username, admin_password=:admin_password WHERE admin_id = :admin_id");
        $params = [
          ':admin_id' => $adminId,
          ':admin_username' => $adminUsername,
          ':admin_password' => $adminPassword
        ];
        try {
            $sql->execute($params);
            return true;
        }
        catch (Exception $e) {
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }

    public function deleteAdmin($adminId) {
        $sql = "DELETE FROM admins WHERE admin_id = :admin_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':admin_id' => $adminId,
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }
    // ====================================== //

}
