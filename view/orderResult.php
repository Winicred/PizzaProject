<?php
ob_start();
$titel = "Оплата товара(ов)";
?>

    <div class="center" style="height:500px;">
        <?php if (isset($sendResult) && $sendResult == true) { ?>
            <h2>Ваш заказ принят!</h2>
        <?php } else { ?>
            <h3>Сообщение об ошибке</h3>
            <p><b>Заполните корректно форму заказа</b></p>
        <?php } ?>
        <div>
            <br>
            <a href="product?id=0">К списку продукции &#187 </a>
        </div>
    </div>

<?php
$content = ob_get_clean();
include "view/templates/layout.php";
?>