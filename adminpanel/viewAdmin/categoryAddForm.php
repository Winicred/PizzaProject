<?php
ob_start();
?>

    <div class="col-xs-9">
    <h4 class="box-title">Добавить товар</h4>
    <p>Сегодня: <?php echo date('d-m-Y') ?></p>

<?php
if (isset($result)) {
    if ($result == true) { ?>

        <div class="alert alert-info">
            <strong>Запись добавлена. <strong><a href="categoryAction">Список категорий</a></strong></strong>
        </div>

    <?php } elseif ($result == false) { ?>
        <div class="alert alert-warning">
            <strong>Ошибка добавления записи! </strong>
            <a href="categoryAction">Список категорий</a>
        </div>
    <?php }
} else { ?>

    <form action="addCategoryResult" method="POST" enctype="multipart/form-data">
        <label for="text">Название категории *</label>
        <input type="text" name="category" placeholder="Название категории" class="form-control" required>

        <input type="submit" class="btn btn-success" value="добавить категорию" name="save">
    </form>
    </div>
<?php } ?>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';
