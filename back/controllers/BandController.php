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

    function deleteBand() {
        $this->Band->deleteBand($this->params['band_id']);
    }

    function insertBandTemp() {
        $this->Band->insertBandTemp($this->params['band_name'],$this->params['band_formed_in'],$this->params['band_style_name']);

    }

    function insertBand() {
        $this->Band->insertBand($this->params['band_name'],$this->params['band_formed_in'],$this->params['band_style_id']);
    }

}
