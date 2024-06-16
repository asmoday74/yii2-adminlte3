<?php

namespace asmoday74\adminlte3\controllers;

use yii\web\Controller;

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
        return $this->renderPartial('index');
    }
}