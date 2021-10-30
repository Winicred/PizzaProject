<?php
ob_start();
$titel = "Вход";
?>

    <div id="wrapper">
        <div class="login-content">
            <div class="row small-spacing">
                <div class="col-xs-12">
                    <div class="box-content">
                        <div class="login-form"><!--login form-->
                            <h3>Вход в аккаунт</h3>
                            <?php
                            if (isset($_SESSION['error'])) {
                                echo '<p class="text-center">' . $_SESSION['error'] . '</p>';
                                unset($_SESSION['error']);
                            }
                            ?>
                            <form action="loginResult" method="POST">
                                <div class="form-group">
                                    <label>Э-майл</label>
                                    <input class="form-control" type="email" name="email" placeholder="Э-майл"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <label>Пароль</label>
                                    <input class="form-control" type="password" name="password" placeholder="Пароль"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" name="login">
                                        Войти
                                    </button>
                                    <a class="btn btn-default" href="registration">
                                        Зарегистрироваться
                                    </a>
                                </div>
                            </form>
                        </div><!--/login form-->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.main-content -->
    </div><!--/#wrapper -->

<?php
$content = ob_get_clean();
include_once("view/templates/layout.php");

