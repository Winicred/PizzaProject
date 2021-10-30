<?php

class ModelProduct
{

    public static function getProductActionList()
    {
        $database = new Database();
        return $database->getAll("SELECT product.*, category.category FROM product, category WHERE product.idCategory = category.id ORDER BY product.id ASC");
    }

    public static function addProduct()
    {
        $result = false;

        if (isset($_POST['save'])) {
            $name = $_POST['name'];
            $text = $_POST['description'];
            $idCategory = $_POST['category'];
            $price = $_POST['price'];
            $image = $_FILES['picture']['name'];

            if ($image != "") {
                $uploadFile = '../public/images/' . basename($_FILES['picture']['name']);
                copy($_FILES['picture']['tmp_name'], $uploadFile);
            }

            $database = new Database();
            $item = $database->executeRun("INSERT INTO product (id, idCategory, name, description, price, photo) VALUES (NULL, '$idCategory', '$name', '$text', '$price', '$image')");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function getProductDetail($id)
    {
        $database = new Database();
        return $database->getOne("SELECT product.*, category.category FROM product, category WHERE product.idCategory = category.id AND product.id = $id");
    }

    public static function editProduct($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $idCategory = $_POST['category'];
            $price = $_POST['price'];
            $oldpicture = $_POST['oldpicture'];

            $image = $_FILES['picture']['name'];
            if ($image != "" && $image != $oldpicture) {
                $uploadFile = '../public/images/' . basename($_FILES['picture']['name']);
                copy($_FILES['picture']['tmp_name'], $uploadFile);
                unlink("../public/images" . $oldpicture);
            } else {
                $image = $oldpicture;
            }

            $database = new Database();
            $item = $database->executeRun("UPDATE product SET idCategory = '$idCategory', name = '$name', description = '$description', price = '$price', photo = '$image' WHERE product.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function deleteProduct($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $oldpicture = $_POST['oldpicture'];

            unlink("../public/images" . $oldpicture);

            $database = new Database();
            $item = $database->executeRun("DELETE FROM product WHERE product.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }
}