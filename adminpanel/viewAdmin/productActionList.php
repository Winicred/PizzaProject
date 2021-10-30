<?php
ob_start();
?>

    <h4 class="box-title">Список управления товарами</h4>
    <button class="btn btn-success btn-sm">
        <a href="addProduct" style="color: white">добавление продуктов</a>
    </button>

    <table class="table table-striped">
        <thead>
        <tr class="d-flex">
            <th style="width: 5%">#</th>
            <th style="width: 25%">Нзвание</th>
            <th style="width: 20%">Категория</th>
            <th style="width: 20%">Цена</th>
            <th style="width: 20%">Фото</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['category'] ?></td>
                <td><?php echo $row['price'] ?></td>
                <td>
                    <img src="../public/images/<?php echo $row['photo'] ?>" alt="" style="width: 100px">
                </td>
                <td>
                    <a class="btn btn-warning btn-sm btn-block" href="editProduct?id=<?php echo $row['id'] ?>"
                       style="color: white">изменить</a>

                    <a class="btn btn-danger btn-sm btn-block" href="deleteProduct?id=<?php echo $row['id'] ?>"
                       style="color: white">удалить</a>
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


