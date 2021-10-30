<?php

class ControllerComment
{

    public static function commentsList()
    {
        $rows = ModelComment::getCommentActionList();
        include_once 'viewAdmin/commentsActionList.php';
    }

    public static function addCommentForm()
    {
        include_once 'viewAdmin/commentsAddForm.php';
    }

    public static function addCommentResult()
    {
        $result = ModelComment::addComment();
        include_once 'viewAdmin/commentsAddForm.php';
    }

    public static function editCommentForm($id)
    {
        $newsList = ModelNews::getNewsActionList();
        $comment = ModelComment::getCommentDetail($id);
        $usersList = ModelUser::getUsersActionList();
        include_once 'viewAdmin/commentsEditForm.php';
    }

    public static function editCommentResult($id)
    {
        $result = ModelComment::editComment($id);
        include_once 'viewAdmin/commentsEditForm.php';
    }

    public static function deleteCommentForm($id)
    {
        $comment = ModelComment::getCommentDetail($id);
        include_once 'viewAdmin/commentsDeleteForm.php';
    }

    public static function deleteCommentResult($id)
    {
        $result = ModelComment::deleteComment($id);
        include_once 'viewAdmin/commentsDeleteForm.php';
    }
}