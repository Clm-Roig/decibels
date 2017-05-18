<?php
require('models/gig.php');
class GigController {

    private $Gig;
    private $gigId;

    function __construct() {
        $this->Gig = new gig();
        if(!empty($_GET['id'])) {
            $this->gigId = $_GET['id'];
        }
    }

    function getAllGigs() {
        return $this->Gig->getAllGigs();
    }

    function getGig() {
        return $this->Gig->getGig($this->gigId);
    }

    function getNextGigs($limit) {
        return $this->Gig->getNextGigs($limit);
    }
}
