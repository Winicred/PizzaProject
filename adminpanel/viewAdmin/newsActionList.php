<?php
ob_start();
?>

    <h4 class="box-title">Управление списком новостей</h4>
    <button class="btn btn-success btn-sm">
        <a href="addNews" style="color: white">добавить новость</a>
    </button>

    <table class="table table-striped">
        <thead class="d-flex">
        <tr>
            <th style="width: 5%">#</th>
            <th style="width: 25%">Заголовок</th>
            <th style="width: 20%">Текст</th>
            <th style="width: 20%">Фото</th>
            <th style="width: 20%">Дата</th>
            <th style="width: 10%">ID пользователя</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['title'] ?></td>
                <td><a href="../newsDetail?id=<?php echo $row['id'] ?>">Просмотреть новость</a></td>
                <td>
                    <img src="../public/images/<?php echo $row['picture'] ?>" alt="" style="width: 100px">
                </td>
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['idUser'] ?>
                </td>
                <td>
                    <a class="btn btn-warning btn-sm btn-block" href="editNews?id=<?php echo $row['id'] ?>"
                       style="color: white">изменить</a>

                    <a class="btn btn-danger btn-sm btn-block" href="deleteNews?id=<?php echo $row['id'] ?>"
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


