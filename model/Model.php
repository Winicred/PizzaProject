<?php

class Model
{
    public static function getCategoryList()
    {
        $db = new Database();
        return $db->getAll("SELECT * FROM category ORDER BY category.category ASC");
    }

    //---------- одна категория - название
    public static function getCategoryById($id)
    {
        $db = new Database();
        return $db->getOne("SELECT * FROM category WHERE id = $id");
    }

    //---------- продукты по категориям
    public static function getProductByCategory($id)
    {
        $db = new Database();

        if ($id == 0) {
            return $db->getAll("SELECT * FROM product ORDER BY product.name ASC");
        } else {
            //результат - список продукци - массив из таблицы продукт
            return $db->getAll("SELECT * FROM product WHERE idCategory = $id ORDER BY product.name ASC");
        }
    }

    //--------- один продукт
    public static function getProductbyId($id)
    {
        $db = new Database();
        return $db->getOne("SELECT product.*, category.category FROM product,category WHERE product.idCategory = category.id AND product.id = $id");
    }

    public static function getNewsList()
    {
        $db = new Database();
        //$item массив данных
        return $db->getAll("SELECT news.*, user.username FROM news, user WHERE news.idUser = user.id ORDER BY `date` DESC ");
    }

    //---

    public static function getNewsbyId($id)
    {
        $db = new Database();
        return $db->getOne("SELECT news.*, user.username FROM news, user WHERE news.idUser = user.id AND news.id = $id");
    }

    public static function login()
    {
        $result = false;
        if (isset($_SESSION['sessionId'])) {
            $result = true;
        } else {
            $_SESSION['error'] = 'Неправильно имя пользователя или пароль';
            if (isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] != "" && $_POST['password'] != "") {
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

                $database = new Database();
                $item = $database->getOne("SELECT * FROM `user` WHERE `epost` = '$email'");

                if ($item != null) {
                    $password = $_POST['password'];

                    if ($email == $item['epost'] && password_verify($password, $item['password'])) {
                        $_SESSION['sessionId'] = session_id();
                        $_SESSION['userId'] = $item['id'];
                        $_SESSION['name'] = $item['username'];
                        $_SESSION['role'] = $item['role'];
                        $_SESSION['email'] = $item['epost'];
                        $_SESSION['picture'] = $item['picture'];
                        $result = true;
                    }
                }
            }
        }

