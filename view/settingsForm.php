<?php
ob_start();
$titel = "Настройки";
?>

    <div class="container" style="min-height: 400px">
        <h4 class="box-title">Профиль</h4>

        <div class="col-sm-12">
            <div class="col-sm-6">
                <h4>Имя: </h4>
                <h4>Э-майл: </h4>
                <h4>Пароль: </h4>
                <h4>Фото: </h4>
            </div>

            <div class="col-sm-6">
                <h4><?php echo $_SESSION['name'] ?></h4>
                <h4><?php echo $_SESSION['email'] ?></h4>
                <h4>******</h4>
                <h4>
                    <img src="public/images/<?php echo $_SESSION['picture'] ?>" class="thumbnail" style="width: 100px"
                         alt="">
                </h4>
            </div>
        </div>

        <div class="row" id="answer">
            <?php
            if (isset($result)) {
                echo '<hr>';
                if ($result[0] == true) {
                    echo '<p style="color: green" class="text-center">' . $result[1] . '</p>';
                } elseif (!$result[0]) {
                    echo '<p style="color: red" class="text-center">' . $result[1] . '</p>';
                }
            }
            ?>
        </div>

        <div class="row" style="display: flex; justify-content: center">
            <div class="col-sm-3" id="myLink">
                <a class="btn btn-link btn-small" id="edit" style="cursor: pointer">
                    <i class="fas fa-key"></i>
                    Изменить пароль
                </a>
            </div>

            <div class="col-sm-3" id="myData">
                <a class="btn btn-link btn-small" id="editdatabtn" style="cursor: pointer">
                    <i class="fas fa-database"></i>
                    Изменить данные
                </a>
            </div>
        </div>

        <div class="row" id="editpass" style="display: none">
            <div class="col-sm-6 col-sm-offset-2">
                <form action="profileEditResult" method="POST">
                    <div class="modal-header">
                        <h3>Изменить пароль <span class="extra-title muted"></span></h3>
                    </div>

                    <div class="modal-body form-horizontal">
                        <div class="control-group">
                            <label for="current_password" class="control-label">Текущий пароль</label>
                            <input type="password" class="form-control" name="currentPassword" required>
                        </div>
                        <div class="control-group">
                            <label for="new_password" class="control-label">Новый пароль</label>
                            <input type="password" class="form-control" name="newPassword" required>
                        </div>
                        <div class="control-group">
                            <label for="confirm_password" class="control-label">Подтверждение пароля</label>
                            <input type="password" class="form-control" name="confirmPassword" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="settings" class="btn btn-default">Закрыть</a>
                        <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row" id="editdata" style="display: none">
            <div class="col-sm-6 col-sm-offset-2">
                <form action="profileEditDataResult" method="POST">
                    <div class="modal-header">
                        <h3>Change data <span class="extra-title muted"></span></h3>
                    </div>

                    <div class="modal-body form-horizontal">
                        <div class="control-group">
                            <label for="username" class="control-label">Логин</label>
                            <input id="username" type="text" class="form-control" name="username"
                                   value="<?php echo $_SESSION['name'] ?>" required>
                        </div>

                        <div class="control-group">
                            <label for="email" class="control-label">Э-майл</label>
                            <input id="email" type="email" class="form-control" name="email"
                                   value="<?php echo $_SESSION['email'] ?>" required>
                        </div>

                        <div class="control-group">
                            <label for="picture" class="control-label">Фото</label>
                            <input id="picture" type="file" class="form-control" name="picture">
                            <img src="public/images/<?php echo $_SESSION['picture'] ?>" class="thumbnail"
                                 style="width: 100px; margin: 10px 0 0 0; display: block" alt="">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="settings" class="btn btn-default">Закрыть</a>
                        <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../public/js/jquery.min.js"></script>
    <script>
        $('#edit').click(function () {
            $('#editpass').show();
            $('#editdata').hide();
        });

        $('#editdatabtn').click(function () {
            $('#editdata').show();
            $('#editpass').hide();
        });
    </script>

<?php
$content = ob_get_clean();
include_once("view/templates/layout.php");

