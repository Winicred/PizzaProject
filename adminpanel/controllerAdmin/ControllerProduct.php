<?php

class ControllerProduct
{

    public static function productList()
    {
        $rows = ModelProduct::getProductActionList();
        include_once 'viewAdmin/productActionList.php';
    }

    public static function addProductForm()
    {
        $rowsCategory = ModelCategory::getCategoryActionList();
        include_once 'viewAdmin/productAddForm.php';
    }

    public static function addProductResult()
    {
        $result = ModelProduct::addProduct();
        include_once 'viewAdmin/productAddForm.php';
    }

    public static function editProductForm($id)
    {
        $rowsCategory = ModelCategory::getCategoryActionList();
        $product = ModelProduct::getProductDetail($id);
        include_once 'viewAdmin/productEditForm.php';
    }

    public static function editProductResult($id)
    {
        $result = ModelProduct::editProduct($id);
        include_once 'viewAdmin/productEditForm.php';
    }

    public static function deleteProductForm($id)
    {
        $rowsCategory = ModelCategory::getCategoryActionList();
        $product = ModelProduct::getProductDetail($id);
        include_once 'viewAdmin/productDeleteForm.php';
    }

    public static function deleteProductResult($id)
    {
        $result = ModelProduct::deleteProduct($id);
        include_once 'viewAdmin/productDeleteForm.php';
    }
}




