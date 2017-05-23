<?php
require('models/composedBy.php');

class ComposedByController {

    private $ComposedBy;
    private $params;

    function __construct($params = null) {
        $this->ComposedBy = new composedBy();
        if($params != null) {
            $this->params = $params;
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
        return $this->ComposedBy->getComposedBy($this->$params['band_id']);
    }

    function getComposedByProductionId() {
        return $this->ComposedBy->getComposedBy($this->$params['production_id']);
    }
}
