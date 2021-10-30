<?php

session_start();
require_once '../inc/database.php';
include_once 'modelAdmin/ModelAdmin.php';
include_once 'controllerAdmin/ControllerAdmin.php';

include_once 'modelAdmin/ModelProduct.php';
include_once 'modelAdmin/ModelCategory.php';
include_once 'modelAdmin/ModelNews.php';
include_once 'modelAdmin/ModelUser.php';
include_once 'modelAdmin/ModelComment.php';
include_once 'modelAdmin/ModelReviews.php';

include_once 'controllerAdmin/ControllerProduct.php';
include_once 'controllerAdmin/ControllerCategory.php';
include_once 'controllerAdmin/ControllerNews.php';
include_once 'controllerAdmin/ControllerUser.php';
include_once 'controllerAdmin/ControllerComment.php';
include_once 'controllerAdmin/ControllerReviews.php';

include 'routeAdmin/routing.php';
?>
