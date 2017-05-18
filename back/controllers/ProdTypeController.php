<?php
require('models/prodType.php');
class ProdTypeController {

    private $ProdType;
    private $prodTypeId;

    function __construct() {
        $this->ProdType = new prodType();
        if(!empty($_GET['id'])) {
            $this->prodTypeId = $_GET['id'];
        }
    }

    function getAllProdTypes() {
        $prodTypes = $this->ProdType->getAllProdTypes();
        return $prodTypes;
    }

    function getProdType() {
        return $this->ProdType->getProdType($this->prodTypeId);
    }
}
