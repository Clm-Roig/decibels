<?php
require('models/member.php');
class MemberController {

    private $Member;
    private $memberId;

    function __construct() {
        $this->Member = new member();
        if(!empty($_GET['id'])) {
            $this->memberId = $_GET['id'];
        }
    }

    function getAllMembers() {
        $members = $this->Member->getAllMembers();
        return $members;
    }

    function getMember() {
        return $this->Member->getMember($this->memberId);
    }
}
