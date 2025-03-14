<?php

namespace asmoday74\adminlte3\controllers;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\bootstrap5\Modal;

/**
 * Default controller for the `backend` module
 */
class ModalController extends Controller
{
    /**
     * Renders the modal window for the edit form
     * @return string
     */
    public function actionIndex()
    {
        $data = \Yii::$app->request->post();
        $modalSize = ArrayHelper::getValue($data, 'size', Modal::SIZE_EXTRA_LARGE);
        $modalTitle = ArrayHelper::getValue($data, 'title', '');
        $cancelName = ArrayHelper::getValue($data, 'cancel', false);
        $submitName = ArrayHelper::getValue($data, 'submit', false);

        switch ($this->module->toastPosition) {
            case 'bottom-left': $toastPosition = 'position-fixed bottom-0 start-0 p-3'; break;
            case 'bottom-right': $toastPosition = 'position-fixed bottom-0 end-0 p-3'; break;
            case 'top-left': $toastPosition = 'position-fixed top-0 start-0 p-3'; break;
            case 'top-right': $toastPosition = 'position-fixed top-0 end-0 p-3'; break;
            default: $toastPosition = $this->module->toastPosition;
        }

        $modalConfig = [
            'id' => 'modal-edit',
            'title' => $modalTitle,
            'size' => $modalSize,
            'footer' => \yii\bootstrap5\Html::button($cancelName ? $cancelName : '', [
                    'class' => 'btn btn-secondary',
                    'data' => [
                        'bs-dismiss' => 'modal'
                    ]
                ]).
                \yii\bootstrap5\Html::button($submitName ? $submitName : '', [
                    'id' => 'modal-submit',
                    'class' => 'btn btn-primary'
                ])
        ];

        return $this->renderPartial('index', [
            'modalConfig' => $modalConfig,
            'toastPosition' => $toastPosition
        ]);
    }
}