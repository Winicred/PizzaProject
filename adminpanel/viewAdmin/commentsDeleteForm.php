<?php
ob_start();
?>

    <div class="col-sx-9">
        <h4 class="box-title">Удалить комментарий</h4>
        <p>Дата удаления комментария: <?php echo date("d-m-Y") ?></p>

        <?php
        if (isset($result)) {
            if ($result) {
                ?>
                <div class="alert alert-info">
                    <strong>Запись удалена. </strong>
                    <a href="commentsAction">Список категорий</a>
                </div>
            <?php } elseif ($result == false) { ?>
                <div class="alert alert-warning">
                    <strong>Ошибка удаления записи! </strong>
                    <a href="commentsAction">Список категорий</a>
                </div>
            <?php }
        } else { ?>
            <form action="deleteCommentResult?id=<?php echo $comment['id'] ?>" method="POST"
                  enctype="multipart/form-data">
                <label for="name">Текст</label>
                <input id="name" type="text" class="form-control"
                       value="<?php echo $comment['text'] ?>" readonly>

                <label for="submitDate">Дата добавления</label>
                <input id="submitDate" type="text" class="form-control"
                       value="<?php echo $comment['submit_date'] ?>" readonly>

                <label for="editDate">Дата изменения</label>
                <input id="editDate" type="text" class="form-control"
                       value="<?php if ($comment['edit_date'] == NULL) {
                           echo 'NULL';
                       } else {
                           echo $comment['edit_date'];
                       } ?>" readonly>

                <label for="newsId">ID новости</label>
                <input id="newsId" type="number" class="form-control"
                       value="<?php echo $comment['newsId'] ?>" readonly>

                <label for="userId">ID пользователя</label>
                <input id="userId" type="number" class="form-control"
                       value="<?php echo $comment['userId'] ?>" readonly>

                <label for="likeCount">Количество лайков</label>
                <input id="likeCount" type="number" class="form-control"
                       value="<?php echo $comment['likeCount'] ?>" readonly>

                <label for="dislikeCount">Количество дизлайков</label>
                <input id="dislikeCount" type="number" class="form-control"
                       value="<?php echo $comment['dislikeCount'] ?>" readonly>

                <input type="submit" class="btn btn-success" value="удалить комментарий" name="save">
            </form>
        <?php } ?>
    </div>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


