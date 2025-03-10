<?php
namespace asmoday74\adminlte3\assets;

use yii\web\AssetBundle;

class AdminLteClearAsset extends AssetBundle
{
    public $sourcePath = '@vendor/asmoday74/yii2-adminlte3/src/assets';

    public $css = [
        'css/adminlte.clear.css'
    ];

    public $depends = [
        'asmoday74\adminlte3\assets\BaseAsset',
    ];
}