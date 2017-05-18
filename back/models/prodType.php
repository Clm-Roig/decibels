<?php
include('../config/connexionBD.php');

class prodType {

    // ========= ATTRIBUTES ========= //
    private $prodTypeId;        // integer
    private $prodTypeName;      // text
    // ============================= //


    // ==== Misc requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(prod_types_id) FROM prod_types');
        return $maxId->fetch()[0];
    }

    public function getAllProdTypes() {
        $req = myPDO()->prepare('SELECT * FROM prod_types');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "ProdType");
        return json_encode($object);
    }

    public function countProdTypes() {
        $req = myPDO()->prepare('SELECT prod_type_id FROM prod_types');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getProdType($prodTypeId) {
        $req = myPDO()->prepare('SELECT * FROM prod_type WHERE prod_type_id = :prod_type_id');
        $req->execute(array(':prod_type_id' => $prodTypeId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "ProdType");
        return json_encode($object);
    }

    public function getProdTypeByName($prodTypeName) {
        $req = myPDO()->prepare('SELECT * FROM prod_type WHERE prod_type_name = :prod_type_name');
        $req->execute(array(':prod_type_name' => $prodTypeName));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "ProdType");
        return json_encode($object);
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertProdType($prodTypeName) {
        $prodTypeId = $this->getIdMax() + 1;
        $sql = "INSERT INTO prod_type VALUES (:prod_type_id, :prod_type_name)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':prod_type_id' => $prodTypeId,
          ':prod_type_name' => $prodTypeName
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

    public function updateProdType($prodTypeId, $prodTypeName) {
        $sql = myPdo()->prepare("UPDATE prod_type SET prod_type_name=:prod_type_name WHERE prod_type_id = :prod_type_id");
        $params = [
          ':prod_type_name' => $prodTypeName,
          ':prod_type_id' => $prodTypeId
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

    public function deleteProdType($prodTypeId) {
        $sql = "DELETE FROM prod_type WHERE prod_type_id = :prod_type_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':prod_type_id' => $prodTypeId,
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
