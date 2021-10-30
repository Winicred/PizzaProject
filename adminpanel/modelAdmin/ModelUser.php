<?php

class ModelUser
{
    public static function getUsersActionList()
    {
        $database = new Database();
        return $database->getAll("SELECT * FROM user ORDER BY user.id ASC");
    }

    public static function addUser()
    {
        $result = false;

        if (isset($_POST['save'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $password = $_POST['password'];
            $image = $_FILES['picture']['name'];

            if ($image != "") {
                $uploadFile = '../public/images/' . basename($_FILES['picture']['name']);
                copy($_FILES['picture']['tmp_name'], $uploadFile);
            } else {
                $image = "emptyUser.png";
            }

            if ($password != '') {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $database = new Database();
                $item = $database->executeRun("INSERT INTO user (id, username, epost, password, role, picture) VALUES (NULL, '$username', '$email' , '$hashedPassword', '$role', '$image')");
                if ($item == true) {
                    $result = true;
                }
            }
        }

        return $result;
    }

    public static function getUserDetail($id)
    {
        $database = new Database();
        return $database->getOne("SELECT user.* FROM user WHERE user.id = $id");
    }

    public static function editUser($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['email'];
            $role = $_POST['role'];
            $oldpicture = $_POST['oldpicture'];

            $image = $_FILES['picture']['name'];
            if ($image != "" && $image != $oldpicture) {
                $uploadFile = '../public/images/' . basename($_FILES['picture']['name']);
                copy($_FILES['picture']['tmp_name'], $uploadFile);
                unlink("../public/images" . $oldpicture);
            } else {
                $image = $oldpicture;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $database = new Database();
            $item = $database->executeRun("UPDATE user SET username = '$username', epost = '$email', password = '$hashedPassword', role = '$role', picture = '$image' WHERE user.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }

    public static function deleteUser($id)
    {
        $result = false;

        if (isset($_POST['save'])) {
            $oldpicture = $_POST['oldpicture'];

            unlink("../public/images" . $oldpicture);

            $database = new Database();
            $item = $database->executeRun("DELETE FROM user WHERE user.id = $id");
            if ($item == true) {
                $result = true;
            }
        }

        return $result;
    }
}