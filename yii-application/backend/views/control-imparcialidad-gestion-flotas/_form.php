<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ControlImparcialidadGestionFlotas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="control-imparcialidad-gestion-flotas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
