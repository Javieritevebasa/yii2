<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Formacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="formacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'horas')->input('number') ?>

    <?= $form->field($model, 'fechaCreacion')->input('date') ?>

    <?= $form->field($model, 'fechaInicio')->input('date') ?>

    <?= $form->field($model, 'fechaFin')->input('date') ?>
    
    <?= $form->field($model, 'responsable')->dropDownList(yii\helpers\ArrayHelper::map($responsablesFormacion,'id',function($item) {return $item->nombre . ' ' .$item->apellidos; }),[]); ?>

	<?= $form->field($model, 'dirigidoA')->dropDownList(yii\helpers\ArrayHelper::map($grupos,'idGrupo','nombre'),['multiple' =>'multiple', 'selected' => 'selected']); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
