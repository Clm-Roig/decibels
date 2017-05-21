<?php
require_once('../config/connexionBD.php');
class BandSheetController {

    private $params;

    function __construct($params = null) {
        if($params != null) {
            $this->params = $params;
        }
    }

    // General information about de the band
    function getBandInfos() {
        $req = myPDO()->prepare('   SELECT B.*,S.style_name FROM bands AS B, styles AS S
                                    WHERE B.band_style_id = S.style_id
                                    AND B.band_id = :band_id
                                ;');
        $req->execute(array(':band_id' => $this->params['band_id']));
        $infoBand = $req->fetchAll(PDO::FETCH_ASSOC);
        return $infoBand[0];
    }

    // Members of the band
    function getBandMembers() {
        $req = myPDO()->prepare('   SELECT M.*,PW.plays_with_instrument FROM members AS M, plays_with AS PW
                                    WHERE M.member_id = PW.plays_with_member_id
                                    AND PW.plays_with_band_id = :band_id
                                    ORDER BY PW.plays_with_instrument
                                ;');
        $req->execute(array(':band_id' => $this->params['band_id']));
        $listMembers = $req->fetchAll(PDO::FETCH_ASSOC);
        return $listMembers;
    }

    // Productions of the band
    function getBandProductions() {
        $req = myPDO()->prepare('   SELECT P.*, PT.prod_type_name FROM productions AS P, composed_by AS CB, prod_types AS PT
                                    WHERE CB.composed_by_production_id = P.production_id
                                    AND P.production_prod_type_id = PT.prod_type_id
                                    AND CB.composed_by_band_id = :band_id
                                    ORDER BY P.production_date
                                ;');
        $req->execute(array(':band_id' => $this->params['band_id']));
        $listProds = $req->fetchAll(PDO::FETCH_ASSOC);
        return $listProds;
    }
}
