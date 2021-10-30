<?php

class ControllerAdmin
{
    public static function adminPanel()
    {
        include_once('viewAdmin/dashboard.php');
    }

    public static function error404()
    {
        include_once('viewAdmin/error404.php');
    }
}//end class
?>
















