<?php
require_once('models/productionSheetModel.php');

class ProductionSheetController {

    private $params;

    function __construct($params = null) {
        if($params != null) {
            $this->params = $params;
        }
    }

    function getProductionInfos() {
        return getProductionInfos($this->params['production_id']);
    }

    function getProductionSongs() {
        return getProductionSongs($this->params['production_id']);
    }
}
