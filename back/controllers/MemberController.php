<?php
require('models/member.php');
class MemberController {

    private $Member;
    private $params;

    function __construct($params = null) {
        $this->Member = new member();
        if($params != null) {
            $this->params = $params;
        }
    }

    function getAllMembers() {
        $members = $this->Member->getAllMembers();
        return $members;
    }

    function getMember() {
        return $this->Member->getMember($this->params['member_id']);
    }
}
