<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ServiciosAlfaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicios-alfa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'idZona') ?>

    <?= $form->field($model, 'idServicio') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'codigoComunidad') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
