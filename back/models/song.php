<?php
include('../config/connexionBD.php');

class song {

    // ========= ATTRIBUTES ========= //
    private $songId;            // integer
    private $songName;          // text
    private $songTrackNumber;   // integer
    private $songLength;        // integer
    // ============================= //


    // ==== Misc requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(song_id) FROM songs');
        return $maxId->fetch()[0];
    }

    public function getAllSongs() {
        $req = myPDO()->prepare('SELECT * FROM songs');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Song");
        return json_encode($object);
    }

    public function countSongs() {
        $req = myPDO()->prepare('SELECT song_id FROM songs');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getSong($songId) {
        $req = myPDO()->prepare('SELECT * FROM songs WHERE song_id = :song_id');
        $req->execute(array(':song_id' => $songId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Song");
        return json_encode($object);
    }

    public function getSongsByName($songName) {
        $req = myPDO()->prepare('SELECT * FROM songs WHERE song_name = :song_name');
        $req->execute(array(':song_name' => $songName));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Song");
        return json_encode($object);
    }

    public function getSongsByTrackNumber($songTrackNumber) {
        $req = myPDO()->prepare('SELECT * FROM songs WHERE song_track_number = :song_track_number');
        $req->execute(array(':song_track_number' => $songTrackNumber));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Song");
        return json_encode($object);
    }

    public function getSongsByLength($songLength) {
        $req = myPDO()->prepare('SELECT * FROM songs WHERE song_length = :song_length');
        $req->execute(array(':song_length' => $songLength));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "Song");
        return json_encode($object);
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
            return false;
        }
    }
    // ====================================== //

}
