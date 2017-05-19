<?php
require_once('../config/connexionBD.php');

class band {

    // ========= ATTRIBUTES ========= //
    var $band_id;            // integer
    var $band_name;          // text
    var $band_formed_in;      // integer
    // ============================= //


    // ==== Simple requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(band_id) FROM bands');
        return $maxId->fetch()[0];
    }

    public function getAllBands() {
        $req = myPDO()->prepare('   SELECT * FROM bands');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_CLASS, "band");
        $object = array_map('reset',$object);
        return $object;
    }

    public function countBands() {
        $req = myPDO()->prepare('SELECT band_id FROM bands');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getBand($bandId) {
        $req = myPDO()->prepare('   SELECT * FROM bands
                                    WHERE band_id = :band_id
                                ');
        $req->execute(array(':band_id' => $bandId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "band");
        return $object;
    }

    public function getBandsByName($bandName) {
        $req = myPDO()->prepare('   SELECT * FROM bands
                                    WHERE band_name = :band_name
                                ');
        $req->execute(array(':band_name' => $bandName));
        $object = $req->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_CLASS, "band");
        $object = array_map('reset',$object);
        return $object;
    }

    public function getBandsByFormedIn($bandFormedIn) {
        $req = myPDO()->prepare('   SELECT * FROM bands
                                    WHERE band_formed_in = :band_formed_in
                                ');
        $req->execute(array(':band_formed_in' => $bandFormedIn));
        $object = $req->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_CLASS, "band");
        $object = array_map('reset',$object);
        return $object;
    }

    public function getBandsByStyleId($bandStyleId) {
        $req = myPDO()->prepare('   SELECT * FROM bands
                                    WHERE band_style_id = :band_style_id
                                ');
        $req->execute(array(':band_style_id' => $bandStyleId));
        $object = $req->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_CLASS, "band");
        $object = array_map('reset',$object);
        return $object;
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertBand($bandName, $bandFormedIn, $bandStyleId) {
        $bandId = $this->getIdMax() + 1;
        $sql = "INSERT INTO bands VALUES (:band_id, :band_name, :band_formed_in, :band_style_id)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':band_id' => $bandId,
          ':band_name' => $bandName,
          ':band_formed_in' => $bandFormedIn,
          ':band_style_id' => $bandStyleId
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

    public function updateBand($bandId, $bandName, $bandFormedIn, $bandStyleId) {
        $sql = myPdo()->prepare("UPDATE bands SET band_name=:band_name, band_formed_in=:band_formed_in , band_style_id=:band_style_id WHERE band_id = :band_id");
        $params = [
          ':band_name' => $bandName,
          ':band_formed_in' => $bandFormedIn,
          ':band_style_id' => $bandStyleId,
          ':band_id' => $bandId
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

    public function deleteBand($bandId) {
        $sql = "DELETE FROM bands WHERE band_id = :band_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':band_id' => $bandId,
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
