<?php
require('models/style.php');
class StyleController {

    private $Style;
    private $styleId;

    function __construct() {
        $this->Style = new style();
        if(!empty($_GET['id'])) {
            $this->styleId = $_GET['id'];
        }
    }

    function getAllStyles() {
        $styles = $this->Style->getAllStyles();
        return $styles;
    }

    function getStyle() {
        return $this->Style->getStyle($this->styleId);
    }
}
