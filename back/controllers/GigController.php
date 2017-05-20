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
        $req = myPDO()->prepare('SELECT * FROM gigs ORDER BY gig_date DESC');
        $req->execute();
        $all_gigs_sorted = $req->fetchAll(PDO::FETCH_CLASS, "gig");
        return $all_gigs_sorted;
    }

    function getGig() {
        return $this->Gig->getGig($this->params['gig_id']);
    }

    function getNextGigs() {
        return $this->Gig->getNextGigs($this->params['limit']);
    }
}
