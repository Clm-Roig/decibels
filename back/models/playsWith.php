<?php
require('../config/connexionBD.php');

class playsWith {

    // ========= ATTRIBUTES ========= //
    private $playsWithMemberId;     // integer
    private $playsWithBandId;       // integer
    private $playsWithInstrument;   // integer
    // ============================= //


    // ==== Simple requests ==== //
    public function getAllPlaysWith() {
        $req = myPDO()->prepare('SELECT * FROM plays_with');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsWith");
        return json_encode($object);
    }

    public function countPlaysWith() {
        $req = myPDO()->prepare('SELECT plays_with_member_id FROM plays_with');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getPlaysWithByMemberId($playsWithMemberId) {
        $req = myPDO()->prepare('SELECT * FROM plays_with WHERE plays_with_member_id = :plays_with_member_id');
        $req->execute(array(':plays_with_member_id' => $playsWithMemberId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsWith");
        return json_encode($object);
    }

    public function getPlaysWithByGigId($playsWithBandId) {
        $req = myPDO()->prepare('SELECT * FROM plays_with WHERE plays_with_band_id = :plays_with_band_id');
        $req->execute(array(':plays_with_band_id' => $playsWithBandId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsWith");
        return json_encode($object);
    }

    public function getPlaysWithByInstrument($playsWithInstrument) {
        $req = myPDO()->prepare('SELECT * FROM plays_with WHERE plays_with_instrument = :plays_with_instrument');
        $req->execute(array(':plays_with_instrument' => $playsWithInstrument));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsWith");
        return json_encode($object);
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertPlaysWith($playsWithMemberId, $playsWithBandId, $playsWithInstrument) {
        $playsWithId = $this->getIdMax() + 1;
        $sql = "INSERT INTO plays_with VALUES (:plays_with_member_id, :plays_with_band_id, :plays_with_instrument)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':plays_with_member_id' => $playsWithMemberId,
          ':plays_with_band_id' => $playsWithBandId,
          ':plays_with_instrument' => $playsWithInstrument
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

    public function deletePlaysWith($playsWithMemberId, $playsWithBandId) {
        $sql = "DELETE FROM plays_with WHERE plays_with_member_id = :plays_with_member_id AND plays_with_band_id = :plays_with_band_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':plays_with_member_id' => $playsWithMemberId,
          ':plays_with_band_id' => $playsWithBandId
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
