<?php

class ControllerCart
{
    public static function cartActionAdd($id)
    {
        ModelCart::getCartAdd($id);
        $categories = Model::getCategoryList();

        $product = Model::getProductById($id);
        header('Location: product?id=0');
    }

    public static function cartList()
    {
        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];

            $productArray = array_keys($productsInCart);
            $productList = ModelCart::getProductsById_s($productArray);
            $totalSum = ModelCart::getTotalPrice($productList);
        }
        include_once 'view/cartList.php';
    }

    public static function cartProductDelete($id)
    {
        if (isset($_SESSION['products'])) {
            ModelCart::getCartProductDelete($id);
            $productsInCart = $_SESSION['products'];
            $productArray = array_keys($productsInCart);
            $productList = ModelCart::getProductsById_s($productArray);
            $totalSum = ModelCart::getTotalPrice($productList);
        }
        include_once('view/cartList.php');
    }

    public static function cartProductAdd($id)
    {
        if (isset($_SESSION['products'])) {
            ModelCart::getCartAdd($id);
            $productsInCart = $_SESSION['products'];
            $productArray = array_keys($productsInCart);
            $productList = ModelCart::getProductsById_s($productArray);
            $totalSum = ModelCart::getTotalPrice($productList);
        }
        include_once('view/cartList.php');
    }


    //--- cartClear
    public static function cartClear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
        include_once('view/cartList.php');
    }

    //--- order form
    public static function orderSend()
    {
        $sendResult = false;
        if (isset($_SESSION['products'])) {
            $sendResult = ModelCart::getSendOrder();
            if ($sendResult) {
                unset($_SESSION['products']);
            }
        }

        include_once('view/orderResult.php');
    }
}