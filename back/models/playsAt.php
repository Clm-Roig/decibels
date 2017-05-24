<?php
require_once('../config/connexionBD.php');

class playsAt {

    // ========= ATTRIBUTES ========= //
    var $plays_at_band_id;     // integer
    var $plays_at_gig_id;      // integer
    // ============================= //


    // ==== Simple requests ==== //
    public function getAllPlaysAt() {
        $req = myPDO()->query('SELECT * FROM plays_at');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsAt");
        return $object;
    }

    public function countPlaysAt() {
        $req = myPDO()->query('SELECT plays_at_band_id FROM plays_at');
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getPlaysAtByBandId($playsAtBandId) {
        $req = myPDO()->prepare('SELECT * FROM plays_at WHERE plays_at_band_id = :plays_at_band_id');
        $req->execute(array(':plays_at_band_id' => $playsAtBandId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsAt");
        return $object;
    }

    public function getPlaysAtByGigId($playsAtGigId) {
        $req = myPDO()->prepare('SELECT * FROM plays_at WHERE plays_at_gig_id = :plays_at_gig_id');
        $req->execute(array(':plays_at_gig_id' => $playsAtGigId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsAt");
        return $object;
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertPlaysAt($playsAtBandId, $playsAtGigId) {
        $sql = "INSERT INTO plays_at VALUES (:plays_at_band_id, :plays_at_gig_id)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':plays_at_band_id' => $playsAtBandId,
          ':plays_at_gig_id' => $playsAtGigId
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

    public function deletePlaysAt($playsAtBandId, $playsAtGigId) {
        $sql = "DELETE FROM plays_at WHERE plays_at_band_id = :plays_at_band_id AND plays_at_gig_id=:plays_at_gig_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':plays_at_band_id' => $playsAtBandId,
          ':plays_at_gig_id' => $playsAtGigId
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
