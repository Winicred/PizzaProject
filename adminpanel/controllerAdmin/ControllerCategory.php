<?php

class ControllerCategory
{
    public static function categoryList()
    {
        $rows = ModelCategory::getCategoryActionList();
        include_once 'viewAdmin/categoryActionList.php';
    }

    public static function addCategoryForm()
    {
        $rowsCategory = ModelCategory::getCategoryActionList();
        include_once 'viewAdmin/categoryAddForm.php';
    }

    public static function addCategoryResult()
    {
        $result = ModelCategory::addCategory();
        include_once 'viewAdmin/categoryAddForm.php';
    }

    public static function editCategoryForm($id)
    {
        $rowsCategory = ModelCategory::getCategoryActionList();
        $category = ModelCategory::getCategoryDetail($id);
        include_once 'viewAdmin/categoryEditForm.php';
    }

    public static function editCategoryResult($id)
    {
        $result = ModelCategory::editCategory($id);
        include_once 'viewAdmin/categoryEditForm.php';
    }

    public static function deleteCategoryForm($id)
    {
        $rowsCategory = ModelCategory::getCategoryActionList();
        $category = ModelCategory::getCategoryDetail($id);
        include_once 'viewAdmin/categoryDeleteForm.php';
    }

    public static function deleteCategoryResult($id)
    {
        $result = ModelCategory::deleteCategory($id);
        include_once 'viewAdmin/categoryDeleteForm.php';
    }
}