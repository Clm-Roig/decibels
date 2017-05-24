<?php
require_once('../config/connexionBD.php');

class forms {

    // ========= ATTRIBUTES ========= //
    var $forms_song_id;           // integer
    var $forms_production_id;     // integer
    // ============================= //


    // ==== Simple requests ==== //
    public function getAllForms() {
        $req = myPDO()->query('SELECT * FROM forms');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "forms");
        return $object;
    }

    public function countForms() {
        $req = myPDO()->query('SELECT forms_song_id FROM forms');
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getFormsBySongId($formsSongId) {
        $req = myPDO()->prepare('SELECT * FROM forms WHERE forms_song_id = :forms_song_id');
        $req->execute(array(':forms_song_id' => $formsSongId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "forms");
        return $object;
    }

    public function getFormsByProductionId($formsProductionId) {
        $req = myPDO()->prepare('SELECT * FROM forms WHERE forms_production_id = :forms_production_id');
        $req->execute(array(':forms_production_id' => $formsProductionId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "forms");
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
            // error during execute (bad request)
            http_response_code(400);
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
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }
    // ====================================== //

}
