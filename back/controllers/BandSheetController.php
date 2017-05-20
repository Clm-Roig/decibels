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
        $style = $this->Style->getStyle($band[0]->band_style_id);
        $listPlaysWith = $this->PlaysWith->getPlaysWithByBandId($this->params['band_id']);

        // Members
        $listMembers = array();
        foreach($listPlaysWith as $index => $playsWith) {
            $member = $this->Member->getMember($playsWith->plays_with_member_id)[0];
            $member->member_instrument = $playsWith->plays_with_instrument;
            array_push($listMembers,$member);
        }
        $members = array("members" => $listMembers);
        $band = array("band" => $band[0]);
        $style = array("style" => $style[0]);

        $result = array_merge($style,$band,$members);
        return $result;
    }
}
