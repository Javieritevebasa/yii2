<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\DesviacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="desviacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'numero') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'departamento') ?>

    <?= $form->field($model, 'tipoDesviacion') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'origen') ?>

    <?php // echo $form->field($model, 'responsable') ?>

    <?php // echo $form->field($model, 'fechaCierre') ?>

    <?php // echo $form->field($model, 'validadoPor') ?>

    <?php // echo $form->field($model, 'fechaValidacion') ?>

    <?php // echo $form->field($model, 'fechaLimite') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
