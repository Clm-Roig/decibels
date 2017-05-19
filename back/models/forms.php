<?php
require_once('../config/connexionBD.php');

class forms {

    // ========= ATTRIBUTES ========= //
    var $forms_song_id;           // integer
    var $forms_production_id;     // integer
    // ============================= //


    // ==== Simple requests ==== //
    public function getAllForms() {
        $req = myPDO()->prepare('SELECT * FROM forms');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_CLASS, "forms");
        $object = array_map('reset',$object);
        return $object;
    }

    public function countForms() {
        $req = myPDO()->prepare('SELECT forms_song_id FROM forms');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getFormsBySongId($formsSongId) {
        $req = myPDO()->prepare('SELECT * FROM forms WHERE forms_song_id = :forms_song_id');
        $req->execute(array(':forms_song_id' => $formsSongId));
        $object = $req->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_CLASS, "forms");
        $object = array_map('reset',$object);
        return $object;
    }

    public function getFormsByProductionId($formsProductionId) {
        $req = myPDO()->prepare('SELECT * FROM forms WHERE forms_production_id = :forms_production_id');
        $req->execute(array(':forms_production_id' => $formsProductionId));
        $object = $req->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_CLASS, "forms");
        $object = array_map('reset',$object);
        return $object;
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertForms($formsSongId, $formsProductionId) {
        $formsId = $this->getIdMax() + 1;
        $sql = "INSERT INTO forms VALUES (:forms_song_id, :forms_production_id)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':forms_song_id' => $formsSongId,
          ':forms_production_id' => $formsProductionId
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

    public function deleteForms($formsSongId, $formsProductionId) {
        $sql = "DELETE FROM forms WHERE forms_song_id = :forms_song_id AND forms_production_id =: forms_production_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':forms_song_id' => $formsSongId,
          ':forms_production_id' => $formsProductionId
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

    // ==== Complex requests ==== //

}
