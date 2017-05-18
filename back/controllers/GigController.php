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
        $gigs = $this->Gig->getAllGigs();
        return $gigs;
    }

    function getGig() {
        return $this->Gig->getGig($this->gigId);
    }
}
