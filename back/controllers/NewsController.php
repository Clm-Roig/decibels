<?php
require('models/news.php');
class NewsController {

    private $News;
    private $newsId;

    function __construct() {
        $this->News = new news();
        if(!empty($_GET['id'])) {
            $this->newsId = $_GET['id'];
        }
    }

    function getAllNewss() {
        $newss = $this->News->getAllNewss();
        return $newss;
    }

    function getNews() {
        return $this->News->getNews($this->newsId);
    }
}
