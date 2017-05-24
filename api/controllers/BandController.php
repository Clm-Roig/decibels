<?php
require('models/band.php');
class BandController {

    private $Band;
    private $params;

    function __construct($params = null) {
        $this->Band = new band();
        if($params != null) {
            $this->params = $params;
        }
    }

    // ==== Simple requests ==== //
    function getAllBands() {
        return $this->Band->getAllBands();
    }

    function countBands() {
        return $this->Band->countBands();
    }

    function getBand() {
        return $this->Band->getBand($this->params['band_id']);
    }
    // ======================= //

    function getAllBandsSorted() {
        return $this->Band->getAllBandsSorted($this->params['limit'],$this->params['offset']);
    }

    function insertBandTemp() {
        if($this->Band->insertBandTemp($this->params['band_name'],$this->params['band_formed_in'],$this->params['band_style_name'])) {
            http_response_code(200);
        }
        else {
            // Bad request
            http_response_code(400);
        }
    }

    function insertBand() {
        if($this->Band->insertBand($this->params['band_name'],$this->params['band_formed_in'],$this->params['band_style_id'])) {
            http_response_code(200);
        }
        else {
            // Bad request
            http_response_code(400);
        }
    }

}
