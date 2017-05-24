<?php
require('models/production.php');
require('models/composedBy.php');

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

    function insertProduction() {
        $return = $this->Production->insertProduction($this->params['production_name'], $this->params['production_date'], $this->params['production_style_id'], $this->params['production_prod_type_id']);
        $prod_id = $this->Production->getIdMax();
        $composedBy = new composedBy();
        $composedBy->insertComposedBy((int)$this->params['band_id'],$prod_id);
        return $return;
    }
}
