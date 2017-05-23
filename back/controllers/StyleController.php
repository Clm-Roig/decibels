<?php
require('models/style.php');
class StyleController {

    private $Style;
    private $params;

    function __construct($params = null) {
        $this->Style = new style();
        if($params != null) {
            $this->params = $params;
        }
    }

    function getAllStyles() {
        return $this->Style->getAllStyles();
    }

    function getAllStylesSorted() {
        return $this->Style->getAllStylesSorted();
    }

    function getStyle() {
        return $this->Style->getStyle($this->params['style_id']);
    }

    function insertStyle() {
        return $this->Style->insertStyle($this->params['style_name']);
    }
}
