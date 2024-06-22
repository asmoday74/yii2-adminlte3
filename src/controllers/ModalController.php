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
        $cancelName = ArrayHelper::getValue($data, 'cancel', \Yii::t('app', 'Cancel'));
        $submitName = ArrayHelper::getValue($data, 'submit', \Yii::t('app', 'Save'));

        return $this->renderPartial('index', [
            'modalSize' => $modalSize,
            'modalTitle' => $modalTitle,
            'cancelName' => $cancelName,
            'submitName' => $submitName
        ]);
    }
}