<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Evidencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evidencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigoEvidencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruta')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
