<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SeguimientoRiesgosImparcialidadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seguimiento-riesgos-imparcialidad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'matricula') ?>

    <?= $form->field($model, 'usuarioId') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'servicio') ?>

    <?php // echo $form->field($model, 'riesgoId') ?>

    <?php // echo $form->field($model, 'nivelRiesgoId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
