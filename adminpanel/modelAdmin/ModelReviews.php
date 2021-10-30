<?php

class ModelReviews
{

    public static function getReviewActionList()
    {
        $database = new Database();
        return $database->getAll("SELECT reviews.*, product.name, user.username FROM reviews, product, user WHERE reviews.product_id = product.id AND reviews.user_id = user.id ORDER BY reviews.id ASC");
    }

    public static function getReviewDetail($id)
    {
        $database = new Database();
        return $database->getOne("SELECT reviews.* FROM reviews WHERE reviews.id = $id");
    }

    public static function addReview()
    {
        $result = false;

        if (isset($_POST['save'])) {
            $text = $_POST['text'];
            $submit_date = date("Y-m-d H:i:s");
            $rating = $_POST['rating'];
            $productId = $_POST['productId'];
            $userId = $_POST['userId'];
            $likeCount = $_POST['likeCount'];
            $dislikeCount = $_POST['dislikeCount'];

            $database = new Database();
            $item = $database->executeRun("INSERT INTO reviews (id, text, submit_date, edit_date, rating, product_id, user_id, likeCount, dislikeCount) VALUES (NULL, '$text', '$submit_date', NULL, '$rating', '$productId', '$userId', '$likeCount', '$dislikeCount')");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function editReview($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $text = $_POST['text'];
            $edit_date = date("Y-m-d H:i:s");
            $rating = $_POST['rating'];
            $productId = $_POST['productId'];
            $userId = $_POST['userId'];
            $likeCount = $_POST['likeCount'];
            $dislikeCount = $_POST['dislikeCount'];

            $database = new Database();
            $item = $database->executeRun("UPDATE reviews SET text = '$text', edit_date = '$edit_date', rating = '$rating', product_id = '$productId', user_id = '$userId', likeCount = '$likeCount', dislikeCount = '$dislikeCount' WHERE reviews.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function deleteReview($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $database = new Database();
            $item = $database->executeRun("DELETE FROM reviews WHERE reviews.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }
}