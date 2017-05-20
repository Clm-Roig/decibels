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

    function getAllNewsSorted() {
        $req = myPDO()->prepare('SELECT * FROM news ORDER BY news_date DESC');
        $req->execute();
        $all_news_sorted = $req->fetchAll(PDO::FETCH_CLASS, "news");
        return $all_news_sorted;
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
