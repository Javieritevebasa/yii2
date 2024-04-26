<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EstarEspecializado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estar-especializado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idUser')->textInput() ?>

    <?= $form->field($model, 'idEspecialidad')->textInput() ?>

    <?= $form->field($model, 'fechaCualificacion')->textInput() ?>

    <?= $form->field($model, 'fechaVencimiento')->textInput() ?>

    <?= $form->field($model, 'fechaPrimeraCualificacion')->textInput() ?>

    <?= $form->field($model, 'apto')->textInput() ?>

    <?= $form->field($model, 'cualificadoComo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
