<?php
require('models/gig.php');
class GigController {

    private $Gig;
    private $params;

    function __construct($params = null) {
        $this->Gig = new gig();
        if($params != null) {
            $this->params = $params;
        }
    }

    function getAllGigs() {
        return $this->Gig->getAllGigs();
    }

    function getAllGigsSorted() {
        return $this->Gig->getAllGigsSorted();
    }

    function getGig() {
        return $this->Gig->getGig($this->params['gig_id']);
    }

    function getNextGigs() {
        return $this->Gig->getNextGigs($this->params['limit']);
    }
}
