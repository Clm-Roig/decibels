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

    function getAllBands() {
        $bands = $this->Band->getAllBands();
        return $bands;
    }

    function countBands() {
        $nb_bands = $this->Band->countBands();
        return $nb_bands;
    }

    function getBand() {
        return $this->Band->getBand($this->params['band_id']);
    }

    function insertBand() {
        var_dump($this->params);
        if($this->Band->insertBand($this->params['band_name'],$this->params['band_formed_in'],$this->params['band_style_id'])) {
            return true;
        }
        else {
            return false;
        }

    }

}
