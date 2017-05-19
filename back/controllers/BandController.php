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

}
