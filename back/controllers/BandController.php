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
    // ======================= //

    function getAllBandsSorted() {
        $req = myPDO()->query('SELECT * FROM bands ORDER BY band_name');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "band");
        return $object;
    }

    function insertBandTemp() {
        var_dump($this->params);
        if($this->Band->insertBandTemp($this->params['band_name'],$this->params['band_formed_in'],$this->params['band_style_name'])) {
            http_response_code(200);
        }
        else {
            http_response_code(400);
        }

    }

}
