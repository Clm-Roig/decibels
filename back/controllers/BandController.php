<?php
require('models/band.php');
ini_set('display_errors',1);
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

    function getBand() {
        return $this->Band->getBand($this->bandId);
    }

}
