<?php
ob_start();
?>

    <div class="col-sx-9">
        <h4 class="box-title">Удалить новость</h4>
        <p>Дата удаления новости: <?php echo date("d-m-Y") ?></p>

        <?php
        if (isset($result)) {
            if ($result) {
                ?>
                <div class="alert alert-info">
                    <strong>Запись удалена. </strong>
                    <a href="newsAction">Список новостей</a>
                </div>
            <?php } elseif ($result == false) { ?>
                <div class="alert alert-warning">
                    <strong>Ошибка удаления записи! </strong>
                    <a href="newsAction">Список новостей</a>
                </div>
            <?php }
        } else { ?>
            <form action="deleteNewsResult?id=<?php echo $item['id'] ?>" method="POST"
                  enctype="multipart/form-data">
                <label for="name">Заголовок</label>
                <input id="name" type="text" name="name" placeholder="Заголовок" class="form-control"
                       value="<?php echo $item['title'] ?>" readonly>

                <label for="text">Описание новости</label>
                <textarea name="text" id="text" placeholder="Описание новости" class="form-control"
                          readonly><?php echo $item['text'] ?></textarea>

                <label for="oldPhoto">Фото</label>
                <input id="oldPhoto" type="text" name="oldpicture" class="form-control"
                       value="<?php echo $item['picture'] ?>" readonly>
                <img src="../public/images/<?php echo $item['picture'] ?>" alt="" class="thumbnail" width="150px">

                <input type="submit" class="btn btn-success" value="удалить новость" name="save">
            </form>
        <?php } ?>
    </div>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


