<?php
require('models/production.php');
class ProductionController {

    private $Production;
    private $productionId;

    function __construct() {
        $this->Production = new production();
        if(!empty($_GET['id'])) {
            $this->productionId = $_GET['id'];
        }
    }

    function getAllProductions() {
        $productions = $this->Production->getAllProductions();
        return $productions;
    }

    function countProductions() {
        $nb_prods = $this->Production->countProductions();
        return $nb_prods;
    }

    function getProduction() {
        return $this->Production->getProduction($this->productionId);
    }
}
