<?php
include('config/connexionBD.php');

class Gig {

    // ========= ATTRIBUTES ========= //
    private $gigId;         // integer
    private $gigPrice;      // float (numeric(6,2) in DB)
    private $gigPlace;      // text
    private $gigStyleId;    // integer
    // ============================= //


    // ==== Misc requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(gig_id) FROM gigs');
        return $maxId->fetch()[0];
    }

    public function getAllGigs() {
        $req = myPDO()->prepare('SELECT * FROM gigs');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Gig");
        return json_encode($object);
    }

    public function countGigs() {
        $req = myPDO()->prepare('SELECT gig_id FROM gigs');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getGig($gigId) {
        $req = myPDO()->prepare('SELECT * FROM gigs WHERE gig_id = :gig_id');
        $req->execute(array(':gig_id' => $gigId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Gig");
        return json_encode($object);
    }

    public function getGigsByPrice($gigPrice) {
        $req = myPDO()->prepare('SELECT * FROM gigs WHERE gig_price = :gig_price');
        $req->execute(array(':gig_price' => $gigPrice));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Gig");
        return json_encode($object);
    }

    public function getGigsByPlace($gigPlace) {
        $req = myPDO()->prepare('SELECT * FROM gigs WHERE gig_place = :gig_place');
        $req->execute(array(':gig_place' => $gigPlace));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Gig");
        return json_encode($object);
    }

    public function getGigsByStyleId($gigStyleId) {
        $req = myPDO()->prepare('SELECT * FROM gigs WHERE gig_style_id = :gig_style_id');
        $req->execute(array(':gig_style_id' => $gigStyleId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Gig");
        return json_encode($object);
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertGig($gigPrice, $gigPlace, $gigStyleId) {
        $gigId = $this->getIdMax() + 1;
        $sql = "INSERT INTO gigs VALUES (:gig_id, :gig_price, :gig_place, :gig_style_id)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':gig_id' => $gigId,
          ':gig_price' => $gigPrice,
          ':gig_place' => $gigPlace,
          ':gig_style_id' => $gigStyleId
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

    public function updateGig($gigId, $gigPrice, $gigPlace, $gigStyleId) {
        $sql = myPdo()->prepare("UPDATE gigs SET gig_name=:gig_name, gig_formed_in=:gig_formed_in , gig_style_id=:gig_style_id WHERE gig_id = :gig_id");
        $params = [
          ':gig_name' => $gigName,
          ':gig_formed_in' => $gigFormedIn,
          ':gig_style_id' => $gigStyleId,
          ':gig_id' => $gigId
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

    public function deleteGig($gigId) {
        $sql = "DELETE FROM gigs WHERE gig_id = :gig_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':gig_id' => $gigId,
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
