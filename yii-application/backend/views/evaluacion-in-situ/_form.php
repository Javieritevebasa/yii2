<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluacionInSitu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluacion-in-situ-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'evaluador')->textInput() ?>

    <?= $form->field($model, 'resultado')->checkbox() ?>

    <?= $form->field($model, 'idHistoricoMantenimientosCualificacion')->textInput() ?>

    <?= $form->field($model, 'referenciaEvaluacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idTipoEvaluacion')->textInput() ?>

	<div class="form-group">
    	<label for="evaluacioninsitu-documentoifo010205">IFO 01-02-05</label>
    	<?= $form->field($model, 'documentoIFO010205')->fileInput()->label(false) ?>
    	<?= $model->documentoIFO010205!= null ? utf8_decode($model->documentoIFO010205->nombre) : 'sin fichero' ?>
    </div>
    

	
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
