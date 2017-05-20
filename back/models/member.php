<?php
require_once('../config/connexionBD.php');

class member {

    // ========= ATTRIBUTES ========= //
    var $member_id;          // integer
    var $member_first_name;   // text
    var $member_last_name;    // text
    var $member_pseudo;      // text
    // ============================= //


    // ==== Simple requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(member_id) FROM members');
        return $maxId->fetch()[0];
    }

    public function getAllMembers() {
        $req = myPDO()->prepare('SELECT * FROM members');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "member");
        return $object;
    }

    public function countMembers() {
        $req = myPDO()->prepare('SELECT member_id FROM members');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getMember($memberId) {
        $req = myPDO()->prepare('SELECT * FROM members WHERE member_id = :member_id');
        $req->execute(array(':member_id' => $memberId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "member");
        return $object;
    }

    public function getMembersByFirstName($memberFirstName) {
        $req = myPDO()->prepare('SELECT * FROM members WHERE member_first_name = :member_first_name');
        $req->execute(array(':member_first_name' => $memberFirstName));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "member");
        return $object;
    }

    public function getMembersByLastName($memberLastName) {
        $req = myPDO()->prepare('SELECT * FROM members WHERE member_last_name = :member_last_name');
        $req->execute(array(':member_last_name' => $memberLastName));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "member");
        return $object;
    }

    public function getMembersByPseudo($memberPseudo) {
        $req = myPDO()->prepare('SELECT * FROM members WHERE member_pseudo = :member_pseudo');
        $req->execute(array(':member_pseudo' => $memberPseudo));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "member");
        return $object;
    }
    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertMember($memberFirstName, $memberLastName, $memberPseudo) {
        $memberId = $this->getIdMax() + 1;
        $sql = "INSERT INTO members VALUES (:member_id, :member_first_name, :member_last_name, :member_pseudo)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':member_id' => $memberId,
          ':member_first_name' => $memberFirstName,
          ':member_last_name' => $memberLastName,
          ':member_pseudo' => $memberPseudo
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

    public function updateMember($memberId, $memberFirstName, $memberLastName, $memberPseudo) {
        $sql = myPdo()->prepare("UPDATE members SET member_first_name=:member_first_name, member_last_name=:member_last_name , member_pseudo=:member_pseudo WHERE member_id = :member_id");
        $params = [
          ':member_first_name' => $memberFirstName,
          ':member_last_name' => $memberLastName,
          ':member_pseudo' => $memberPseudo,
          ':member_id' => $memberId
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

    public function deleteMember($memberId) {
        $sql = "DELETE FROM members WHERE member_id = :member_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':member_id' => $memberId,
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
