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
            <strong>Запись добавлена. </strong>
            <a href="productAction">Список продукции</a>
        </div>

    <?php } elseif ($result == false) { ?>
        <div class="alert alert-warning">
            <strong>Ошибка добавления записи! </strong>
            <a href="productAction">Список продукции</a>
        </div>
    <?php }
} else { ?>

    <form action="addProductResult" method="POST" enctype="multipart/form-data">
        <label for="name">Название</label>
        <input id="name" type="text" name="name" placeholder="Название" class="form-control" required>

        <label for="category">Категория</label>
        <select name="category" class="form-control" id="category">
            <?php foreach ($rowsCategory as $category) { ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['category'] ?></option>
            <?php } ?>
        </select>

        <label for="price">Цена</label>
        <input type="text" id="price" name="price" placeholder="Цена" class="form-control" required>

        <label for="picture">Фото</label>
        <input type="file" id="picture" name="picture" class="form-control" required>

        <label for="description">Описание</label>
        <textarea id="description" name="description" placeholder="Описание товара" class="form-control"
                  required></textarea>

        <input type="submit" class="btn btn-success" value="добавить продукт" name="save">
    </form>
    </div>
<?php } ?>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';
