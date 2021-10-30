<?php
ob_start();
?>

<?php
if (isset($result)) {
    if ($result == true) { ?>

        <div class="alert alert-info">
            <strong>Запись удалена. </strong>
            <a href="reviewsAction">Список отзывов</a>
        </div>

    <?php } elseif ($result == false) { ?>
        <div class="alert alert-warning">
            <strong>Ошибка удаления записи! </strong>
            <a href="reviewsAction">Список отзывов</a>
        </div>
    <?php }
} else { ?>
    <form action="deleteReviewResult?id=<?php echo $review['id'] ?>" method="POST">
        <label for="text">Текст отзыва *</label>
        <input type="text" id="text" name="text"
               placeholder="Отзыв..." class="form-control" value="<?php echo $review['text'] ?>" readonly>

        <label for="rating" style="margin-top: 15px">Рейтинг товара</label>
        <select name="rating" id="rating" class="form-control" disabled>
            <option><?php echo $review['rating'] ?></option>
        </select>

        <label for="likeCount" style="margin-top: 15px">Количество лайков</label>
        <input type="number" id="likeCount" name="likeCount" class="form-control"
               value="<?php echo $review['likeCount'] ?>" readonly
               min="0">

        <label for="dislikeCount" style="margin-top: 15px">Количество дизайков</label>
        <input type="number" id="dislikeCount" name="dislikeCount" class="form-control" min="0"
               value="<?php echo $review['dislikeCount'] ?>" readonly>

        <label for="productId" style="margin-top: 15px">Продукт</label>
        <select name="productId" id="productId" class="form-control" disabled>
            <?php foreach ($rowsProduct as $product) { ?>
                <option <?php if ($review['product_id'] == $product['id']) echo "selected"; ?>
                        value="<?php echo $product['id'] ?>"><?php echo $product['id'] ?>
                    . <?php echo $product['name'] ?></option>
            <?php } ?>
        </select>

        <label for="userId" style="margin-top: 15px">Пользователь</label>
        <select name="userId" id="userId" class="form-control" disabled>
            <?php foreach ($rowsUsers as $user) { ?>
                <option <?php if ($review['product_id'] == $user['id']) echo "selected"; ?>
                        value="<?php echo $user['id'] ?>"><?php echo $user['id'] ?>
                    . <?php echo $user['username'] ?></option>
            <?php } ?>
        </select>

        <input type="submit" class="btn btn-success" value="удалить отзыв" name="save">
    </form>
    </div>
<?php } ?>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


