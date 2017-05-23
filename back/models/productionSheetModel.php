<?php
require_once('../config/connexionBD.php');

function getProductionInfos($production_id) {
    $req = myPDO()->prepare('   SELECT P.*, S.style_name, B.band_name FROM productions AS P, composed_by AS CB, styles AS S, bands AS B
                                WHERE P.production_id = CB.composed_by_production_id
                                AND P.production_style_id = S.style_id
                                AND CB.composed_by_band_id = B.band_id
                                AND P.production_id = :production_id
                            ;');
    $req->execute(array(':production_id' => $production_id));
    $infosProd = $req->fetchAll(PDO::FETCH_ASSOC);
    return $infosProd[0];
}

function getProductionSongs($production_id) {
    $req = myPDO()->prepare('   SELECT S.* FROM productions AS P, forms AS F, songs AS S
                                WHERE P.production_id = F.forms_production_id
                                AND F.forms_song_id = S.song_id
                                AND P.production_id = :production_id
                            ;');
    $req->execute(array(':production_id' => $production_id));
    $songs = $req->fetchAll(PDO::FETCH_ASSOC);
    return $songs;
}
