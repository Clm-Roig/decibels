<?php
require('models/band.php');

class bandController {

    function getAllBands() {
        $bands = new band();
        $bands = $bands->getAllBands();
        return $bands;
    }
    
}
