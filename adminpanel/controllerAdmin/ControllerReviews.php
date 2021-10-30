<?php

class ControllerReviews
{
    public static function reviewList()
    {
        $rows = ModelReviews::getReviewActionList();
        include_once 'viewAdmin/reviewsActionList.php';
    }

    public static function addReviewForm()
    {
        $rowsReview = ModelReviews::getReviewActionList();
        $rowsProduct = ModelProduct::getProductActionList();
        $rowsUsers = ModelUser::getUsersActionList();
        include_once 'viewAdmin/reviewsAddForm.php';
    }

    public static function addReviewResult()
    {
        $result = ModelReviews::addReview();
        include_once 'viewAdmin/reviewsAddForm.php';
    }

    public static function editReviewForm($id)
    {
        $review = ModelReviews::getReviewDetail($id);
        $rowsProduct = ModelProduct::getProductActionList();
        $rowsUsers = ModelUser::getUsersActionList();
        include_once 'viewAdmin/reviewsEditForm.php';
    }

    public static function editReviewResult($id)
    {
        $result = ModelReviews::editReview($id);
        include_once 'viewAdmin/reviewsEditForm.php';
    }

    public static function deleteReviewForm($id)
    {
        $review = ModelReviews::getReviewDetail($id);
        $rowsProduct = ModelProduct::getProductActionList();
        $rowsUsers = ModelUser::getUsersActionList();
        include_once 'viewAdmin/reviewsDeleteForm.php';
    }

    public static function deleteReviewResult($id)
    {
        $result = ModelReviews::deleteReview($id);
        include_once 'viewAdmin/reviewsDeleteForm.php';
    }
}