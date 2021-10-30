<?php

class Controller
{
    public static function startSite()
    {
        include_once('view/homepage.php');
    }

    public static function error404()
    {
        include_once('view/error404.php');
    }

    public static function productByCategory($id)
    {
        $categories = Model::getCategoryList(); //список категорий
        $category = Model::getCategoryById($id);
        $productList = Model::getProductByCategory($id);

        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];

            $productArray = array_keys($productsInCart);
            $products = ModelCart::getProductsById_s($productArray);
            $totalSum = ModelCart::getTotalPrice($products);
        }

        include_once('view/productList.php');
    }

    public static function productById($id)
    {
        $categories = Model::getCategoryList();
        $product = Model::getProductById($id);
        $reviews = Model::getReviews();
        $users = Model::getUsers();
        include_once('view/productDetail.php');
    }

    public static function newsList()
    {
        $news = Model::getNewsList();
        include_once('view/news.php');
    }

    public static function newsById($id)
    {
        $news = Model::getNewsById($id);
        $comments = Model::getComments();
        include_once('view/newsDetail.php');
    }

    public static function loginForm()
    {
        include_once('view/loginForm.php');
    }

    public static function login()
    {
        $user = Model::login();
        if ($user == null) {
            header('Location: login');
        } else {
            header('Location: home');
        }
    }

    public static function logout()
    {
        Model::logout();
        header('Location: home');
    }

    public static function commentNews($id)
    {
        Model::sendComment($id);
        header('Location: newsDetail?id=' . $id);
    }

    public static function likeComment($id, $newsId)
    {
        Model::setLikeToNews($id);
        header('Location: newsDetail?id=' . $newsId);
    }

    public static function dislikeComment($id, $newsId)
    {
        Model::setDislikeToNews($id);
        header('Location: newsDetail?id=' . $newsId);
    }

    public static function removeLikeFromComment($id, $newsId)
    {
        Model::removeLikeToNews($id);
        header('Location: newsDetail?id=' . $newsId);
    }

    public static function removeDislikeFromComment($id, $newsId)
    {
        Model::removeDislikeToNews($id);
        header('Location: newsDetail?id=' . $newsId);
    }

    public static function editComment($id, $newsId)
    {
        Model::editComment($id);
        header('Location: newsDetail?id=' . $newsId);
    }

    public static function deleteComment($id, $newsId)
    {
        Model::deleteComment($id);
        header('Location: newsDetail?id=' . $newsId);
    }

    public static function registrationForm()
    {
        include_once('view/registrationForm.php');
    }

    public static function registrationResult()
    {
        Model::registration();
        header('Location: home');
    }

    public static function settingsForm()
    {
        include_once('view/settingsForm.php');
    }

    public static function profileEditResult()
    {
        $result = Model::changePassword();
        include_once 'view/settingsForm.php';
    }

    public static function profileEditDataResult()
    {
        $result = Model::changeData();
        include_once 'view/settingsForm.php';
    }

    public static function sortCommentsBy($id)
    {
        $news = Model::getNewsById($id);
        $comments = Model::sortCommentsBy();
        include_once 'view/newsDetail.php';
    }

    public static function rateProduct($id)
    {
        Model::rateProduct($id);
        header('Location: product?id=0');
    }

    public static function sendReview($id)
    {
        Model::sendReview($id);
        header('Location: productDetail?id=' . $id);
    }

    public static function editReview($id, $productId)
    {
        Model::editReview($id);
        header('Location: productDetail?id=' . $productId);
    }

    public static function sortReviewBy($productId)
    {
        $product = Model::getProductbyId($productId);
        $users = Model::getUsers();
        $reviews = Model::sortReviewBy();
        include_once 'view/productDetail.php';
    }

    public static function liveReview($id, $productId)
    {
        Model::setLikeToReview($id);
        header('Location: productDetail?id=' . $productId);
    }

    public static function removeLikeFromReview($id, $productId)
    {
        Model::removeLikeFromReview($id);
        header('Location: productDetail?id=' . $productId);
    }

    public static function dislikeReview($id, $productId)
    {
        Model::setDislikeToReview($id);
        header('Location: productDetail?id=' . $productId);
    }

    public static function removeDislikeFromReview($id, $productId)
    {
        Model::removeDislikeFromReview($id);
        header('Location: productDetail?id=' . $productId);
    }

    public static function deleteReview($id, $productId)
    {
        Model::deleteReview($id);
        header('Location: productDetail?id=' . $productId);
    }

    public static function sortProductsBy()
    {
        $productList =Model::sortProductsBy();
        $categories = Model::getCategoryList(); //список категорий

        include_once 'view/productList.php';
    }
}