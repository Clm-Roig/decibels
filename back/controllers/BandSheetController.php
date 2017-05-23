<?php
require_once('models/bandSheetModels.php');

class BandSheetController {

    private $params;

    function __construct($params = null) {
        if($params != null) {
            $this->params = $params;
        }
    }

    function getBandInfos() {
        return getBandInfos($this->params['band_id']);
    }

    function getBandMembers() {
        return getBandMembers($this->params['band_id']);
    }

    function getBandProductions() {
        return getBandProductions($this->params['band_id']);
    }

}
