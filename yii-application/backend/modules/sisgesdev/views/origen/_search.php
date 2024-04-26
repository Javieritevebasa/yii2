<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\OrigenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="origen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'numeroExpediente') ?>

    <?= $form->field($model, 'tipoOrigen') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'fechaLimite') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'creadoPor') ?>

    <?php // echo $form->field($model, 'validadoPor') ?>

    <?php // echo $form->field($model, 'fechaValidacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
