<?php
require('models/band.php');
require('models/composedBy.php');
require('models/member.php');
require('models/playsWith.php');
require('models/style.php');

class BandSheetController {

    private $Band;
    private $ComposedBy;
    private $Member;
    private $PlaysWith;
    private $Style;

    private $params;

    function __construct($params = null) {
        $this->Band = new band();
        $this->ComposedBy = new composedBy();
        $this->Member = new member();
        $this->PlaysWith = new playsWith();
        $this->Style = new style();

        if($params != null) {
            $this->params = $params;
        }
    }

    function getBandSheet() {
        $band = $this->Band->getBand($this->params['band_id']);
        $band = $band[0];
        $style = $this->Style->getStyle($band->band_style_id);
        $style = $style[0];
        $style = (array) $style;
        $band = (array) $band;

        $object = array_merge($band,$style);
        return $object;
    }


}
