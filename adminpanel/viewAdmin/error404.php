<?php
ob_start();
?>
    <div style="padding: 30px 0; width: 50%; margin: 0 auto">
        <div class="text-center" style="font-size: 150px; color: red">
            <i class="fas fa-exclamation-triangle"></i>
        </div>

        <h4 class="box-title text-center">404 ошибка</h4>
        <p class="text-primary text-center">Упс, что-то пошло не так. Страница не найдена</p>
    </div>

<?php
$content = ob_get_clean();
include_once "viewAdmin/templates/layout.php";
?>