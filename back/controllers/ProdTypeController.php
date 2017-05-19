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
        $prodTypes = $this->ProdType->getAllProdTypes();
        return $prodTypes;
    }

    function getProdType() {
        return $this->ProdType->getProdType($this->params['prod_type_id']);
    }
}
