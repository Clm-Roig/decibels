<?php
require('models/news.php');
class NewsController {

    private $News;
    private $params;

    function __construct($params = null) {
        $this->News = new news();
        if($params != null) {
            $this->params = $params;
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
        return $this->News->getNews($this->params['news_id']);
    }

    function getLatestNews() {
        return $this->News->getLatestNews($this->params['limit']);
    }
}
