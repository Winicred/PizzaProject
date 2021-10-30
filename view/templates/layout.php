<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title><?php echo $titel ?></title>

    <!-- bootstrap -->
    <!-- CSS only -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="public/css/font-awesome.min.css">
    <!-- custom -->
    <link rel="stylesheet" href="public/css/templatemo-style.css">
    <link href="public/css/main.css" rel="stylesheet">
    <link href="public/css/mystyle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />

    <script src="public/js/jquery-3.3.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/js/star-rating.js" type="text/javascript"></script>

</head>

<body>
<div class="wrapper">
    <div class="push">
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a href="home" class="navbar-brand"><strong>PIZZA HUT</strong></a>
                </div>
                <ul class="mynav nav navbar-nav navbar-right">
                    <li><a href="cartList"><i class="fas fa-shopping-cart"></i> Корзина
                            (<?php echo ModelCart::countItems() ?>)</a></li>
                    <?php if (isset($_SESSION['userId'])) { ?>
                        <li>
                            <a href="settings">
                                <i class="fas fa-cog"></i> Настройки
                            </a>
                        </li>
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <li><a href="adminpanel/dashboard"><i class="fas fa-tools"></i> Админ-панель</a></li>
                        <?php } ?>
                        <li>
                            <a href="logout">
                                <i class="fas fa-sign-out-alt"></i>
                                Выйти
                                <img style="width: 30px" src="public/images/<?php echo $_SESSION['picture'] ?>" alt="">
                            </a>
                        </li>
                    <?php } else { ?>
                        <li><a href="login"><i class="fas fa-sign-in-alt"></i> Логин</a></li>
                    <?php } ?>
                </ul>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right tnav">
                        <li><a href="home">ГЛАВНАЯ</a></li>
                        <li><a href="product?id=0">ПИЦЦА</a></li>
                        <li><a href="news">НОВОСТИ</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <section class="templatemo-section ">
            <div class="container" id="container">
                <div class="row" style="margin: 50px 0 150px 0">
                    <?php
                    if (isset($content)) echo $content;
                    ?>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <div style="margin: 0 auto">
            <p>Copyright &copy; 2021 PIZZA HUT</p>
            <hr>
        </div>
    </footer>
</div>

<script src="public/js/jquery.js"></script>
<script src="public/js/bootstrap.js"></script>
<script src="public/js/jquery.scrollUp.min.js"></script>
<script src="public/js/main.js"></script>

</body>
</html>
