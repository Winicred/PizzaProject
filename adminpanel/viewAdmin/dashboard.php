<?php
ob_start();
?>
    <h4 class="box-title">Управление страницей</h4>
    <p class="text-primary">Добро пожаловать в админ панель</p>
<?php
$content = ob_get_clean();
include 'viewAdmin/templates/layout.php';

