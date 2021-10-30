<?php
ob_start();
?>

    <div class="col-xs-9">
    <h4 class="box-title">Добавить новость</h4>
    <p>Сегодня: <?php echo date('d-m-Y') ?></p>

<?php
if (isset($result)) {
    if ($result == true) { ?>

        <div class="alert alert-info">
            <strong>Запись добавлена. <strong><a href="newsAction">Список новостей</a></strong></strong>
        </div>

    <?php } elseif ($result == false) { ?>
        <div class="alert alert-warning">
            <strong>Ошибка добавления записи! </strong>
            <a href="newsAction">Список новостей</a>
        </div>
    <?php }
} else { ?>

    <form action="addNewsResult" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Заголовок" class="form-control" required>

        <textarea name="text" placeholder="Описание новости..." class="form-control" required></textarea>

        <input type="file" name="picture" class="form-control" required>
        <input type="submit" class="btn btn-success" value="добавить продукт" name="save">
    </form>
    </div>
<?php } ?>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';
