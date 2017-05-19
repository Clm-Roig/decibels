<?php
require_once('../config/connexionBD.php');

class playsWith {

    // ========= ATTRIBUTES ========= //
    var $plays_with_member_id;     // integer
    var $plays_with_band_id;       // integer
    var $plays_with_instrument;   // integer
    // ============================= //


    // ==== Simple requests ==== //
    public function getAllPlaysWith() {
        $req = myPDO()->prepare('SELECT * FROM plays_with');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsWith");
        return $object;
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
        return $object;
    }

    public function getPlaysWithByGigId($playsWithBandId) {
        $req = myPDO()->prepare('SELECT * FROM plays_with WHERE plays_with_band_id = :plays_with_band_id');
        $req->execute(array(':plays_with_band_id' => $playsWithBandId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsWith");
        return $object;
    }

    public function getPlaysWithByInstrument($playsWithInstrument) {
        $req = myPDO()->prepare('SELECT * FROM plays_with WHERE plays_with_instrument = :plays_with_instrument');
        $req->execute(array(':plays_with_instrument' => $playsWithInstrument));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "playsWith");
        return $object;
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
