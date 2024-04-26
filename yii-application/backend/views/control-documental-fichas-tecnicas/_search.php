<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ControlDocumentalFichasTecnicasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="control-documental-fichas-tecnicas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'FICHATECNICA_MATRICULA') ?>

    <?= $form->field($model, 'FICHATECNICA_NUMEROCERTIFICADO') ?>

    <?= $form->field($model, 'FICHATECNICA_VIN') ?>

    <?= $form->field($model, 'ESTADO_NOMBRE') ?>

    <?= $form->field($model, 'INGENIERO_NOMBRE') ?>

    <?php // echo $form->field($model, 'FICHATECNICA_FECHAEMISION') ?>

    <?php // echo $form->field($model, 'SERVICIO_NOMBRE') ?>

    <?php // echo $form->field($model, 'FICHATECNICA_MARCA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
