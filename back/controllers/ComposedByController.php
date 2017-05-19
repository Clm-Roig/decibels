<?php
require('models/composedBy.php');
class ComposedByController {

    private $ComposedBy;
    private $composedByBandId;
    private $composedByProductionId;

    function __construct() {
        $this->ComposedBy = new composedBy();
        if(!empty($_GET['id'])) {
            $this->composedById = $_GET['id'];
        }
    }

    function getAllComposedBy() {
        $listComposed = $this->ComposedBy->getAllComposedBy();
        return $listComposed;
    }

    function countComposedBys() {
        $composed_by = $this->ComposedBy->countComposedBy();
        return $composed_by;
    }

    function getComposedByBandId() {
        return $this->ComposedBy->getComposedBy($this->$composedByBandId);
    }

    function getComposedByByProductionId() {
        return $this->ComposedBy->getComposedBy($this->$composedByProductionId);
    }
}
