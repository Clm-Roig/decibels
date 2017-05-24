<?php
require_once('../config/connexionBD.php');

class prodType {

    // ========= ATTRIBUTES ========= //
    var $prod_type_id;        // integer
    var $prod_type_name;      // text
    // ============================= //


    // ==== Simple requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(prod_types_id) FROM prod_types');
        return $maxId->fetch()[0];
    }

    public function getAllProdTypes() {
        $req = myPDO()->query('SELECT * FROM prod_types');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "prodType");
        return $object;
    }

    public function getAllProdTypesSorted() {
        $req = myPDO()->query('SELECT * FROM prod_types ORDER BY prod_type_name');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "prodType");
        return $object;
    }

    public function countProdTypes() {
        $req = myPDO()->query('SELECT prod_type_id FROM prod_types');
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getProdType($prodTypeId) {
        $req = myPDO()->prepare('SELECT * FROM prod_types WHERE prod_type_id = :prod_type_id');
        $req->execute(array(':prod_type_id' => $prodTypeId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "prodType");
        return $object;
    }

    public function getProdTypeByName($prodTypeName) {
        $req = myPDO()->prepare('SELECT * FROM prod_types WHERE prod_type_name = :prod_type_name');
        $req->execute(array(':prod_type_name' => $prodTypeName));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "prodType");
        return $object;
    }

    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertProdType($prodTypeName) {
        $prodTypeId = $this->getIdMax() + 1;
        $sql = "INSERT INTO prod_types VALUES (:prod_type_id, :prod_type_name)";
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
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }

    public function updateProdType($prodTypeId, $prodTypeName) {
        $sql = myPdo()->prepare("UPDATE prod_types SET prod_type_name=:prod_type_name WHERE prod_type_id = :prod_type_id");
        $params = [
          ':prod_type_name' => $prodTypeName,
          ':prod_type_id' => $prodTypeId
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

    public function deleteProdType($prodTypeId) {
        $sql = "DELETE FROM prod_types WHERE prod_type_id = :prod_type_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':prod_type_id' => $prodTypeId,
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
