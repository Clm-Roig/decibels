<?php
// Classe d'accès à la BD
include('config/connexionBD.php');

class Style {

    // ========= ATTRIBUTES ========= //
    private $styleId;        //integer
    private $styleName;      // text
    // ============================= //

    public function getStyles() {
        $req = myPDO()->prepare('SELECT * FROM styles');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Style");
        return json_encode($object);
    }

    public function countStyles() {
        $req = myPDO()->prepare('SELECT style_id FROM styles');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }

    public function getStyle($id) {
        $req = myPDO()->prepare('SELECT * FROM styles WHERE style_id = ?');
        $req->execute(array($id));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Style");
        return json_encode($object);
    }
}
