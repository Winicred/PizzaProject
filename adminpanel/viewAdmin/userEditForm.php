<?php
ob_start();
?>

    <div class="col-sx-9">
        <h4 class="box-title">Редактировать пользователя</h4>
        <p>Дата изменения пользователя: <?php echo date("d-m-Y") ?></p>

        <?php
        if (isset($result)) {
            if ($result) {
                ?>
                <div class="alert alert-info">
                    <strong>Запись изменена. </strong>
                    <a href="usersAction">Список польователей</a>
                </div>
            <?php } elseif ($result == false) { ?>
                <div class="alert alert-warning">
                    <strong>Ошибка изменения записи! </strong>
                    <a href="usersAction">Список польователей</a>
                </div>
            <?php }
        } else { ?>
            <form action="editUserResult?id=<?php echo $user['id'] ?>" method="POST"
                  enctype="multipart/form-data">
                <label for="username">Логин *</label>
                <input id="username" type="text" name="username" placeholder="Логин" class="form-control"
                       value="<?php echo $user['username'] ?>" required>

                <label for="password">Пароль *</label>
                <input id="password" type="password" name="password" placeholder="Пароль" class="form-control"
                       required>

                <label for="email">Э-майл *</label>
                <input id="email" type="text" name="email" placeholder="Э-майл" class="form-control"
                       value="<?php echo $user['epost'] ?>" required>

                <label for="oldPhoto">Старое фото</label>
                <input id="oldPhoto" type="text" name="oldpicture" placeholder="Старое фото" class="form-control"
                       value="<?php echo $user['picture'] ?>" readonly>
                <img src="../public/images/<?php echo $user['picture'] ?>" alt="" class="thumbnail" width="150px">

                <label for="photo">
                    Фото<i>(если необходимо, сделайте выбор нового фото)</i>
                </label>
                <input id="photo" type="file" name="picture" class="form-control">

                <label for="role">Роль *</label>
                <select name="role" id="role" class="form-control">
                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected' ?>>Admin</option>
                    <option value="client" <?php if ($user['role'] == 'client') echo 'selected' ?>>Client</option>
                </select>

                <input type="submit" class="btn btn-success" value="изменить пользователя" name="save">
            </form>
        <?php } ?>
    </div>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


