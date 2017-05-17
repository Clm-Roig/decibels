<?php
require('models/band.php');

class BandController {

    function getAllBands() {
        $bands = new band();
        $bands = $bands->getAllBands();
        return $bands;
    }

}
