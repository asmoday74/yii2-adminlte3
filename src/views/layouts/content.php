<?php
/* @var $content string */

use yii\bootstrap5\Breadcrumbs;
use \asmoday74\adminlte3\widgets\ToastAlert;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?php
                        if (!is_null($this->title)) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <?php
                        if (isset($this->params['actions'])) {
                            echo implode("\n",$this->params['actions']);
                        }
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <?= ToastAlert::widget() ?>

        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>