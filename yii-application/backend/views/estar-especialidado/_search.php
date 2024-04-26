<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EstarEspecializadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estar-especializado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idUser') ?>

    <?= $form->field($model, 'idEspecialidad') ?>

    <?= $form->field($model, 'fechaCualificacion') ?>

    <?= $form->field($model, 'fechaVencimiento') ?>

    <?= $form->field($model, 'fechaPrimeraCualificacion') ?>

    <?php // echo $form->field($model, 'apto') ?>

    <?php // echo $form->field($model, 'cualificadoComo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
