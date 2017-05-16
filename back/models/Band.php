<?php
// Classe d'accès à la BD
include('config/connexionBD.php');

class Band {

    // ========= ATTRIBUTES ========= //
    private $bandId;        //integer
    private $bandName;      // text
    private $bandFormedIn;  // integer
    private $bandStyle;     // integer
    // ============================= //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(band_id) FROM bands');
        return $maxId->fetch()[0];
    }

    public function getBands() {
        $req = myPDO()->prepare('SELECT * FROM bands');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Band");
        return json_encode($object);
    }



    public function countBands() {
        $req = myPDO()->prepare('SELECT band_id FROM bands');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }

    public function getBand($bandId) {
        $req = myPDO()->prepare('SELECT * FROM bands WHERE band_id = :band_id');
        $req->execute(array(':band_id' => $bandId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Band");
        return json_encode($object);
    }

    // Pas besoin de passer l'ID, il est calculé à l'intérieur
    public function insertBand($bandName, $bandFormedIn, $bandStyleId) {
        $bandId = $this->getIdMax() + 1;
        $sql = "INSERT INTO bands VALUES (:band_id, :band_name, :band_formed_in, :band_style_id)";
        $req = myPdo()->prepare($sql);
        $params = [
          'band_id' => $bandId,
          'band_name' => $bandName,
          'band_formed_in' => $bandFormedIn,
          'band_style_id' => $bandStyleId
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


}
