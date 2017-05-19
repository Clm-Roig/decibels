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
        $news = $this->News->getAllNews();
        return $news;
    }

    function countNews() {
        $nb_news = $this->News->countNews();
        return $nb_news;
    }

    function getNews() {
        return $this->News->getNews($this->newsId);
    }

    function getLatestNews($limit) {
        return $this->News->getLatestNews($limit);
    }
}
