<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CriteriosMantenimientosCualificacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="criterios-mantenimientos-cualificacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idCualificacion') ?>

    <?= $form->field($model, 'idTipoMantenimientoCualificacion') ?>

    <?= $form->field($model, 'numeroMinimoTuteladas') ?>

    <?= $form->field($model, 'numeroSupervisiones') ?>

    <?= $form->field($model, 'cualificadoComo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
