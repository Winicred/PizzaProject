<?php
ob_start();
$titel = "Новости";
?>

    <section class="templatemo-section ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-uppercase text-center">Новости</h2>
                    <hr>
                </div>
                <div class="nrow">
                    <?php foreach ($news as $newsList) { ?>
                        <div class="article">
                            <figure class="article-image">
                                <a href="newsDetail?id=<?php echo $newsList['id'] ?>">
                                    <img src="public/images/<?php echo $newsList['picture'] ?>">
                                </a>
                            </figure>
                            <div class="article-body">
                                <h2 class="article-title"
                                    style="color: white; margin-left: 10px; margin-right: 10px">
                                    <?php echo $newsList['title'] ?>
                                </h2>
                                <div class="article-info">
                                    <a href="newsDetail?id=<?php echo $newsList['id'] ?>"> Подробнее &#187 </a>
                                </div>
                            </div>

                        </div>
                    <?php } ?>

                    <div style="clear:both;"></div>
                    <div class="right"><h4>Количество записей: <?php echo count($news); ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>

        .article {
            width: 100%;
            display: flex;
            flex-direction: column;
            flex-basis: auto; /* Устанавливает начальный размер элемента в зависимости от его содержимого */
            background-color: #3c3c3c;
            padding: 20px 0 0 0;
            margin: 40px 0;
        }

        .article-body {
            display: flex;
            flex: 1;
            flex-direction: column;
        }

        .article-info {
            padding: 20px 10px;
            text-align: center;
            background-color: #202020;
        }

        .article-info a {
            font-size: 25px;
            color: white;
        }

        .article-info a:hover {
            color: lightgray;
        }

        .nested-column {
            flex: 2;
        }

        .article-content {
            flex: 1; /* Содержимое заполняет все оставшееся место, тем самым прижимая информационную панель к нижней части */
        }

        .article-image a {
            display: flex;
            justify-content: center
        }
    </style>


<?php
$content = ob_get_clean();
include_once("view/templates/layout.php");

