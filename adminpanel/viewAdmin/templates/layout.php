<?php
if ($_SESSION['role'] != 'admin') {
    header('Location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Pizza Hut - dashboard</title>
    <!-- Main Styles -->
    <link rel="stylesheet" href="assets/styles/style.css">
</head>
<body>
<div class="main-menu">
    <header class="header">
        <a href="../" class="logo">Pizza Hut</a>
        <div class="user">
            <h5 class="name"><?php echo $_SESSION['name'] ?> - <a href="../logout" class="btn-link btn-md">Выйти</a>
            </h5>
        </div>
        <!-- /.user -->
    </header>
    <!-- /.header -->
    <div class="content">
        <div class="navigation">
            <h5 class="title">Pizza Hut</h5>
            <!-- /.title -->
            <ul class="menu js__accordion">
                <li><a class="waves-effect" href="dashboard"><span>Управление главной страницей</span></a></li>
                <li><a class="waves-effect" href="productAction"><span>Продукты</span></a></li>
                <li><a class="waves-effect" href="categoryAction"><span>Категории</span></a></li>
                <li><a class="waves-effect" href="newsAction"><span>Новости</span></a></li>
                <li><a class="waves-effect" href="usersAction"><span>Пользователи</span></a></li>
                <li><a class="waves-effect" href="commentsAction"><span>Комментарии</span></a></li>
                <li><a class="waves-effect" href="reviewsAction"><span>Отзывы</span></a></li>
                <li><a class="waves-effect" href="../"><span>Вернуться на главную страницу</span></a></li>
            </ul>
            <!-- /.menu js__accordion -->
            <footer class="footer"><p>&copy; 2021 Dashboard Admin panel</p></footer>
        </div>
        <!-- /.navigation -->
    </div>
    <!-- /.content -->
</div>
<div class="fixed-navbar">
    <div class="pull-left">
        <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
        <h1 class="page-title">Админ-панель</h1>
        <!-- /.page-title -->
    </div>
</div>
<!-- /.fixed-navbar -->
<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-12">
                <div class="box-content">
                    <div class="min-height-300">
                        <!--content  CODE-->
                        <?php if (isset($content)) echo $content; ?>
                        <!--end content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.main-content -->
</div><!--/#wrapper -->
<!-- ================================================== -->
<script src="assets/scripts/jquery.min.js"></script>
<script src="assets/plugin/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugin/nprogress/nprogress.js"></script>
<script src="assets/scripts/main.min.js"></script>
</body>
</html>