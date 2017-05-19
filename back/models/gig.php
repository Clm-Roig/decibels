<?php
require_once('../config/connexionBD.php');

class gig {

    // ========= ATTRIBUTES ========= //
    var $gig_id;         // integer
    var $gig_price;      // float (numeric(6,2) in DB)
    var $gig_place;      // text
    var $gig_date;       // date
    var $gig_style_id;    // integer
    // ============================= //


    // ==== Simple requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(gig_id) FROM gigs');
        return $maxId->fetch()[0];
    }

    public function getAllGigs() {
        $req = myPDO()->prepare('SELECT * FROM gigs');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "gig");
        return $object;
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
        $object = $req->fetchAll(PDO::FETCH_CLASS, "gig");
        return $object;
    }

    public function getGigsByPrice($gigPrice) {
        $req = myPDO()->prepare('SELECT * FROM gigs WHERE gig_price = :gig_price');
        $req->execute(array(':gig_price' => $gigPrice));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "gig");
        return $object;
    }

    public function getGigsByPlace($gigPlace) {
        $req = myPDO()->prepare('SELECT * FROM gigs WHERE gig_place = :gig_place');
        $req->execute(array(':gig_place' => $gigPlace));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "gig");
        return $object;
    }

    public function getGigsByDate($gigDate) {
        $req = myPDO()->prepare('SELECT * FROM gigs WHERE gig_date = :gig_date');
        $req->execute(array(':gig_date' => $gigDate));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "gig");
        return $object;
    }

    public function getGigsByStyleId($gigStyleId) {
        $req = myPDO()->prepare('SELECT * FROM gigs WHERE gig_style_id = :gig_style_id');
        $req->execute(array(':gig_style_id' => $gigStyleId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "gig");
        return $object;
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertGig($gigPrice, $gigPlace, $gigDate, $gigStyleId) {
        $gigId = $this->getIdMax() + 1;
        $sql = "INSERT INTO gigs VALUES (:gig_id, :gig_price, :gig_place, :gig_date, :gig_style_id)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':gig_id' => $gigId,
          ':gig_price' => $gigPrice,
          ':gig_place' => $gigPlace,
          ':gig_date' => $gigDate,
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

    public function updateGig($gigId, $gigPrice, $gigPlace, $gigDate, $gigStyleId) {
        $sql = myPdo()->prepare("UPDATE gigs SET gig_price=:gig_price, gig_place=:gig_place, gig_date=:gig_date, gig_style_id=:gig_style_id WHERE gig_id = :gig_id");
        $params = [
          ':gig_price' => $gigPrice,
          ':gig_place' => $gigPlace,
          ':gig_date' => $gigDate,
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

    // ==== Complex requests ==== //
    public function getNextGigs($limit) {
        $req = myPDO()->prepare('SELECT * FROM gigs WHERE gig_date >= NOW() ORDER BY gig_date DESC LIMIT ?');
        $req->execute(array($limit));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "gig");
        return $object;
    }

}
