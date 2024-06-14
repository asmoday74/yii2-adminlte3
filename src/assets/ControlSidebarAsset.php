<?php

namespace asmoday74\adminlte3\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ControlSidebarAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/control_sidebar.js'
    ];
    public $depends = [
        'asmoday74\adminlte3\assets\AdminLteAsset',
    ];
}
