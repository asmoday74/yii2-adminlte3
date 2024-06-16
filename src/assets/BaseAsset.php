<?php

namespace asmoday74\adminlte3\assets;

use yii\web\AssetBundle;

class BaseAsset extends AssetBundle
{
    public $sourcePath = '@vendor/asmoday74/yii2-adminlte3/src/assets';

    public $css = [
        'css/adminlte.mod.css'
    ];

    public $js = [
        'js/modal.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}