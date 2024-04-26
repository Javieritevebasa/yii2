<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\AccionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipoAccionId') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'fechaLimite') ?>

    <?php // echo $form->field($model, 'fechaCierre') ?>

    <?php // echo $form->field($model, 'validadoPor') ?>

    <?php // echo $form->field($model, 'fechaValidacion') ?>

    <?php // echo $form->field($model, 'tratamientoId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
