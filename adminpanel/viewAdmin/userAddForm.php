<?php
ob_start();
?>

    <div class="col-xs-9">
    <h4 class="box-title">Добавить пользователя</h4>
    <p>Сегодня: <?php echo date('d-m-Y') ?></p>

<?php
if (isset($result)) {
    if ($result == true) { ?>

        <div class="alert alert-info">
            <strong>Запись добавлена. </strong>
            <a href="usersAction">Список пользователей</a>
        </div>

    <?php } elseif ($result == false) { ?>
        <div class="alert alert-warning">
            <strong>Ошибка добавления записи! </strong>
            <a href="usersAction">Список пользователей</a>
        </div>
    <?php }
} else { ?>

    <form action="addUserResult" method="POST" enctype="multipart/form-data">
        <label for="username">Логин *</label>
        <input id="username" type="text" name="username" placeholder="Логин" class="form-control" required>

        <label for="password">Пароль *</label>
        <input id="password" type="password" name="password" placeholder="Пароль" class="form-control" required>

        <label for="email">Э-майл *</label>
        <input id="email" type="text" name="email" placeholder="Э-майл" class="form-control" required>

        <label for="photo">Фото</label>
        <input id="photo" type="file" name="picture" class="form-control">

        <label for="role">Роль *</label>
        <select name="role" id="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="client">Client</option>
        </select>

        <input type="submit" class="btn btn-success" value="добавить пользователя" name="save">
    </form>
    </div>
<?php } ?>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';
