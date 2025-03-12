<?php

/**
 * @var $modalConfig []
 * @var $toastPosition string
 */

use yii\bootstrap5\Modal;

Modal::begin($modalConfig);
    echo '<div class="modal-edit-content"></div>';
Modal::end();
?>

<div class="<?= $toastPosition; ?>" style="z-index: 11">
    <div id="modalToast" class="toast hide text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
        </div>
    </div>
</div>
