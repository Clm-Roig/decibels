<?php
include('config/connexionBD.php');

class Production {

    // ========= ATTRIBUTES ========= //
    private $productionId;          // integer
    private $productionName;        // text
    private $productionDate;        // text (date in DB)
    private $productionStyleId;     // integer
    private $productionProdTypeId;     // integer
    // ============================= //


    // ==== Misc requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(production_id) FROM productions');
        return $maxId->fetch()[0];
    }

    public function getAllProductions() {
        $req = myPDO()->prepare('SELECT * FROM productions');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Production");
        return json_encode($object);
    }

    public function countProductions() {
        $req = myPDO()->prepare('SELECT production_id FROM productions');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getProduction($productionId) {
        $req = myPDO()->prepare('SELECT * FROM productions WHERE production_id = :production_id');
        $req->execute(array(':production_id' => $productionId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Production");
        return json_encode($object);
    }

    public function getProductionsByName($productionName) {
        $req = myPDO()->prepare('SELECT * FROM productions WHERE production_name = :production_name');
        $req->execute(array(':production_name' => $productionName));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Production");
        return json_encode($object);
    }

    public function getProductionsByDate($productionDate) {
        $req = myPDO()->prepare('SELECT * FROM productions WHERE production_date = :production_date');
        $req->execute(array(':production_date' => $productionDate));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Production");
        return json_encode($object);
    }

    public function getProductionsByStyleId($productionStyleId) {
        $req = myPDO()->prepare('SELECT * FROM productions WHERE production_style_id = :production_style_id');
        $req->execute(array(':production_style_id' => $productionStyleId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Production");
        return json_encode($object);
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
            return false;
        }
    }
    // ====================================== //

}
