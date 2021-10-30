<?php

class ControllerNews
{
    public static function newsList()
    {
        $rows = ModelNews::getNewsActionList();
        $users = ModelNews::getNewsUserId();
        include_once 'viewAdmin/newsActionList.php';
    }

    public static function addNewsForm()
    {
        $rowsNews = ModelNews::getNewsActionList();
        include_once 'viewAdmin/newsAddForm.php';
    }

    public static function addNewsResult()
    {
        $result = ModelNews::addNews();
        include_once 'viewAdmin/newsAddForm.php';
    }

    public static function editNewsForm($id)
    {
        $rowsNews = ModelNews::getNewsActionList();
        $item = ModelNews::getNewsDetail($id);
        include_once 'viewAdmin/newsEditForm.php';
    }

    public static function editNewsResult($id)
    {
        $result = ModelNews::editNews($id);
        include_once 'viewAdmin/newsEditForm.php';
    }

    public static function deleteNewsForm($id)
    {
        $rowsNews = ModelNews::getNewsActionList();
        $item = ModelNews::getNewsDetail($id);
        include_once 'viewAdmin/newsDeleteForm.php';
    }

    public static function deleteNewsResult($id)
    {
        $result = ModelNews::deleteNews($id);
        include_once 'viewAdmin/newsDeleteForm.php';
    }
}