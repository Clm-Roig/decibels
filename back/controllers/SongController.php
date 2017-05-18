<?php
require('models/song.php');
class SongController {

    private $Song;
    private $songId;

    function __construct() {
        $this->Song = new song();
        if(!empty($_GET['id'])) {
            $this->songId = $_GET['id'];
        }
    }

    function getAllSongs() {
        $songs = $this->Song->getAllSongs();
        return $songs;
    }

    function getSong() {
        return $this->Song->getSong($this->songId);
    }
}
