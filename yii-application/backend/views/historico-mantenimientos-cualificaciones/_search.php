<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricoMantenimientosCualificacionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historico-mantenimientos-cualificaciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idCualificacion') ?>

    <?= $form->field($model, 'idUser') ?>

    <?= $form->field($model, 'fechaDesde') ?>

    <?= $form->field($model, 'fechaHasta') ?>

    <?php // echo $form->field($model, 'resultadoGlobal')->checkbox() ?>

    <?php // echo $form->field($model, 'idTipoMantenimientoCualificacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
