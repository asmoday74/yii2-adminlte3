<?php

/* @var $this \yii\web\View */
/* @var $content string */

\asmoday74\adminlte3\assets\AdminLteClearAsset::register($this);
\asmoday74\adminlte3\assets\PluginAsset::register($this)->add(['fontawesome', 'icheck-bootstrap']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Yii::$app->name; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="text-center">
<?php  $this->beginBody() ?>

<main class="site-page">
    <div class="page-logo">
        <a href="<?=Yii::$app->homeUrl?>"><b><?= Yii::$app->name; ?></b></a>
    </div>
    <?= $content ?>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>