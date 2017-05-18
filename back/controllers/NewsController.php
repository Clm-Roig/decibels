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

    function getAllNews() {
        $newss = $this->News->getAllNews();
        return $news;
    }

    function getNews() {
        return $this->News->getNews($this->newsId);
    }

    function getLatestNews($limit) {
        return $this->News->getLatestNews($limit);
    }
}
