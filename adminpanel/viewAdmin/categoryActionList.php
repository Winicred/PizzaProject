<?php
ob_start();
?>

    <h4 class="box-title">Управление списком категорий</h4>
    <a class="btn btn-success btn-sm" href="addCategory" style="color: white">добавить категорию</a>

    <table class="table table-striped">
        <thead>
        <tr class="d-flex">
            <th>#</th>
            <th>Имя</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['category'] ?></td>
                <td style="width: 7%">
                    <a class="btn btn-warning btn-sm btn-block" href="editCategory?id=<?php echo $row['id'] ?>"
                       style="color: white">изменить</a>

                    <a class="btn btn-danger btn-sm btn-block" href="deleteCategory?id=<?php echo $row['id'] ?>"
                       style="color: white">удалить</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

        <tfoot>
        <tr>
            <td></td>
            <td><b>Всего наименований: <?php echo count($rows) ?></b></td>
        </tr>
        </tfoot>
    </table>

<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';


