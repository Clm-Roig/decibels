<?php
require_once('../config/connexionBD.php');

class production {

    // ========= ATTRIBUTES ========= //
    var $production_id;          // integer
    var $production_name;        // text
    var $production_date;        // text (date in DB)
    var $production_style_id;     // integer
    var $production_prod_type_id;     // integer
    // ============================= //


    // ==== Simple requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(production_id) FROM productions');
        return $maxId->fetch()[0];
    }

    public function getAllProductions() {
        $req = myPDO()->query('SELECT * FROM productions');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "production");

        return $object;
    }

    public function countProductions() {
        $req = myPDO()->query('SELECT production_id FROM productions');
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getProduction($productionId) {
        $req = myPDO()->prepare('SELECT * FROM productions WHERE production_id = :production_id');
        $req->execute(array(':production_id' => $productionId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "production");
        return $object;
    }

    public function getProductionsByName($productionName) {
        $req = myPDO()->prepare('SELECT * FROM productions WHERE production_name = :production_name');
        $req->execute(array(':production_name' => $productionName));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "production");
        return $object;
    }

    public function getProductionsByDate($productionDate) {
        $req = myPDO()->prepare('SELECT * FROM productions WHERE production_date = :production_date');
        $req->execute(array(':production_date' => $productionDate));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "production");
        return $object;
    }

    public function getProductionsByStyleId($productionStyleId) {
        $req = myPDO()->prepare('SELECT * FROM productions WHERE production_style_id = :production_style_id');
        $req->execute(array(':production_style_id' => $productionStyleId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "production");
        return $object;
    }
    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertProduction($productionName, $productionDate, $productionStyleId, $productionProdTypeId) {
        $productionId = $this->getIdMax() + 1;
        $sql = "INSERT INTO productions VALUES (:production_id, :production_name, :production_date, :production_style_id, :production_prod_type_id)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':production_id' => $productionId,
          ':production_name' => $productionName,
          ':production_date' => $productionDate,
          ':production_style_id' => $productionStyleId,
          ':production_prod_type_id' => $productionProdTypeId
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

    public function updateProduction($productionId, $productionName, $productionDate, $productionStyleId, $productionProdTypeId) {
        $sql = myPdo()->prepare("UPDATE productions SET production_name=:production_name, production_date=:production_date, production_style_id=:production_style_id, production_prod_type_id=:production_prod_type_id WHERE production_id = :production_id");
        $params = [
          ':production_name' => $productionName,
          ':production_date' => $productionDate,
          ':production_style_id' => $productionStyleId,
          ':production_prod_type_id' => $productionProdTypeId,
          ':production_id' => $productionId,
        ];
        try {
            $sql->execute($params);
            return true;
        }
        catch (Exception $e) {
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }

    public function deleteProduction($productionId) {
        $sql = "DELETE FROM productions WHERE production_id = :production_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':production_id' => $productionId,
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
