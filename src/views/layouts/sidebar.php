<?php
$baseAssetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/asmoday74/yii2-adminlte3/src/assets/dist');
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link text-center">
        <span class="brand-text"><?= Yii::$app->name; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$baseAssetDir?>/image/user.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= \Yii::$app->user->identity->name; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo asmoday74\adminlte3\widgets\Menu::widget([
                'items' => [

                    ['label' => 'Yii2 PROVIDED', 'header' => true, 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank', 'visible' => Yii::$app->user->can('admin')],

                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>