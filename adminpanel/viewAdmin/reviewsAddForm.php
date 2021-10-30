<?php
ob_start();
?>

    <div class="col-xs-9">
    <h4 class="box-title">Добавить отзыв</h4>
    <p>Сегодня: <?php echo date('d-m-Y') ?></p>

<?php
if (isset($result)) {
    if ($result == true) { ?>

        <div class="alert alert-info">
            <strong>Запись добавлена. </strong>
            <a href="reviewsAction">Список отзывов</a>
        </div>

    <?php } elseif ($result == false) { ?>
        <div class="alert alert-warning">
            <strong>Ошибка добавления записи! </strong>
            <a href="reviewsAction">Список отзывов</a>
        </div>
    <?php }
} else { ?>
    <form action="addReviewResult" method="POST" enctype="multipart/form-data">
        <label for="text">Текст отзыва *</label>
        <input type="text" id="text" name="text"
               placeholder="Отзыв..." class="form-control" required>

        <label for="rating" style="margin-top: 15px">Рейтинг товара *</label>
        <select name="rating" id="rating" class="form-control" required>
            <option value="1" selected>1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="likeCount" style="margin-top: 15px">Количество лайков</label>
        <input type="number" id="likeCount" name="likeCount" class="form-control" value="0"
                min="0">

        <label for="dislikeCount" style="margin-top: 15px">Количество дизайков</label>
        <input type="number" id="dislikeCount" name="dislikeCount" class="form-control" min="0" value="0">

        <label for="productId" style="margin-top: 15px">Продукт *</label>
        <select name="productId" id="productId" class="form-control">
            <?php foreach ($rowsProduct as $product) { ?>
                <option value="<?php echo $product['id'] ?>"><?php echo $product['id'] ?>. <?php echo $product['name'] ?></option>
            <?php } ?>
        </select>

        <label for="userId" style="margin-top: 15px">Пользователь *</label>
        <select name="userId" id="userId" class="form-control">
            <?php foreach ($rowsUsers as $user) { ?>
                <option value="<?php echo $user['id'] ?>"><?php echo $user['id'] ?>. <?php echo $user['username'] ?></option>
            <?php } ?>
        </select>

        <input type="submit" class="btn btn-success" value="добавить отзыв" name="save">
    </form>
    </div>
<?php } ?>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';
