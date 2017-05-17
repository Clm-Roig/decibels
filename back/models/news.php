<?php
include('config/connexionBD.php');

class news {

    // ========= ATTRIBUTES ========= //
    private $newsId;        // integer
    private $newsDate;      // text (date in DB)
    private $newsTitle;     // text
    private $newsText;      // text
    // ============================= //


    // ==== Misc requests ==== //

    public function getIdMax() {
        $maxId = myPDO()->query('SELECT MAX(news_id) FROM news');
        return $maxId->fetch()[0];
    }

    public function getAllNews() {
        $req = myPDO()->prepare('SELECT * FROM news');
        $req->execute();
        $object = $req->fetchAll(PDO::FETCH_CLASS, "News");
        return json_encode($object);
    }

    public function countNews() {
        $req = myPDO()->prepare('SELECT news_id FROM news');
        $req->execute();
        $count = $req->rowCount();
        return $count;
    }
    // ======================= //

    // ==== GET requests ==== //
    public function getNews($newsId) {
        $req = myPDO()->prepare('SELECT * FROM news WHERE news_id = :news_id');
        $req->execute(array(':news_id' => $newsId));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "News");
        return json_encode($object);
    }

    public function getNewsByDate($newsDate) {
        $req = myPDO()->prepare('SELECT * FROM news WHERE news_date = :news_date');
        $req->execute(array(':news_date' => $newsDate));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "News");
        return json_encode($object);
    }

    public function getNewsByTitle($newsTitle) {
        $req = myPDO()->prepare('SELECT * FROM news WHERE news_title = :news_title');
        $req->execute(array(':news_title' => $newsTitle));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "News");
        return json_encode($object);
    }

    public function getNewsText($newsText) {
        $req = myPDO()->prepare('SELECT * FROM news WHERE news_text = :news_text');
        $req->execute(array(':news_text' => $newsText));
        $object = $req->fetchAll(PDO::FETCH_CLASS, "News");
        return json_encode($object);
    }
    // ====================== //


    // ==== POST / PUT / DELETE requests ==== //

    public function insertNews($newsDate, $newsTitle, $newsText) {
        $newsId = $this->getIdMax() + 1;
        $sql = "INSERT INTO news VALUES (:news_id, :news_date, :news_title, :news_text)";
        $req = myPdo()->prepare($sql);
        $params = [
          ':news_id' => $newsId,
          ':news_date' => $newsDate,
          ':news_title' => $newsTitle,
          ':news_text' => $newsText
        ];
        try {
            $req->execute($params);
            return true;
        }
        catch (Exception $e) {
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
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
            echo 'Error request "'.$sql.'" : ';
            var_dump($e->getMessage());
            return false;
        }
    }
    // ====================================== //

}