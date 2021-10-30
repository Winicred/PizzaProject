<?php
ob_start();
$titel = "Просмотр товара - " . $product['name'];
?>

    <div class="productDetail" style="min-height: 300px">
        <img src="public/images/<?php echo $product['photo'] ?>" class="imgStyle">
        <h3><?php echo $product['name'] ?></h3>
        <p><b>Ингредиенты: </b><?php echo $product['description'] ?></p>
        <p><b>Категория: </b><?php echo $product['category'] ?></p>
        <p><b>Цена: </b><?php echo $product['price'] ?></p>
        <div>
            <br>
            <a href="product?id=<?php echo $product['idCategory'] ?>">К списку по категориям &#187 </a>
            <span class="a"><a href="cart?id=<?php echo $product['id'] ?>">Заказать &#187 </a></span>
        </div>
    </div>

    <div class="col-md-12">
        <hr>
        <h3 class="text-uppercase text-center">Отзывы</h3>
        <hr>
    </div>

    <form action="sendReview?id=<?php echo $product['id'] ?>" method="POST"
          style="display: flex; flex-direction: column">
        <label for="text">Отзыв</label>
        <input <?php if (!isset($_SESSION['userId'])) echo 'disabled' ?>
                id="text" style="margin: 0" type="text" name="text" placeholder="Отзыв"
                class="form-control" <?php if (!isset($_SESSION['userId'])) echo 'value=""' ?>>

        <label for="rating" style="margin-top: 15px">Ваша оценка данному товару?</label>
        <select name="rating" id="rating" <?php if (!isset($_SESSION['userId'])) echo 'disabled' ?> class="form-control">
                <option hidden>Оценка:</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
        </select>

        <button <?php if (!isset($_SESSION['userId'])) echo 'disabled' ?>
                class="btn btn-primary" style="width: 15%; margin-top: 15px">Опубликовать
        </button>
    </form>

    <hr>

    <div class="reviews_body">
        <form action="sortReviewsBy?id=<?php echo $product['id'] ?>" method="POST"
              style="border: none; width: 100%">
            <select name="orderProductDetailsBy" id="review" class="form-control" style="margin-bottom: 20px"
                    onchange="this.form.submit()">
                <option hidden>Сортировать по:</option>
                <option value="0">По умолчанию</option>
                <option value="1">Дате публикации (по возрастанию)</option>
                <option value="2">Дате публикации (по убыванию)</option>
                <option value="3">Дате изменения (по возрастанию)</option>
                <option value="4">Дате изменения (по убыванию)</option>
                <option value="5">Имени пользователя (по возрастанию)</option>
                <option value="6">Имени пользователя (по убыванию)</option>
                <option value="7">Количеству лайков (по возрастанию)</option>
                <option value="8">Количеству лайков (по убыванию)</option>
                <option value="9">Количеству дизлайков (по возрастанию)</option>
                <option value="10">Количеству дизлайков (по убыванию)</option>
                <option value="11">Рейтингу (по убыванию)</option>
                <option value="12">Рейтингу (по убыванию)</option>
            </select>
        </form>

        <?php foreach ($reviews as $review) {
            if ($review['product_id'] == $product['id']) { ?>
                <div class="comment">
                    <div class="comment_description">
                        <div class="comment_image">
                            <img src="public/images/<?php echo $review['picture'] ?>" alt="">
                        </div>

                        <div class="comment_author">
                            <b><?php echo $review['username'] ?></b>
                        </div>

                        <?php if (isset($_SESSION['userId'])) { ?>
                            <div class="comment_stats">
                                <div class="like">
                                    <?php if (!isset($_SESSION['isLikeSetToReview'][$review['id']]) || $_SESSION['isLikeSetToReview'][$review['id']] == false) { ?>
                                        <a href="likeReview?id=<?php echo $review['id'] ?>&productId=<?php echo $product['id'] ?>">
                                            <i class="fas fa-thumbs-up"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="removeLikeFromReview?id=<?php echo $review['id'] ?>&productId=<?php echo $product['id'] ?>">
                                            <i class="fas fa-thumbs-up" style="color: blue"></i>
                                        </a>
                                    <?php } ?>
                                    <span><?php echo $review['likeCount'] ?></span>
                                </div>

                                <div class="dislike">
                                    <?php if (!isset($_SESSION['isDislikeSetToReview'][$review['id']]) || $_SESSION['isDislikeSetToReview'][$review['id']] == false) { ?>
                                        <a href="dislikeReview?id=<?php echo $review['id'] ?>&productId=<?php echo $product['id'] ?>">
                                            <i class="fas fa-thumbs-down"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="removeDislikeFromReview?id=<?php echo $review['id'] ?>&productId=<?php echo $product['id'] ?>">
                                            <i class="fas fa-thumbs-down" style="color: blue"></i>
                                        </a>
                                    <?php } ?>
                                    <span><?php echo $review['dislikeCount'] ?></span>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="comment_date" <?php if (!isset($_SESSION['userId'])) echo 'style="margin-left: auto"' ?>>
                        <span>
                            <?php if ($review['edit_date'] == NULL) { ?>
                                <span><?php echo $review['submit_date'] ?></span>
                            <?php } else { ?>
                                <span>Изменено: <?php echo $review['edit_date'] ?></span>
                            <?php } ?>
                        </span>
                        </div>
                    </div>

                    <div class="comment_text">
                        <p><b>Отзыв: </b><?php echo $review['text'] ?></p>
                    </div>

                    <div class="comment-footer">
                        <div class="review rating">
                            <b>Рейтинг товару от пользователя: <i>(<?php echo $review['rating'] ?>)</i></b>
                            <i class="fas fa-star" <?php if ($review['rating'] >= 1) echo 'style="color: #FFD700"' ?>></i>
                            <i class="fas fa-star" <?php if ($review['rating'] >= 2) echo 'style="color: #FFD700"' ?>></i>
                            <i class="fas fa-star" <?php if ($review['rating'] >= 3) echo 'style="color: #FFD700"' ?>></i>
                            <i class="fas fa-star" <?php if ($review['rating'] >= 4) echo 'style="color: #FFD700"' ?>></i>
                            <i class="fas fa-star" <?php if ($review['rating'] >= 5) echo 'style="color: #FFD700"' ?>></i>
                        </div>
                        <?php
                        if (isset($_SESSION['userId'])) {
                            if ($_SESSION['role'] == 'admin' || $_SESSION['userId'] == $review['userId']) { ?>
                                <div class="comment_tools">
                                    <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#editReview<?php echo $review['id'] ?>"><i
                                                class="fas fa-edit"></i> Изменить
                                    </button>

                                    <?php if ($_SESSION['role'] == 'admin') { ?>
                                        <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteReview<?php echo $review['id'] ?>"><i
                                                    class="fas fa-trash-alt"></i> Удалить
                                        </button>
                                    <?php } ?>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>

                <div id="editReview<?php echo $review['id'] ?>" class="modal fade"
                     role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    &times;
                                </button>
                                <h4 class="modal-title">Изменение отзыва пользователя
                                    <b><?php echo $review['username'] ?></b></h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST"
                                      action="editReview?id=<?php echo $review['id'] ?>&productId=<?php echo $product['id'] ?>">
                                    <label for="text">Текст отзыва *</label>
                                    <input type="text" id="text" name="text" value="<?php echo $review['text'] ?>"
                                           placeholder="Отзыв..." class="form-control" required>

                                    <label for="rating" style="margin-top: 15px">Рейтинг пользователя *</label>
                                    <select name="rating" id="rating" class="form-control" required>
                                        <option hidden>Оценка:</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    <label for="likeCount" style="margin-top: 15px">Количество лайков</label>
                                    <input type="number" id="likeCount" name="likeCount" class="form-control"
                                           value="<?php echo $review['likeCount'] ?>" min="0">

                                    <label for="dislikeCount" style="margin-top: 15px">Количество дизайков</label>
                                    <input type="number" id="dislikeCount" name="dislikeCount" class="form-control"
                                           value="<?php echo $review['dislikeCount'] ?>" min="0">

                                    <label for="userId" style="margin-top: 15px">Пользователь *</label>
                                    <select name="userId" id="userId" class="form-control" required>
                                        <?php foreach ($users as $user) { ?>
                                            <option value="<?php echo $user['id'] ?>"><?php echo $user['id'] ?>. <?php echo $user['username'] ?></option>
                                        <?php } ?>
                                    </select>

                                    <button style="margin-top: 15px" type="submit" class="btn btn-primary">Изменить
                                    </button>
                                </form>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Закрыть
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="deleteReview<?php echo $review['id'] ?>" class="modal fade"
                     role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    &times;
                                </button>
                                <h4 class="modal-title">Удаление отзыва <b><?php echo $review['username'] ?></b>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <p>Вы уверенны что хотите удалить отзыв пользователя:
                                    <b><?php echo $review['username'] ?></b>?</p>
                                <form style="border: none">
                                    <label for="text">Текст отзыва</label>
                                    <input type="text" id="text" name="text" value="<?php echo $review['text'] ?>"
                                           placeholder="Отзыв..." class="form-control" readonly>

                                    <label for="rating" style="margin-top: 15px">Рейтинг пользователя</label>
                                    <select name="rating" id="rating" class="form-control" disabled>
                                        <option hidden>Оценка:</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    <label for="likeCount" style="margin-top: 15px">Количество лайков</label>
                                    <input type="number" id="likeCount" name="likeCount" class="form-control"
                                           value="<?php echo $review['likeCount'] ?>" min="0" readonly>

                                    <label for="dislikeCount" style="margin-top: 15px">Количество дизайков</label>
                                    <input type="number" id="dislikeCount" name="dislikeCount" class="form-control"
                                           value="<?php echo $review['dislikeCount'] ?>" min="0" readonly>

                                    <label for="userId" style="margin-top: 15px">Пользователь</label>
                                    <select name="userId" id="userId" class="form-control" disabled>
                                        <?php foreach ($users as $user) { ?>
                                            <option value="<?php echo $user['id'] ?>"><?php echo $user['id'] ?>. <?php echo $user['username'] ?></option>
                                        <?php } ?>
                                    </select>
                                </form>
                                <div class="modal-footer"
                                     style="width: 100%; display: inline-flex; justify-content: end">
                                    <button type="button" class="btn btn-primary" style="margin-right: 10px"
                                            data-dismiss="modal">Нет
                                    </button>
                                    <form method="POST"
                                          action="deleteReview?id=<?php echo $review['id'] ?>&productId=<?php echo $product['id'] ?>"
                                          style="border: 0">
                                        <button type="submit" class="btn btn-danger">Да</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>
    </div>


    <style>
        .reviews_body {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-top: 30px;
        }

        .comment {
            border: 1px solid black;
            margin-bottom: 20px;
            padding: 10px;
            display: flex;
            flex-direction: column;
        }

        .comment_description {
            width: 100%;
            display: flex;
        }

        .comment_image {
            width: 4%;
            display: flex;
        }

        .comment_image img {
            width: 100%;
            margin: 0 auto;
            border-radius: 100%;
        }

        .comment_author {
            display: flex;
            align-items: center;
        }

        .comment_stats {
            margin-left: auto;
            margin-right: 15px;
            display: flex;
            justify-content: space-between;
        }

        .comment_stats .like {
            margin-right: 10px;
        }

        .comment_stats .like a i,
        .comment_stats .dislike a i {
            color: black;
        }

        .comment_stats .like a i:hover,
        .comment_stats .dislike a i:hover {
            color: #5151ff;
        }

        .comment_date {
            font-size: 12px;
            color: #808080;
        }

        .comment_text {
            word-wrap: break-word;
            padding: 5px;
        }

        .comment_text p {
            margin: 0;
        }

        .comment-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>

<?php
$content = ob_get_clean();
include "view/templates/layout.php";
?>