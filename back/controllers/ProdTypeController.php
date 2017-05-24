<?php
require('models/prodType.php');

class ProdTypeController {

    private $ProdType;
    private $params;

    function __construct($params = null) {
        $this->ProdType = new prodType();
        if($params != null) {
            $this->params = $params;
        }
    }

    function getAllProdTypes() {
        return $this->ProdType->getAllProdTypes();
    }

    function getAllProdTypesSorted() {
        return $this->ProdType->getAllProdTypesSorted();
    }

    function getProdType() {
        return $this->ProdType->getProdType($this->params['prod_type_id']);
    }
}
