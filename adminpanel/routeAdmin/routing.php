<?php
$host = explode('?', $_SERVER['REQUEST_URI'])[0];
$num = substr_count($host, '/');
$path = explode('/', $host)[$num];

if ($path == 'dashboard') {
    ControllerAdmin::adminPanel();
} elseif ($path == 'productAction') {
    ControllerProduct::productList();
} elseif ($path == 'addProduct') {
    ControllerProduct::addProductForm();
} elseif ($path == 'addProductResult') {
    ControllerProduct::addProductResult();
} elseif ($path == 'editProduct' && isset($_GET['id'])) {
    ControllerProduct::editProductForm($_GET['id']);
} elseif ($path == 'editProductResult' && isset($_GET['id'])) {
    ControllerProduct::editProductResult($_GET['id']);
} elseif ($path == 'deleteProduct' && isset($_GET['id'])) {
    ControllerProduct::deleteProductForm($_GET['id']);
} elseif ($path == 'deleteProductResult' && isset($_GET['id'])) {
    ControllerProduct::deleteProductResult($_GET['id']);
} elseif ($path == 'categoryAction') {
    ControllerCategory::categoryList();
} elseif ($path == 'addCategory') {
    ControllerCategory::addCategoryForm();
} elseif ($path == 'addCategoryResult') {
    ControllerCategory::addCategoryResult();
} elseif ($path == 'editCategory' && isset($_GET['id'])) {
    ControllerCategory::editCategoryForm($_GET['id']);
} elseif ($path == 'editCategoryResult' && isset($_GET['id'])) {
    ControllerCategory::editCategoryResult($_GET['id']);
} elseif ($path == 'deleteCategory' && isset($_GET['id'])) {
    ControllerCategory::deleteCategoryForm($_GET['id']);
} elseif ($path == 'deleteCategoryResult' && isset($_GET['id'])) {
    ControllerCategory::deleteCategoryResult($_GET['id']);
} elseif ($path == 'newsAction') {
    ControllerNews::newsList();
} elseif ($path == 'addNews') {
    ControllerNews::addNewsForm();
} elseif ($path == 'addNewsResult') {
    ControllerNews::addNewsResult();
} elseif ($path == 'editNews' && isset($_GET['id'])) {
    ControllerNews::editNewsForm($_GET['id']);
} elseif ($path == 'editNewsResult' && isset($_GET['id'])) {
    ControllerNews::editNewsResult($_GET['id']);
} elseif ($path == 'deleteNews' && isset($_GET['id'])) {
    ControllerNews::deleteNewsForm($_GET['id']);
} elseif ($path == 'deleteNewsResult' && isset($_GET['id'])) {
    ControllerNews::deleteNewsResult($_GET['id']);
} elseif ($path == 'usersAction') {
    ControllerUser::usersList();
} elseif ($path == 'addUser') {
    ControllerUser::addUserForm();
} elseif ($path == 'addUserResult') {
    ControllerUser::addUserResult();
} elseif ($path == 'editUser' && isset($_GET['id'])) {
    ControllerUser::editUserForm($_GET['id']);
} elseif ($path == 'editUserResult' && isset($_GET['id'])) {
    ControllerUser::editUserResult($_GET['id']);
} elseif ($path == 'deleteUser' && isset($_GET['id'])) {
    ControllerUser::deleteUserForm($_GET['id']);
} elseif ($path == 'deleteUserResult' && isset($_GET['id'])) {
    ControllerUser::deleteUserResult($_GET['id']);
} elseif ($path == 'commentsAction') {
    ControllerComment::commentsList();
} elseif ($path == 'addComment') {
    ControllerComment::addCommentForm();
} elseif ($path == 'addCommentResult') {
    ControllerComment::addCommentResult();
} elseif ($path == 'editComment' && isset($_GET['id'])) {
    ControllerComment::editCommentForm($_GET['id']);
} elseif ($path == 'editCommentResult' && isset($_GET['id'])) {
    ControllerComment::editCommentResult($_GET['id']);
} elseif ($path == 'deleteComment' && isset($_GET['id'])) {
    ControllerComment::deleteCommentForm($_GET['id']);
} elseif ($path == 'deleteCommentResult' && isset($_GET['id'])) {
    ControllerComment::deleteCommentResult($_GET['id']);
} elseif ($path == 'reviewsAction') {
    ControllerReviews::reviewList();
} elseif ($path == 'addReview') {
    ControllerReviews::addReviewForm();
} elseif ($path == 'addReviewResult') {
    ControllerReviews::addReviewResult();
} elseif ($path == 'editReview' && isset($_GET['id'])) {
    ControllerReviews::editReviewForm($_GET['id']);
} elseif ($path == 'editReviewResult' && isset($_GET['id'])) {
    ControllerReviews::editReviewResult($_GET['id']);
} elseif ($path == 'deleteReview' && isset($_GET['id'])) {
    ControllerReviews::deleteReviewForm($_GET['id']);
} elseif ($path == 'deleteReviewResult' && isset($_GET['id'])) {
    ControllerReviews::deleteReviewResult($_GET['id']);
} else {
    ControllerAdmin::error404();
}




























