<?php

class ModelNews
{

    public static function getNewsActionList()
    {
        $database = new Database();
        return $database->getAll("SELECT * FROM news ORDER BY news.id ASC");
    }

    public static function getNewsUserId()
    {
        $database = new Database();
        return $database->getAll("SELECT user.* FROM user WHERE news.idUser = user.id");
    }

    public static function addNews()
    {
        $result = false;

        if (isset($_POST['save'])) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $date = date("d-m-Y");
            $idUser = $_SESSION['userId'];

            $image = $_FILES['picture']['name'];
            if ($image != "") {
                $uploadFile = '../public/images/' . basename($_FILES['picture']['name']);
                copy($_FILES['picture']['tmp_name'], $uploadFile);
            }

            $database = new Database();
            $item = $database->executeRun("INSERT INTO news (id, title, text, picture, date, idUser) VALUES (NULL, '$title', '$text', '$image', '$date', '$idUser')");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function getNewsDetail($id)
    {
        $database = new Database();
        return $database->getOne("SELECT news.* FROM news WHERE news.id = $id");
    }

    public static function editNews($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $date = date("Y-m-d");
            $idUser = $_SESSION['userId'];
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
            $item = $database->executeRun("UPDATE news SET title = '$title', text = '$text', picture = '$image', date = '$date', idUser = '$idUser' WHERE news.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function deleteNews($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $database = new Database();
            $item = $database->executeRun("DELETE FROM news WHERE news.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }
}