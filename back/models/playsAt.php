<?php
require('../config/connexionBD.php');

class playsAt {

    // ========= ATTRIBUTES ========= //
    private $playsAtBandId;     // integer
    private $playsAtGigId;      // integer
    // ============================= //


    // ==== Simple requests ==== //
    public function getAllPlaysAt() {
        $req = myPDO()->prepare('SELECT * FROM plays_at');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsAt");
        return json_encode($object);
    }

    public function countPlaysAt() {
        $req = myPDO()->prepare('SELECT plays_at_band_id FROM plays_at');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getPlaysAtByBandId($playsAtBandId) {
        $req = myPDO()->prepare('SELECT * FROM plays_at WHERE plays_at_band_id = :plays_at_band_id');
        $req->execute(array(':plays_at_band_id' => $playsAtBandId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsAt");
        return json_encode($object);
    }

    public function getPlaysAtByGigId($playsAtGigId) {
        $req = myPDO()->prepare('SELECT * FROM plays_at WHERE plays_at_gig_id = :plays_at_gig_id');
        $req->execute(array(':plays_at_gig_id' => $playsAtGigId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsAt");
        return json_encode($object);
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertPlaysAt($playsAtBandId, $playsAtGigId) {
        $playsAtId = $this->getIdMax() + 1;
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
            return false;
        }
    }
    // ====================================== //

    // ==== Complex requests ==== //

}
