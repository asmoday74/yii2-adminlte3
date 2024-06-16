<?php

use yii\bootstrap5\Modal;

Modal::begin([
    'id' => 'modal-edit',
    'title' => '',
    'footer' => '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
        <button id="modal-submit" type="button" class="btn btn-primary">Сохранить</button>',
    'size' => Modal::SIZE_EXTRA_LARGE,
]);
echo '<div class="modal-edit-content"></div>';
Modal::end();

?>

<div class="position-fixed bottom-0 start-0 p-3" style="z-index: 11">
    <div id="modalToast" class="toast hide text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
        </div>
    </div>
</div>
