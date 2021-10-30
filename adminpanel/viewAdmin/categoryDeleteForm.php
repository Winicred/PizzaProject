<?php
ob_start();
?>

    <div class="col-sx-9">
        <h4 class="box-title">Удалить категорию</h4>
        <p>Дата удаления категории: <?php echo date("d-m-Y") ?></p>

        <?php
        if (isset($result)) {
            if ($result) {
                ?>
                <div class="alert alert-info">
                    <strong>Запись удалена. </strong>
                    <a href="categoryAction">Список категорий</a>
                </div>
            <?php } elseif ($result == false) { ?>
                <div class="alert alert-warning">
                    <strong>Ошибка удаления записи! </strong>
                    <a href="categoryAction">Список категорий</a>
                </div>
            <?php }
        } else { ?>
            <form action="deleteCategoryResult?id=<?php echo $category['id'] ?>" method="POST"
                  enctype="multipart/form-data">
                <label for="name">Имя</label>
                <input id="name" type="text" name="name" placeholder="Имя" class="form-control"
                       value="<?php echo $category['category'] ?>" readonly>

                <input type="submit" class="btn btn-success" value="удалить категорию" name="save">
            </form>
        <?php } ?>
    </div>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


