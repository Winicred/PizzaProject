<?php
ob_start();
?>

    <div class="col-sx-9">
        <h4 class="box-title">Редактировать комментарий</h4>
        <p>Comment update date: <?php echo date("d-m-Y") ?></p>

        <?php
        if (isset($result)) {
            if ($result) {
                ?>
                <div class="alert alert-info">
                    <strong>Запись изменена. </strong>
                    <a href="commentsAction">Список комметнариев</a>
                </div>
            <?php } elseif ($result == false) { ?>
                <div class="alert alert-warning">
                    <strong>Ошибка изменения записи! </strong>
                    <a href="commentsAction">Список комметнариев</a>
                </div>
            <?php }
        } else { ?>
            <form action="editCommentResult?id=<?php echo $comment['id'] ?>" method="POST"
                  enctype="multipart/form-data">
                <label for="name">Текст *</label>
                <input id="name" type="text" class="form-control" name="text"
                       value="<?php echo $comment['text'] ?>" required>

                <label for="newsId">Новость</label>
                <select name="newsId" id="newsId" class="form-control">
                    <?php foreach ($newsList as $news) { ?>
                        <option value="<?php echo $news['id'] ?>"><?php echo $news['id'] ?>
                            . <?php echo $news['title'] ?></option>
                    <?php } ?>
                </select>

                <label for="userId">Пользователь</label>
                <select name="userId" id="userId" class="form-control">
                    <?php foreach ($usersList as $user) { ?>
                        <option value="<?php echo $user['id'] ?>"><?php echo $user['id'] ?>
                            . <?php echo $user['username'] ?></option>
                    <?php } ?>
                </select>

                <label for="likeCount">Количество лайков</label>
                <input id="likeCount" type="number" class="form-control" name="likeCount"
                       value="<?php echo $comment['likeCount'] ?>" max="2147483647" required>

                <label for="dislikeCount">Количество дизлайков</label>
                <input id="dislikeCount" type="number" class="form-control" name="dislikeCount"
                       value="<?php echo $comment['dislikeCount'] ?>" max="2147483647" required>

                <input type="submit" class="btn btn-success" value="изменить комментарий" name="save">
            </form>
        <?php } ?>
    </div>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


