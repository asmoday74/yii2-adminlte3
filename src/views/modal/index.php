<?php

/**
 * @var $modalConfig []
 * @var $toastPosition string
 */

use yii\bootstrap5\Modal;

Modal::begin($modalConfig);
?>
<div class="modal-spinner">
    <div class="spinner-border m-auto" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div class="modal-edit-content"></div>
<?php
Modal::end();
?>

<div class="<?= $toastPosition; ?>" style="z-index: 11">
    <div id="modalToast" class="toast hide text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
        </div>
    </div>
</div>
