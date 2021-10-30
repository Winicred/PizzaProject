<?php

class ModelCategory
{

    public static function getCategoryActionList()
    {
        $database = new Database();
        $rows = $database->getAll("SELECT * FROM category ORDER BY category.id ASC");

        return $rows;
    }

    public static function getCategoryDetail($id)
    {
        $database = new Database();
        $row = $database->getOne("SELECT category.* FROM category WHERE category.id = $id");

        return $row;
    }

    public static function addCategory()
    {
        $result = false;

        if (isset($_POST['save'])) {
            $name = $_POST['category'];

            $database = new Database();
            $item = $database->executeRun("INSERT INTO category (id, category) VALUES (NULL, '$name')");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function editCategory($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $name = $_POST['category'];

            $database = new Database();
            $item = $database->executeRun("UPDATE category SET category = '$name' WHERE category.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function deleteCategory($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $database = new Database();
            $item = $database->executeRun("DELETE FROM category WHERE category.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }
}