<?php
ob_start();
$titel = $news['title'];
?>

    <div class="col-md-12">
        <h2 class="text-uppercase text-center">Новости</h2>
        <hr>
    </div>
    <div class="nrow">
        <?php if ($news['id'] === $id) { ?>
        <div class="news_details__block">
            <img src="public/images/<?php echo $news['picture'] ?>">
            <h3><?php echo $news['title'] ?></h3>
            <p><?php echo $news['text'] ?></p>
            <a style="cursor: pointer; float: left; margin-bottom: 20px" onclick="window.history.back()" id="back">Назад
                &#187 </a>
            <?php } ?>
        </div>
    </div>

    <div class="col-md-12">
        <hr>
        <h3 class="text-uppercase text-center">Комментарии</h3>
        <hr>
    </div>

    <form action="commentNews?id=<?php echo $news['id'] ?>" method="POST" style="display: flex; flex-direction: column">
        <label for="comment">Текст комментария</label>
        <input <?php if (!isset($_SESSION['userId'])) echo 'disabled' ?>
                id="comment" style="margin: 0" type="text" name="comment" placeholder="Комментарий"
                class="form-control" <?php if (!isset($_SESSION['userId'])) echo 'value="Вы должны авторизоваться перед тем, как комментировать новость "' ?>>
        <button <?php if (!isset($_SESSION['userId'])) echo 'disabled' ?>
                class="btn btn-primary" style="width: 15%; margin-top: 15px">Комменитровать
        </button>
    </form>

    <hr>

    <div class="comments_body">
        <form action="sortCommentsBy?id=<?php echo $news['id'] ?>" method="POST" style="border: none">
            <select name="orderNewsBy" id="news" class="form-control" style="margin-bottom: 20px"
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
            </select>
        </form>
        <?php foreach ($comments as $comment) {
            if ($comment['newsId'] == $id) { ?>
                <div class="comment">
                    <div class="comment_description">
                        <div class="comment_image">
                            <img src="public/images/<?php echo $comment['picture'] ?>" alt="">
                        </div>

                        <div class="comment_author">
                            <b><?php echo $comment['username'] ?></b>
                        </div>

                        <?php if (isset($_SESSION['userId'])) { ?>
                            <div class="comment_stats">
                                <div class="like">
                                    <?php if (!isset($_SESSION['isLikeSet'][$comment['id']]) || $_SESSION['isLikeSet'][$comment['id']] == false) { ?>
                                        <a href="likeComment?id=<?php echo $comment['id'] ?>&newsId=<?php echo $news['id'] ?>">
                                            <i class="fas fa-thumbs-up"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="removeLikeFromComment?id=<?php echo $comment['id'] ?>&newsId=<?php echo $news['id'] ?>">
                                            <i class="fas fa-thumbs-up" style="color: blue"></i>
                                        </a>
                                    <?php } ?>
                                    <span><?php echo $comment['likeCount'] ?></span>
                                </div>

                                <div class="dislike">
                                    <?php if (!isset($_SESSION['isDislikeSet'][$comment['id']]) || $_SESSION['isDislikeSet'][$comment['id']] == false) { ?>
                                        <a href="dislikeComment?id=<?php echo $comment['id'] ?>&newsId=<?php echo $news['id'] ?>">
                                            <i class="fas fa-thumbs-down"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="removeDislikeFromComment?id=<?php echo $comment['id'] ?>&newsId=<?php echo $news['id'] ?>">
                                            <i class="fas fa-thumbs-down" style="color: blue"></i>
                                        </a>
                                    <?php } ?>
                                    <span><?php echo $comment['dislikeCount'] ?></span>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="comment_date" <?php if (!isset($_SESSION['userId'])) echo 'style="margin-left: auto"' ?>>
                        <span>
                            <?php if ($comment['edit_date'] == NULL) { ?>
                                <span><?php echo $comment['submit_date'] ?></span>
                            <?php } else { ?>
                                <span>Изменено: <?php echo $comment['edit_date'] ?></span>
                            <?php } ?>
                        </span>
                        </div>
                    </div>

                    <div class="comment_text">
                        <p><?php echo $comment['text'] ?></p>
                    </div>

                    <?php
                    if (isset($_SESSION['userId'])) {
                        if ($_SESSION['role'] == 'admin' || $_SESSION['userId'] == $comment['userId']) { ?>
                            <div class="comment_tools">
                                <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#editComment<?php echo $comment['id'] ?>"><i
                                            class="fas fa-edit"></i> Изменить
                                </button>

                                <?php if ($_SESSION['role'] == 'admin') { ?>
                                    <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteComment<?php echo $comment['id'] ?>"><i
                                                class="fas fa-trash-alt"></i> Удалить
                                    </button>
                                <?php } ?>
                            </div>
                        <?php }
                    } ?>
                </div>

                <div id="editComment<?php echo $comment['id'] ?>" class="modal fade"
                     role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    &times;
                                </button>
                                <h4 class="modal-title">Изменение комментария пользователя
                                    <b><?php echo $comment['username'] ?></b></h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST"
                                      action="editComment?id=<?php echo $comment['id'] ?>&newsId=<?php echo $news['id'] ?>">
                                    <label for="text">Комментарий *</label>
                                    <input type="text" id="text" name="text" value="<?php echo $comment['text'] ?>"
                                           placeholder="Комментарий..." class="form-control">
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

                <div id="deleteComment<?php echo $comment['id'] ?>" class="modal fade"
                     role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    &times;
                                </button>
                                <h4 class="modal-title">Удаляение комментария <b><?php echo $comment['username'] ?></b>?
                                </h4>
                            </div>
                            <div class="modal-body">
                                <p>Вы уверенны что хотите удалить комметарий пользователя:
                                    <b><?php echo $comment['username'] ?></b></p>
                                <form style="border: none">
                                    <input type="text" class="form-control" value="<?php echo $comment['text'] ?>"
                                           disabled>
                                </form>
                                <div class="modal-footer"
                                     style="width: 100%; display: inline-flex; justify-content: end">
                                    <button type="button" class="btn btn-primary" style="margin-right: 10px"
                                            data-dismiss="modal">Нет
                                    </button>
                                    <form method="POST"
                                          action="deleteComment?id=<?php echo $comment['id'] ?>&newsId=<?php echo $news['id'] ?>"
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
        .comments_body {
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

        .comment_tools {
            margin-left: auto;
        }
    </style>

<?php
$content = ob_get_clean();
include 'view/templates/layout.php';
?>
<?php

