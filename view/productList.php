<?php
ob_start();
$titel = "Наша продукция";
if (isset($category['category'])) {
    $titel .= " - пицца " . $category['category'];
}
?>
    <div class="col-md-12">
        <h2 class="text-uppercase text-center">Наша продукция</h2>
        <hr>
    </div>
    <!-- список категорий -->
    <div class="col-md-12">
        <div class="line" style="margin-left: auto; margin-right: auto;text-align:center;">
            <ul class="text-center meny" style="margin: 0; padding: 0; vertical-align: center; display: inline-block;">
                <li class="meny">
                    <a href="product?id=0">All</a>
                </li>
                <?php foreach ($categories as $category) { ?>
                    <span> | </span>
                    <li class="meny">
                        <a href="product?id=<?php echo $category['id'] ?>"><?php echo $category['category'] ?></a>
                    </li>
                <?php } ?>
            </ul>
            <hr>
        </div>
    </div>

    <div class="row" style="display: flex; justify-content: center;">
        <form method="POST" action="sortProductsBy" style="border: none; width: 50%">
            <select name="sortProductsByMethod" class="form-control" onchange="this.form.submit()">
                <option hidden>Сортировать по:</option>
                <option value="0">По умолчанию</option>
                <option value="1">Названию (по возрастанию)</option>
                <option value="2">Названию (по убыванию)</option>
                <option value="3">Цене (по возрастанию)</option>
                <option value="4">Цене (по убыванию)</option>
                <option value="5">Рейтингу (по возрастанию)</option>
                <option value="6">Рейтингу (по убыванию)</option>
            </select>
        </form>
    </div>

    <hr>

    <div style="display:flex; width: 100%; flex-wrap: wrap;">
        <?php foreach ($productList as $product) { ?>
            <div class="productBody">
                <div class="pictureBody">
                    <img src="public/images/<?php echo $product['photo'] ?>" style="width: 100%; margin: auto">

                    <div class="rating">
                        <?php if (isset($_SESSION['userId'])) { ?>
                            <div class="ratingSelect">
                                <form method="POST" action="rateProduct?id=<?php echo $product['id'] ?>"
                                      style="border: none">
                                    <label for="ratingSelect">Оцените товар:</label>
                                    <select name="rating" id="ratingSelect" class="form-control"
                                            onchange="this.form.submit()">
                                        <option hidden>Рейтинг:</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </form>
                            </div>
                        <?php } ?>

                        <div class="ratingStart" style="margin: 0 auto">
                            <i class="fas fa-star" style="color: #FFD700"></i>
                            <b title="Рейтинг товара: <?php echo $product['name'] ?>"
                               style="margin-left: 2px"><?php echo round($product['rating'], 2) ?></b>
                        </div>
                    </div>
                </div>
                <div class="productTextBody">
                    <div style="display: flex; justify-content: space-between">
                        <h4 style="color: white; margin-bottom: 15px"><?php echo $product['name'] ?></h4>
                        <h4 style="color: white; margin-bottom: 15px"><?php echo $product['price'] ?>€</h4>
                    </div>
                    <div class="productButtonField">
                        <a href="productDetail?id=<?php echo $product['id'] ?>" class="productButton">Подробнее
                            <i class="fas fa-info-circle"></i>
                        </a>

                        <a href="cart?id=<?php echo $product['id'] ?>" class="productButton">В корзину
                            <i class="fas fa-cart-arrow-down"></i>
                            <?php if (isset($_SESSION['products'])) {
                                if (array_key_exists(intval($product['id']), $productsInCart)) { ?>
                                    <span class="badge"
                                          style="background-color: #ffa400;"><?php echo $productsInCart[$product['id']] ?></span>
                                <?php }
                            } ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div style="clear:both"></div>
    <div class="right">
        <h4>Количество записей: <?php echo count($productList); ?></h4>
    </div>

    <style>
        .productBody {
            border: 1px solid lightgray;
            text-align: center;
            display: flex;
            flex-direction: column;
            min-width: 150px;
            max-width: 275px;
            min-height: 275px;
            margin: 23px;
        }

        .pictureBody {
            max-width: 300px;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .rating {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 15px;
        }

        .ratingSelect {
            display: flex;
            flex-direction: column;
        }

        .ratingSelect select {
            margin: 0;
        }

        .productTextBody {
            background-color: #ffa400;
            width: 100%;
            text-align: left;
            padding: 9px;
        }

        .productButtonField {
            display: flex;
            justify-content: space-between;
        }

        .productButton {
            padding: 10px;
            background-color: white;
            border-radius: 5px;
            color: #ffa400;
            transition: all 0.3s;
        }

        .productButton:hover {
            background-color: #fff6ea;
            color: #ffa400;
        }
    </style>

<?php
$content = ob_get_clean();
include "view/templates/layout.php";
?>