<?php
require_once('../config/connexionBD.php');

class style {

    // ========= ATTRIBUTES ========= //
    var $style_id;            // integer
    var $style_name;          // text
    // ============================= //


    // ==== Simple requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(style_id) FROM styles');
        return $maxId->fetch()[0];
    }

    public function getAllStyles() {
        $req = myPDO()->query('SELECT * FROM styles');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "style");
        return $object;
    }

    public function getAllStylesSorted() {
        $req = myPDO()->prepare('SELECT * FROM styles ORDER BY style_name');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "style");
        return $object;
    }

    public function countStyles() {
        $req = myPDO()->query('SELECT style_id FROM styles');
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getStyle($styleId) {
        $req = myPDO()->prepare('SELECT * FROM styles WHERE style_id = :style_id');
        $req->execute(array(':style_id' => $styleId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "style");
        return $object;
    }

    public function getStylesByName($styleName) {
        $req = myPDO()->prepare('SELECT * FROM styles WHERE style_name = :style_name');
        $req->execute(array(':style_name' => $styleName));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "style");
        return $object;
    }
    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertStyle($styleName) {
        // Is this style already in the DB ?
        $exists = $this->getStylesByName($styleName);
        if(empty($exists)) {
            $styleId = $this->getIdMax() + 1;
            $sql = "INSERT INTO styles VALUES (:style_id, :style_name)";
            $req = myPdo()->prepare($sql);
            $params = [
              ':style_id' => $styleId,
              ':style_name' => $styleName
            ];
            try {
                $req->execute($params);
            }
            catch (Exception $e) {
                // error during execute (bad request)
                http_response_code(400);
            }
        }
        else {
            // style already registered (conflict)
            http_response_code(409);
        }
    }

    public function updateStyle($styleId, $styleName) {
        $sql = myPdo()->prepare("UPDATE styles SET style_name=:style_name WHERE style_id = :style_id");
        $params = [
          ':style_name' => $styleName,
          ':style_id' => $styleId
        ];
        try {
            $sql->execute($params);
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function deleteStyle($styleId) {
        $sql = "DELETE FROM styles WHERE style_id = :style_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':style_id' => $styleId,
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }
    // ====================================== //

}
