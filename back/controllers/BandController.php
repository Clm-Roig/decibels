<?php
require('models/band.php');
class BandController {

    private $Band;
    private $bandId;

    function __construct() {
        $this->Band = new band();
        if(!empty($_GET['id'])) {
            $this->bandId = $_GET['id'];
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
        return $this->Band->getBand($this->bandId);
    }

}
