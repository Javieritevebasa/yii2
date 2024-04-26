<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FichajesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fichajes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idFichajes') ?>

    <?= $form->field($model, 'fechaHora') ?>

    <?= $form->field($model, 'idAccion') ?>

    <?= $form->field($model, 'comentario') ?>

    <?= $form->field($model, 'idUser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
