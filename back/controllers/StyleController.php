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
        $styles = $this->Style->getAllStyles();
        return $styles;
    }

    function getStyle() {
        return $this->Style->getStyle($this->params['style_id']);
    }
}
