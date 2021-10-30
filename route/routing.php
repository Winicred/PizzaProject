<?php
$host = explode('?', $_SERVER['REQUEST_URI'])[0];
$num = substr_count($host, '/');
$path = explode('/', $host)[$num];

if ($path == '' or $path == 'home' or $path == 'index') {
    Controller::startSite();
} elseif ($path == 'product' && isset($_GET['id'])) {
    Controller::productByCategory($_GET['id']);
} elseif ($path == 'productDetail' && isset($_GET['id'])) {
    Controller::productById($_GET['id']);
} elseif ($path == 'news') {
    Controller::newsList();
} elseif ($path == 'newsDetail' && isset($_GET['id'])) {
    Controller::newsById($_GET['id']);
} elseif ($path == 'cart' && isset($_GET['id'])) {
    ControllerCart::cartActionAdd($_GET['id']);
} elseif ($path == 'cartList') {
    ControllerCart::cartList();
} elseif ($path == 'cartProductDel' && isset($_GET['id'])) {
    ControllerCart::cartProductDelete($_GET['id']);
} elseif ($path == 'cartProductAdd' && isset($_GET['id'])) {
    ControllerCart::cartProductAdd($_GET['id']);
} elseif ($path == 'clearCart') {
    ControllerCart::cartClear();
} elseif ($path == 'sendOrder') {
    ControllerCart::orderSend();
} elseif ($path == 'login') {
    Controller::loginForm();
} elseif ($path == 'loginResult') {
    Controller::login();
} elseif ($path == 'logout') {
    Controller::logout();
} elseif ($path == 'commentNews' && isset($_GET['id'])) {
    Controller::commentNews($_GET['id']);
} elseif ($path == 'likeComment' && isset($_GET['id']) && isset($_GET['newsId'])) {
    Controller::likeComment($_GET['id'], $_GET['newsId']);
} elseif ($path == 'dislikeComment' && isset($_GET['id']) && isset($_GET['newsId'])) {
    Controller::dislikeComment($_GET['id'], $_GET['newsId']);
} elseif ($path == 'removeLikeFromComment' && isset($_GET['id']) && isset($_GET['newsId'])) {
    Controller::removeLikeFromComment($_GET['id'], $_GET['newsId']);
} elseif ($path == 'removeDislikeFromComment' && isset($_GET['id']) && isset($_GET['newsId'])) {
    Controller::removeDislikeFromComment($_GET['id'], $_GET['newsId']);
} elseif ($path == 'editComment' && isset($_GET['id']) && isset($_GET['newsId'])) {
    Controller::editComment($_GET['id'], $_GET['newsId']);
} elseif ($path == 'deleteComment' && isset($_GET['id']) && isset($_GET['newsId'])) {
    Controller::deleteComment($_GET['id'], $_GET['newsId']);
} elseif ($path == 'registration') {
    Controller::registrationForm();
} elseif ($path == 'registrationResult') {
    Controller::registrationResult();
} elseif ($path == 'settings') {
    Controller::settingsForm();
} elseif ($path == 'profileEditResult') {
    Controller::profileEditResult();
} elseif ($path == 'profileEditDataResult') {
    Controller::profileEditDataResult();
} elseif ($path == 'sortCommentsBy' && isset($_GET['id'])) {
    Controller::sortCommentsBy($_GET['id']);
} elseif($path == 'rateProduct' && isset($_GET['id'])) {
    Controller::rateProduct($_GET['id']);
}elseif($path == 'sendReview' && isset($_GET['id'])) {
    Controller::sendReview($_GET['id']);
}elseif($path == 'editReview' && isset($_GET['id']) && isset($_GET['productId'])) {
    Controller::editReview($_GET['id'], $_GET['productId']);
}elseif($path == 'deleteReview' && isset($_GET['id']) && isset($_GET['productId'])) {
    Controller::deleteReview($_GET['id'], $_GET['productId']);
}elseif($path == 'sortReviewsBy' && isset($_GET['id'])) {
    Controller::sortReviewBy($_GET['id']);
}elseif($path == 'likeReview' && isset($_GET['id']) && isset($_GET['productId'])) {
    Controller::liveReview($_GET['id'], $_GET['productId']);
}elseif($path == 'removeLikeFromReview' && isset($_GET['id']) && isset($_GET['productId'])) {
    Controller::removeLikeFromReview($_GET['id'], $_GET['productId']);
}elseif($path == 'dislikeReview' && isset($_GET['id']) && isset($_GET['productId'])) {
    Controller::dislikeReview($_GET['id'], $_GET['productId']);
}elseif($path == 'removeDislikeFromReview' && isset($_GET['id']) && isset($_GET['productId'])) {
    Controller::removeDislikeFromReview($_GET['id'], $_GET['productId']);
}elseif($path == 'sortProductsBy') {
    Controller::sortProductsBy();
} else {
    Controller::error404();
}
?>
