<?php

class ControllerUser
{
    public static function usersList()
    {
        $rows = ModelUser::getUsersActionList();
        include_once 'viewAdmin/userActionList.php';
    }

    public static function addUserForm()
    {
        include_once 'viewAdmin/userAddForm.php';
    }

    public static function addUserResult()
    {
        $result = ModelUser::addUser();
        include_once 'viewAdmin/userAddForm.php';
    }

    public static function editUserForm($id)
    {
        $user = ModelUser::getUserDetail($id);
        include_once 'viewAdmin/userEditForm.php';
    }

    public static function editUserResult($id)
    {
        $result = ModelUser::editUser($id);
        include_once 'viewAdmin/userEditForm.php';
    }

    public static function deleteUserForm($id)
    {
        $rowsCategory = ModelCategory::getCategoryActionList();
        $user = ModelUser::getUserDetail($id);
        include_once 'viewAdmin/userDeleteForm.php';
    }

    public static function deleteUserResult($id)
    {
        $result = ModelUser::deleteUser($id);
        include_once 'viewAdmin/userDeleteForm.php';
    }
}