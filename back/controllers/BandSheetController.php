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
        $band = $this->Band->getBand($this->params['band_id'])[0];

        $style = $this->Style->getStyle($band->band_style_id);

        // TODO : Not working ? Null on member_id
        $listPlaysWith = $this->PlaysWith->getPlaysWithByBandId($this->params['band_id']);
        var_dump($listPlaysWith);

        $listMembers = [];

        foreach($listPlaysWith as $index => $memberIdInstr) {
            $member = $this->Member->getMember($memberIdInstr->plays_with_member_id);
            array_push($listMembers,$member);
        }

        //var_dump($listMembers);

        $style = (array) $style;
        $band = (array) $band;


        return $result;
    }
}
