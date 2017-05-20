<?php
require('models/band.php');
require('models/composedBy.php');
require('models/member.php');
require('models/playsWith.php');
require('models/production.php');
require('models/prodType.php');
require('models/style.php');

class BandSheetController {

    private $Band;
    private $ComposedBy;
    private $Member;
    private $PlaysWith;
    private $Production;
    private $ProdType;
    private $Style;

    private $params;

    function __construct($params = null) {
        $this->Band = new band();
        $this->ComposedBy = new composedBy();
        $this->Member = new member();
        $this->PlaysWith = new playsWith();
        $this->Production = new production();
        $this->ProdType = new prodType();
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

        $listComposedBy = $this->ComposedBy->getComposedByByBandId($this->params['band_id']);

        // Productions
        $listProds = array();
        foreach($listComposedBy as $index => $composedBy) {
            $production = $this->Production->getProduction($composedBy->composed_by_production_id)[0];
            $production->production_type_name = $this->ProdType->getProdType($production->production_prod_type_id)[0]->prod_type_name;
            array_push($listProds,$production);
        }


        // Preparing the result
        $band = array("band" => $band[0]);
        $members = array("members" => $listMembers);
        $productions = array("productions" => $listProds);
        $style = array("style" => $style[0]);

        $result = array_merge($band,$members,$productions,$style);
        return $result;
    }
}
