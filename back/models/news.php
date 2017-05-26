<?php
require_once('../config/connexionBD.php');

class news {

    // ========= ATTRIBUTES ========= //
    var $news_id;        // integer
    var $news_date;      // text (date in DB)
    var $news_title;     // text
    var $news_text;      // text
    // ============================= //


    // ==== Simple requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(news_id) FROM news');
        return $maxId->fetch()[0];
    }

    public function getAllNews() {
        $req = myPDO()->query('SELECT * FROM news');
        $object = $req->fetchAll(PDO::FETCH_CLASS, "news");
        return $object;
    }

    public function getAllNewsSorted() {
        $req = myPDO()->prepare('SELECT * FROM news ORDER BY news_date DESC');
        $req->execute();
        $all_news_sorted = $req->fetchAll(PDO::FETCH_CLASS, "news");
        return $all_news_sorted;
    }

    public function countNews() {
        $req = myPDO()->query('SELECT news_id FROM news');
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getNews($newsId) {
        $req = myPDO()->prepare('SELECT * FROM news WHERE news_id = :news_id');
        $req->execute(array(':news_id' => $newsId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "news");
        return $object[0];
    }

    public function getNewsByDate($newsDate) {
        $req = myPDO()->prepare('SELECT * FROM news WHERE news_date = :news_date');
        $req->execute(array(':news_date' => $newsDate));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "news");
        return $object;
    }

    public function getNewsByTitle($newsTitle) {
        $req = myPDO()->prepare('SELECT * FROM news WHERE news_title = :news_title');
        $req->execute(array(':news_title' => $newsTitle));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "news");
        return $object;
    }

    public function getNewsText($newsText) {
        $req = myPDO()->prepare('SELECT * FROM news WHERE news_text = :news_text');
        $req->execute(array(':news_text' => $newsText));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "news");
        return $object;
    }
    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    // Une news a pour date le jour où elle est insérée
    public function insertNews($newsTitle, $newsText) {
        $newsId = $this->getIdMax() + 1;
        $sql = "INSERT INTO news VALUES (:news_id, NOW(), :news_title, :news_text)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':news_id' => $newsId,
          ':news_title' => $newsTitle,
          ':news_text' => $newsText
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }

    public function updateNews($newsId, $newsDate, $newsTitle, $newsText) {
        $sql = myPdo()->prepare("UPDATE news SET news_date=:news_date, news_title=:news_title , news_text=:news_text WHERE news_id = :news_id");
        $params = [
          ':news_date' => $newsDate,
          ':news_title' => $newsTitle,
          ':news_text' => $newsText,
          ':news_id' => $newsId
        ];
        try {
            $sql->execute($params);
            return true;
        }
        catch (Exception $e) {
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }

    public function deleteNews($newsId) {
        $sql = "DELETE FROM news WHERE news_id = :news_id";
        $req = myPdo()->prepare($sql);
        $params = [
          ':news_id' => $newsId,
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            // error during execute (bad request)
            http_response_code(400);
            return false;
        }
    }
    // ====================================== //

    // ==== Complex requests ==== //
    public function getLatestNews($limit) {
        $req = myPDO()->prepare('SELECT * FROM news ORDER BY news_date DESC LIMIT ?');
        $req->execute(array($limit));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "news");
        return $object;
    }
}
