<?php
ob_start();
?>

    <div class="col-sx-9">
        <h4 class="box-title">Удалить пользователя</h4>
        <p>Дата удаления пользователя: <?php echo date("d-m-Y") ?></p>

        <?php
        if (isset($result)) {
            if ($result) {
                ?>
                <div class="alert alert-info">
                    <strong>Запись удалена. </strong>
                    <a href="usersAction">Список пользователей</a>
                </div>
            <?php } elseif ($result == false) { ?>
                <div class="alert alert-warning">
                    <strong>Ошибка удаления записи! </strong>
                    <a href="usersAction">Список пользователей</a>
                </div>
            <?php }
        } else { ?>
            <form action="deleteUserResult?id=<?php echo $user['id'] ?>" method="POST"
                  enctype="multipart/form-data">
                <label for="username">Логин</label>
                <input id="username" type="text" class="form-control"
                       value="<?php echo $user['username'] ?>" readonly>

                <label for="email">Э-майл</label>
                <input id="email" type="email" class="form-control"
                       value="<?php echo $user['epost'] ?>" readonly>

                <label for="photo">Фото</label>
                <input id="photo" type="text" class="form-control"
                       value="<?php echo $user['picture'] ?>" readonly>
                <img src="../public/images/<?php echo $user['picture'] ?>" alt="" class="thumbnail" width="150px">

                <label for="role">Роль</label>
                <input id="role" type="text" class="form-control" value="<?php echo $user['role'] ?>" readonly>

                <input type="submit" class="btn btn-success" value="Delete user" name="save">
            </form>
        <?php } ?>
    </div>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


