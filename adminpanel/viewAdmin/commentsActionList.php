<?php
ob_start();
?>

    <h4 class="box-title">Управление списком комментариев</h4>
    <a class="btn btn-success btn-sm" href="addComments" style="color: white">добавить комментарий</a>

    <table class="table table-striped">
        <thead>
        <tr class="d-flex">
            <th>#</th>
            <th>Текст</th>
            <th>Дата добавления</th>
            <th>Дата изменения</th>
            <th>Заголовок новости</th>
            <th>Автор</th>
            <th>Количество лайков</th>
            <th>Количество дизлайков</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td style="word-break: break-word"><?php echo $row['text'] ?></td>
                <td><?php echo $row['submit_date'] ?></td>
                <td>
                    <?php if ($row['edit_date'] == NULL) { ?>
                        <span>NULL</span>
                    <?php } else { ?>
                        <span><?php echo $row['edit_date'] ?></span>
                    <?php } ?></td>
                <td><a href="../newsDetail?id=<?php echo $row['newsId'] ?>"><?php echo $row['title'] ?></i></a></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['likeCount'] ?></td>
                <td><?php echo $row['dislikeCount'] ?></td>
                <td style="width: 7%">
                    <a class="btn btn-warning btn-sm btn-block" href="editComment?id=<?php echo $row['id'] ?>"
                       style="color: white">изменить</a>

                    <a class="btn btn-danger btn-sm btn-block" href="deleteComment?id=<?php echo $row['id'] ?>"
                       style="color: white">удалить</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

        <tfoot>
        <tr>
            <td colspan="7"></td>
            <td><b>Всего наименований: <?php echo count($rows) ?></b></td>
        </tr>
        </tfoot>
    </table>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


