<?php
ob_start();
$titel = "404 ошибка";
?>
    <div class="center" style="height: 500px;">
        <img src="public/images/404.png">
    </div>

<?php
$content = ob_get_clean();
include_once "view/templates/layout.php";
?>