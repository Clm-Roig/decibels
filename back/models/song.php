<?php
require_once('../config/connexionBD.php');

class song {

    // ========= ATTRIBUTES ========= //
    var $song_id;            // integer
    var $song_name;          // text
    var $song_track_number;   // integer
    var $song_length;        // integer
    // ============================= //


    // ==== Simple requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(song_id) FROM songs');
        return $maxId->fetch()[0];
    }

    public function getAllSongs() {
        $req = myPDO()->query('SELECT * FROM songs');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "song");
        return $object;
    }

    public function countSongs() {
        $req = myPDO()->query('SELECT song_id FROM songs');
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getSong($songId) {
        $req = myPDO()->prepare('SELECT * FROM songs WHERE song_id = :song_id');
        $req->execute(array(':song_id' => $songId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "song");
        return $object;
    }

    public function getSongsByName($songName) {
        $req = myPDO()->prepare('SELECT * FROM songs WHERE song_name = :song_name');
        $req->execute(array(':song_name' => $songName));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "song");
        return $object;
    }

    public function getSongsByTrackNumber($songTrackNumber) {
        $req = myPDO()->prepare('SELECT * FROM songs WHERE song_track_number = :song_track_number');
        $req->execute(array(':song_track_number' => $songTrackNumber));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "song");
        return $object;
    }

    public function getSongsByLength($songLength) {
        $req = myPDO()->prepare('SELECT * FROM songs WHERE song_length = :song_length');
        $req->execute(array(':song_length' => $songLength));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "song");
        return $object;
    }
    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertSong($songName, $songTrackNumber, $songLength) {
        $songId = $this->getIdMax() + 1;
        $sql = "INSERT INTO songs VALUES (:song_id, :song_name, :song_track_number, :song_length)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':song_id' => $songId,
          ':song_name' => $songName,
          ':song_track_number' => $songTrackNumber,
          ':song_length' => $songLength
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }

    public function updateSong($songId, $songName, $songTrackNumber, $songLength) {
        $sql = myPdo()->prepare("UPDATE songs SET song_name=:song_name, song_track_number=:song_track_number , song_length=:song_length WHERE song_id = :song_id");
        $params = [
          ':song_name' => $songName,
          ':song_track_number' => $songName,
          ':song_length' => $songTrackNumber,
          ':song_id' => $songId
        ];
        try {
            $sql->execute($params);
            return true;
        }
        catch (Exception $e) {
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }

    public function deleteSong($songId) {
        $sql = "DELETE FROM songs WHERE song_id = :song_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':song_id' => $songId,
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }
    // ====================================== //

}
