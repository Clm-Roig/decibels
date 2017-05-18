<?php
include('../config/connexionBD.php');

class style {

    // ========= ATTRIBUTES ========= //
    private $styleId;            // integer
    private $styleName;          // text
    // ============================= //


    // ==== Simple requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(style_id) FROM styles');
        return $maxId->fetch()[0];
    }

    public function getAllStyles() {
        $req = myPDO()->prepare('SELECT * FROM styles');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "style");
        return json_encode($object);
    }

    public function countStyles() {
        $req = myPDO()->prepare('SELECT style_id FROM styles');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getStyle($styleId) {
        $req = myPDO()->prepare('SELECT * FROM styles WHERE style_id = :style_id');
        $req->execute(array(':style_id' => $styleId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "style");
        return json_encode($object);
    }

    public function getStylesByName($styleName) {
        $req = myPDO()->prepare('SELECT * FROM styles WHERE style_name = :style_name');
        $req->execute(array(':style_name' => $styleName));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "style");
        return json_encode($object);
    }
    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertStyle($styleName) {
        $styleId = $this->getIdMax() + 1;
        $sql = "INSERT INTO styles VALUES (:style_id, :style_name)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':style_id' => $styleId,
          ':style_name' => $styleNames
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
            return false;
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
            return false;
        }
    }
    // ====================================== //

}
