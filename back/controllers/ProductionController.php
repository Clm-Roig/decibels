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

    function getProduction() {
        return $this->Production->getProduction($this->productionId);
    }
}
