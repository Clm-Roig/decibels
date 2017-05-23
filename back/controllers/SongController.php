<?php
require('models/song.php');
class SongController {

    private $Song;
    private $params;

    function __construct($params = null) {
        $this->Song = new song();
        if($params != null) {
            $this->params = $params;
        }
    }

    function getAllSongs() {
        return $this->Song->getAllSongs();
    }

    function getSong() {
        return $this->Song->getSong($this->params['song_id']);
    }
}
