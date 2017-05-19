<?php
require_once('../config/connexionBD.php');

class composedBy {

    // ========= ATTRIBUTES ========= //
    var $composed_by_band_id;          // integer
    var $composed_by_production_id;    // integer
    // ============================= //


    // ==== Simple requests ==== //
    public function getAllComposedBy() {
        $req = myPDO()->prepare('SELECT * FROM composed_by');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_CLASS, "composedBy");
        $object = array_map('reset',$object);
        return $object;
    }

    public function countComposedBy() {
        $req = myPDO()->prepare('SELECT composed_by_band_id FROM composed_by');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getComposedByByBandId($composedByBandId) {
        $req = myPDO()->prepare('SELECT * FROM composed_by WHERE composed_by_band_id = :composed_by_band_id');
        $req->execute(array(':composed_by_band_id' => $composedByBandId));
        $object = $req->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_CLASS, "composedBy");
        $object = array_map('reset',$object);
        return $object;
    }

    public function getComposedByByProductionId($composedByProductionId) {
        $req = myPDO()->prepare('SELECT * FROM composed_by WHERE composed_by_production_id = :composed_by_production_id');
        $req->execute(array(':composed_by_production_id' => $composedByProductionId));
        $object = $req->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_CLASS, "composedBy");
        $object = array_map('reset',$object);
        return $object;
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertComposedBy($composedByBandId, $composedByProductionId) {
        $composedById = $this->getIdMax() + 1;
        $sql = "INSERT INTO composed_by VALUES (:composed_by_band_id, :composed_by_production_id)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':composed_by_band_id' => $composedByBandId,
          ':composed_by_production_id' => $composedByProductionId
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

    public function deleteComposedBy($composedByBandId, $composedByProductionId) {
        $sql = "DELETE FROM composed_by WHERE composed_by_band_id = :composed_by_band_id AND composed_by_production_id=:composed_by_production_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':composed_by_band_id' => $composedByBandId,
          ':composed_by_production_id' => $composedByProductionId
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
