<?php

class ModelComment
{
    public static function getCommentActionList()
    {
        $database = new Database();
        return $database->getAll("SELECT user.username, comments.*, news.title FROM comments, user, news WHERE comments.userId = user.id AND comments.newsId = news.id ORDER BY comments.id ASC");
    }

    public static function addComment()
    {
        $result = false;

        if (isset($_POST['save'])) {
            $text = $_POST['text'];
            $submit_date = date("Y-m-d H:i:s");
            $newsId = $_POST['newsId'];
            $userId = $_POST['userId'];
            $likeCount = $_POST['likeCount'];
            $dislikeCount = $_POST['dislikeCount'];

            $database = new Database();
            $item = $database->executeRun("INSERT INTO comments (id, text, submit_date, newsId, userId, likeCount, dislikeCount) VALUES (NULL, '$text', '$submit_date', '$newsId', '$userId', '$likeCount', '$dislikeCount')");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function getCommentDetail($id)
    {
        $database = new Database();
        return $database->getOne("SELECT user.*, comments.* FROM comments, user WHERE comments.id = $id");
    }

    public static function editComment($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $text = $_POST['text'];
            $edit_date = date("Y-m-d H:i:s");
            $newsId = $_POST['newsId'];
            $userId = $_POST['userId'];
            $likeCount = $_POST['likeCount'];
            $dislikeCount = $_POST['dislikeCount'];

            $database = new Database();
            $item = $database->executeRun("UPDATE comments SET text = '$text', edit_date = '$edit_date', newsId = '$newsId', userId = '$userId', likeCount = '$likeCount', dislikeCount = '$dislikeCount' WHERE comments.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function deleteComment($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $database = new Database();
            $item = $database->executeRun("DELETE FROM comments WHERE comments.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }
}