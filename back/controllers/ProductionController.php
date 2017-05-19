<?php
require('models/production.php');
class ProductionController {

    private $Production;
    private $params;

    function __construct($params = null) {
        $this->Production = new production();
        if($params != null) {
            $this->params = $params;
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
        return $this->Production->getProduction($this->params['production_id']);
    }
}