        return $result;
    }

    public static function logout()
    {
        session_destroy();
        unset($_SESSION['sessionId']);
        unset($_SESSION['userId']);
        unset($_SESSION['name']);
        unset($_SESSION['role']);
        unset($_SESSION['email']);
        unset($_SESSION['picture']);
    }

    public static function getComments()
    {
        $db = new Database();
        return $db->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id");
    }

    public static function sendComment($id)
    {
        $db = new Database();

        $text = $_POST['comment'];
        $submit_date = date("Y-m-d H-i-s");
        $userId = $_SESSION['userId'];

        return $db->executeRun("INSERT INTO comments (text, submit_date, edit_date, newsId, userId) VALUES ('$text', '$submit_date', NULL, '$id', '$userId')");
    }

    public static function setLikeToNews($id)
    {
        $db = new Database();

        $likeCount = $db->getOne("SELECT likeCount FROM comments WHERE id = $id");
        $likeCount = $likeCount['likeCount'] + 1;

        if (isset($_SESSION['isDislikeSet'][$id]) || $_SESSION['isDislikeSet'][$id] == true) {
            unset($_SESSION['isDislikeSet'][$id]);
            self::removeDislikeToNews($id);
        }

        $_SESSION['isLikeSet'][$id] = true;

        return $db->executeRun("UPDATE comments SET likeCount = '$likeCount' WHERE id = $id");
    }

    public static function removeDislikeToNews($id)
    {
        $db = new Database();

        $dislikeCount = $db->getOne("SELECT dislikeCount FROM comments WHERE id = $id");
        $dislikeCount = $dislikeCount['dislikeCount'] - 1;

        unset($_SESSION['isDislikeSet'][$id]);

        return $db->executeRun("UPDATE comments SET dislikeCount = '$dislikeCount' WHERE id = $id");
    }

    public static function setDislikeToNews($id)
    {
        $db = new Database();

        $dislikeCount = $db->getOne("SELECT dislikeCount FROM comments WHERE id = $id");
        $dislikeCount = $dislikeCount['dislikeCount'] + 1;

        if (isset($_SESSION['isLikeSet'][$id]) || $_SESSION['isLikeSet'][$id] == true) {
            unset($_SESSION['isLikeSet'][$id]);
            self::removeLikeToNews($id);
        }

        $_SESSION['isDislikeSet'][$id] = true;

        return $db->executeRun("UPDATE comments SET dislikeCount = '$dislikeCount' WHERE id = $id");
    }

    public static function removeLikeToNews($id)
    {
        $db = new Database();

        $likeCount = $db->getOne("SELECT likeCount FROM comments WHERE id = $id");
        $likeCount = $likeCount['likeCount'] - 1;

        unset($_SESSION['isLikeSet'][$id]);

        return $db->executeRun("UPDATE comments SET likeCount = '$likeCount' WHERE id = $id");
    }

    public static function editComment($id)
    {
        $db = new Database();

        $text = $_POST['text'];
        $edit_date = date("Y-m-d H:i:s");

        return $db->executeRun("UPDATE comments SET text = '$text', edit_date = '$edit_date' WHERE id = $id");
    }

    public static function deleteComment($id)
    {
        $db = new Database();
        return $db->executeRun("DELETE FROM comments WHERE id = $id");
    }

    public static function registration()
    {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $image = $_FILES['picture']['name'];

        if ($image != "") {
            $uploadFile = '../public/images/' . basename($_FILES['picture']['name']);
            copy($_FILES['picture']['tmp_name'], $uploadFile);
        } else {
            $image = "emptyUser.png";
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $db = new Database();
        $db->executeRun("INSERT INTO user (id, username, epost, password, role, picture) VALUES (NULL, '$login', '$email' , '$hashedPassword', 'client', '$image')");

        $item = $db->getOne("SELECT * FROM `user` WHERE `epost` ='" . $email . "'");
        if ($item != null) {
            if ($email == $item['epost'] && password_verify($password, $item['password'])) {
                $_SESSION['sessionId'] = session_id();
                $_SESSION['userId'] = $item['id'];
                $_SESSION['name'] = $item['username'];
                $_SESSION['role'] = $item['role'];
                $_SESSION['email'] = $item['epost'];
                $_SESSION['picture'] = $item['picture'];
            }
        }
    }

    public static function changePassword()
    {
        $result = array(false, "No correct password");

        if (isset($_POST['send'])) {
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            if ($newPassword == $confirmPassword && $newPassword != "") {
                $database = new Database();
                $item = $database->getOne("SELECT * FROM user WHERE epost = '" . $_SESSION['email'] . "'");
                if (password_verify($currentPassword, $item['password'])) {
                    $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                    $database = new Database();
                    $database->executeRun("UPDATE user SET password = '$passwordHash' WHERE user.id = " . $_SESSION['userId']);
                    $result = array(true, "Password changed!");
                }
            } else {
                $result = array(false, "No insert change password");
            }
        }

        return $result;
    }

    public static function changeData()
    {
        $result = array(false, "No correct data");

        if (isset($_POST['send'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $oldpicture = $_SESSION['picture'];

            $image = $_FILES['picture']['name'];
            if ($image != "") {
                $uploadFile = '../public/images/' . basename($_FILES['picture']['name']);
                copy($_FILES['picture']['tmp_name'], $uploadFile);
                if ($uploadFile != "emptyUser.png") {
                    unlink("../public/images" . $oldpicture);
                }
            } else {
                $image = "emptyUser.png";
            }

            if ($username != '' && $email != '') {
                $database = new Database();
                $database->executeRun("UPDATE user SET username = '$username', epost = '$email', picture = '$image' WHERE user.id = " . $_SESSION['userId']);
                $result = array(true, "Data changed!");

                $item = $database->getOne("SELECT * FROM `user` WHERE id = " . $_SESSION['userId']);

                $_SESSION['name'] = $item['username'];
                $_SESSION['email'] = $item['epost'];
                $_SESSION['picture'] = $item['picture'];
            } else {
                $result = array(false, "Cannot change data!");
            }
        }

        return $result;
    }

    public static function sortCommentsBy()
    {
        $sortMethod = $_POST['orderNewsBy'];
        if ($sortMethod == '') {
            $sortMethod = '0';
        }
        $database = new Database();

        switch ($sortMethod) {
            case "0":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id");
            case "1":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id ORDER BY submit_date ASC");
            case "2":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id ORDER BY submit_date DESC");
            case "3":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id ORDER BY edit_date ASC");
            case "4":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id ORDER BY edit_date DESC");
            case "5":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id ORDER BY user.username ASC");
            case "6":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id ORDER BY user.username DESC");
            case "7":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id ORDER BY likeCount ASC");
            case "8":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id ORDER BY likeCount DESC");
            case "9":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id ORDER BY dislikeCount ASC");
            case "10":
                return $database->getAll("SELECT user.*, comments.* FROM comments, user WHERE comments.userId = user.id ORDER BY dislikeCount DESC");
        }
    }

    public static function rateProduct($id)
    {
        $database = new Database();

        $rating = $_POST['rating'];

        $currentRating = $database->getOne("SELECT rating FROM product WHERE id = $id");
        $currentRating = $currentRating['rating'];
        $peopleRatingCount = $database->getOne("SELECT peopleRatingCount FROM product WHERE id = $id");
        $peopleRatingCount = $peopleRatingCount['peopleRatingCount'] + 1;

        $newRating = (($currentRating * ($peopleRatingCount - 1)) + $rating) / ($peopleRatingCount);

        return $database->executeRun("UPDATE product SET rating = '$newRating', peopleRatingCount = '$peopleRatingCount' WHERE id = $id");
    }

    public static function sendReview($id)
    {
        $text = $_POST['text'];
        $submit_date = date("Y-m-d H:i:s");
        $rating = $_POST['rating'];
        $userId = $_SESSION['userId'];

        $database = new Database();
        return $database->executeRun("INSERT INTO reviews (id, text, submit_date, edit_date, rating, product_id, user_id, likeCount, dislikeCount) VALUES (NULL, '$text', '$submit_date', NULL, '$rating', '$id', '$userId', 0, 0)");
    }

    public static function getReviews()
    {
        $database = new Database();
        return $database->getAll("SELECT reviews.*, user.username, user.picture FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id");
    }

    public static function editReview($id)
    {
        $text = $_POST['text'];
        $edit_date = date("Y-m-d H:i:s");
        $rating = $_POST['rating'];
        $userId = $_POST['userId'];
        $likeCount = $_POST['likeCount'];
        $dislikeCount = $_POST['dislikeCount'];

        $database = new Database();
        return $database->getAll("UPDATE reviews SET text = '$text', edit_date = '$edit_date', rating = '$rating', user_id = '$userId', likeCount = '$likeCount', dislikeCount = '$dislikeCount' WHERE id = $id");
    }

    public static function getUsers()
    {
        $database = new Database();
        return $database->getAll("SELECT user.* FROM user");
    }

    public static function sortReviewBy()
    {
        $sortMethod = $_POST['orderProductDetailsBy'];
        if ($sortMethod == '') {
            $sortMethod = '0';
        }
        $database = new Database();

        switch ($sortMethod) {
            case "0":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id");
            case "1":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY submit_date ASC");
            case "2":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY submit_date DESC");
            case "3":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY edit_date ASC");
            case "4":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY edit_date DESC");
            case "5":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY user.username ASC");
            case "6":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY user.username DESC");
            case "7":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY likeCount ASC");
            case "8":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY likeCount DESC");
            case "9":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY dislikeCount ASC");
            case "10":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY dislikeCount DESC");
            case "11":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY rating DESC");
            case "12":
                return $database->getAll("SELECT reviews.*, user.username, user.picture, user.id FROM reviews, user, product WHERE reviews.user_id = user.id AND reviews.product_id = product.id ORDER BY rating DESC");
        }
    }

    public static function setLikeToReview($id)
    {
        $db = new Database();

        $likeCount = $db->getOne("SELECT likeCount FROM reviews WHERE id = $id");
        $likeCount = $likeCount['likeCount'] + 1;

        if (isset($_SESSION['isDislikeSetToReview'][$id]) || $_SESSION['isDislikeSetToReview'][$id] == true) {
            unset($_SESSION['isDislikeSetToReview'][$id]);
            self::removeDislikeFromReview($id);
        }

        $_SESSION['isLikeSetToReview'][$id] = true;

        return $db->executeRun("UPDATE reviews SET likeCount = '$likeCount' WHERE id = $id");
    }

    public static function removeLikeFromReview($id)
    {
        $db = new Database();

        $likeCount = $db->getOne("SELECT likeCount FROM reviews WHERE id = $id");
        $likeCount = $likeCount['likeCount'] - 1;

        unset($_SESSION['isLikeSetToReview'][$id]);

        return $db->executeRun("UPDATE reviews SET likeCount = '$likeCount' WHERE id = $id");
    }

    public static function setDislikeToReview($id)
    {
        $db = new Database();

        $dislikeCount = $db->getOne("SELECT dislikeCount FROM reviews WHERE id = $id");
        $dislikeCount = $dislikeCount['dislikeCount'] + 1;

        if (isset($_SESSION['isLikeSetToReview'][$id]) || $_SESSION['isLikeSetToReview'][$id] == true) {
            unset($_SESSION['isLikeSetToReview'][$id]);
            self::removeLikeFromReview($id);
        }

        $_SESSION['isDislikeSetToReview'][$id] = true;

        return $db->executeRun("UPDATE reviews SET dislikeCount = '$dislikeCount' WHERE id = $id");
    }

    public static function removeDislikeFromReview($id)
    {
        $db = new Database();

        $dislikeCount = $db->getOne("SELECT dislikeCount FROM reviews WHERE id = $id");
        $dislikeCount = $dislikeCount['dislikeCount'] - 1;

        unset($_SESSION['isDislikeSetToReview'][$id]);

        return $db->executeRun("UPDATE reviews SET dislikeCount = '$dislikeCount' WHERE id = $id");
    }

    public static function deleteReview($id)
    {
        $db = new Database();
        return $db->executeRun("DELETE FROM reviews WHERE id = $id");
    }

    public static function sortProductsBy()
    {
        $sortMethod = $_POST['sortProductsByMethod'];
        if ($sortMethod == '') {
            $sortMethod = '0';
        }
        $database = new Database();

        switch ($sortMethod) {
            case "0":
                return $database->getAll("SELECT * FROM product ORDER BY product.name ASC");
            case "1":
                return $database->getAll("SELECT * FROM product ORDER BY product.name ASC");
            case "2":
                return $database->getAll("SELECT * FROM product ORDER BY product.name DESC");
            case "3":
                return $database->getAll("SELECT * FROM product ORDER BY product.price ASC");
            case "4":
                return $database->getAll("SELECT * FROM product ORDER BY product.price DESC");
            case "5":
                return $database->getAll("SELECT * FROM product ORDER BY product.rating ASC");
            case "6":
                return $database->getAll("SELECT * FROM product ORDER BY product.rating DESC");
        }
    }
}