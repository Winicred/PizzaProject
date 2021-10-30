<?php
ob_start();
$titel = "Регистрация";
?>

    <div id="wrapper">
        <div class="login-content">
            <div class="row small-spacing">
                <div class="col-xs-12">
                    <div class="box-content">
                        <div class="login-form"><!--login form-->
                            <h3>Регистрация </h3>
                            <form action="registrationResult" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Логин *</label>
                                    <input class="form-control" type="text" name="login" placeholder="Логин"
                                           required/>
                                </div>

                                <div class="form-group">
                                    <label>Э-майл *</label>
                                    <input class="form-control" type="email" name="email" placeholder="Э-майл"
                                           required/>
                                </div>

                                <div class="form-group">
                                    <label>Пароль *</label>
                                    <input class="form-control" type="password" name="password" placeholder="Пароль"
                                           required/>
                                </div>

                                <div class="form-group">
                                    <label>Фото профиля</label>
                                    <input class="form-control" type="file" name="picture"/>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Зарегистрироваться
                                    </button>

                                    <a class="btn btn-default" href="login">
                                        Войти
                                    </a>
                                </div>
                            </form>
                        </div><!--/login form-->
                    </div>
                </div>
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<p>' . $_SESSION['error'] . '</p>';
                    unset($_SESSION['error']);
                }
                ?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.main-content -->
    </div><!--/#wrapper -->

<?php
$content = ob_get_clean();
include_once("view/templates/layout.php");

