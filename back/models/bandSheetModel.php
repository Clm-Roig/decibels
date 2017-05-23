<?php
require_once('../config/connexionBD.php');

function getBandInfos($band_id) {
    $req = myPDO()->prepare('   SELECT B.*,S.style_name FROM bands AS B, styles AS S
                                WHERE B.band_style_id = S.style_id
                                AND B.band_id = :band_id
                            ;');
    $req->execute(array(':band_id' => $band_id));
    $infoBand = $req->fetchAll(PDO::FETCH_ASSOC);
    return $infoBand[0];
}

function getBandMembers($band_id) {
    $req = myPDO()->prepare('   SELECT M.*,PW.plays_with_instrument FROM members AS M, plays_with AS PW
                                WHERE M.member_id = PW.plays_with_member_id
                                AND PW.plays_with_band_id = :band_id
                                ORDER BY PW.plays_with_instrument
                            ;');
    $req->execute(array(':band_id' => $band_id));
    $listMembers = $req->fetchAll(PDO::FETCH_ASSOC);
    return $listMembers;
}

function getBandProductions($band_id) {
    $req = myPDO()->prepare('   SELECT P.*, PT.prod_type_name FROM productions AS P, composed_by AS CB, prod_types AS PT
                                WHERE CB.composed_by_production_id = P.production_id
                                AND P.production_prod_type_id = PT.prod_type_id
                                AND CB.composed_by_band_id = :band_id
                                ORDER BY P.production_date
                            ;');
    $req->execute(array(':band_id' => $band_id));
    $listProds = $req->fetchAll(PDO::FETCH_ASSOC);
    return $listProds;
}
