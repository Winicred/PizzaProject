<?php
ob_start();
?>

    <div class="col-sx-9">
        <h4 class="box-title">Редактировать товар</h4>
        <p>Дата редактирования товара: <?php echo date("d-m-Y") ?></p>

        <?php
        if (isset($result)) {
            if ($result) {
                ?>
                <div class="alert alert-info">
                    <strong>Запись изменена. </strong>
                    <a href="productAction">Список продукции</a>
                </div>
            <?php } elseif ($result == false) { ?>
                <div class="alert alert-warning">
                    <strong>Ошибка изменения записи! </strong>
                    <a href="productAction">Список продукции</a>
                </div>
            <?php }
        } else { ?>
            <form action="editProductResult?id=<?php echo $product['id'] ?>" method="POST"
                  enctype="multipart/form-data">
                <label for="name">Название *</label>
                <input id="name" type="text" name="name" placeholder="Название" class="form-control"
                       value="<?php echo $product['name'] ?>" required>

                <label for="category">Категория *</label>
                <select name="category" id="category" class="form-control">
                    <?php foreach ($rowsCategory as $category) { ?>
                        <option value="<?php echo $category['id'] ?> <?php if ($category['id'] == $product['idCategory']) echo 'selected' ?>">
                            <?php echo $category['category'] ?>
                        </option>
                    <?php } ?>
                </select>

                <label for="price">Цена *</label>
                <input id="price" type="text" name="price" placeholder="Цена" class="form-control"
                       value="<?php echo $product['price'] ?>" required>

                <label for="oldPhoto">Старое фото</label>
                <input id="oldPhoto" type="text" name="oldpicture" class="form-control"
                       value="<?php echo $product['photo'] ?>" readonly>
                <img src="../public/images/<?php echo $product['photo'] ?>" alt="" class="thumbnail" width="150px">

                <label for="photo">
                    Фото<i>(если необходимо, сделайте выбор нового фото)</i>
                </label>
                <input id="photo" type="file" name="picture" class="form-control">

                <label for="text">Описание пиццы *</label>
                <textarea name="description" id="text" placeholder="Описание пиццы" class="form-control"
                          required><?php echo $product['description'] ?></textarea>

                <input type="submit" class="btn btn-success" value="изменить продукт" name="save">
            </form>
        <?php } ?>
    </div>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


