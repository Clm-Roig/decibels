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
        return $this->News->getAllNews();
    }

    function getAllNewsSorted() {
        return $this->News->getAllNewsSorted();
    }

    function countNews() {
        return $this->News->countNews();;
    }

    function getNews() {
        return $this->News->getNews($this->params['news_id']);
    }

    function getLatestNews() {
        return $this->News->getLatestNews($this->params['limit']);
    }
}
