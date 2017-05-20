<?php
require('models/band.php');
require('models/composedBy.php');
require('models/forms.php');
require('models/production.php');
require('models/prodType.php');
require('models/song.php');
require('models/style.php');

class ProductionSheetController {

    private $Band;
    private $ComposedBy;
    private $Forms;
    private $Production;
    private $ProdType;
    private $Style;

    private $params;

    function __construct($params = null) {
        $this->Band = new band();
        $this->ComposedBy = new composedBy();
        $this->Forms = new forms();
        $this->Production = new production();
        $this->ProdType = new prodType();
        $this->Style = new style();

        if($params != null) {
            $this->params = $params;
        }
    }

    // General information about de the production
    function getProductionInfos() {
        $req = myPDO()->prepare('   SELECT P.*, S.style_name, B.band_name FROM productions AS P, composed_by AS CB, styles AS S, bands AS B
                                    WHERE P.production_id = CB.composed_by_production_id
                                    AND P.production_style_id = S.style_id
                                    AND CB.composed_by_band_id = B.band_id
                                    AND P.production_id = :production_id
                                ;');
        $req->execute(array(':production_id' => $this->params['production_id']));
        $infosProd = $req->fetchAll(PDO::FETCH_ASSOC);
        return $infosProd[0];
    }

    // Songs of the Prod
    function getProductionSongs() {
        $req = myPDO()->prepare('   SELECT S.* FROM productions AS P, forms AS F, songs AS S
                                    WHERE P.production_id = F.forms_production_id
                                    AND F.forms_song_id = S.song_id
                                    AND P.production_id = :production_id
                                ;');
        $req->execute(array(':production_id' => $this->params['production_id']));
        $songs = $req->fetchAll(PDO::FETCH_ASSOC);
        return $songs;
    }

}
