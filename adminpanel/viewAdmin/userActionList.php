<?php
ob_start();
?>

    <h4 class="box-title">Управление списком пользователей</h4>
    <button class="btn btn-success btn-sm">
        <a href="addUser" style="color: white">добавить пользователя</a>
    </button>

    <table class="table table-striped">
        <thead>
        <tr class="d-flex">
            <th style="width: 5%">#</th>
            <th style="width: 25%">Логин</th>
            <th style="width: 20%">Э-майл</th>
            <th style="width: 20%">Роль</th>
            <th style="width: 20%">Фото</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['epost'] ?></td>
                <td><?php echo $row['role'] ?></td>
                <td>
                    <img src="../public/images/<?php echo $row['picture'] ?>" alt="" style="width: 100px">
                </td>
                <td>
                    <a class="btn btn-warning btn-sm btn-block" href="editUser?id=<?php echo $row['id'] ?>"
                       style="color: white" <?php if ($row['role'] == 'admin') echo 'disabled' ?>>изменить</a>

                    <a class="btn btn-danger btn-sm btn-block" href="deleteUser?id=<?php echo $row['id'] ?>"
                       style="color: white" <?php if ($row['role'] == 'admin') echo 'disabled' ?>>удалить</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

        <tfoot>
        <tr>
            <td colspan="4"></td>
            <td><b>Всего наименований:</b></td>
            <td><b><?php echo count($rows) ?></b></td>
        </tr>
        </tfoot>
    </table>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


