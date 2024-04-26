<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\CriteriosMantenimientosCualificacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="criterios-mantenimientos-cualificacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idCualificacion')->dropDownList(ArrayHelper::map($cualificaciones, 'id', 'nombre'), ['prompt'=>'Selecciona una cualificación']) ?>

    <?= $form->field($model, 'idTipoMantenimientoCualificacion')->dropDownList(ArrayHelper::map($tipoMantenimientoCualificacion, 'id', 'nombre'),  ['prompt'=>'Selecciona una tipo de cualificación']) ?>
   
    <?= $form->field($model, 'numeroMinimoTuteladas')->textInput() ?>

    <?= $form->field($model, 'numeroSupervisiones')->textInput() ?>

	<?= $form->field($model, 'numeroActuacionesMinimo')->textInput() ?>
    
    <?= $form->field($model, 'cualificadoComo')->dropDownList(ArrayHelper::map($grupos, 'idGrupo', 'nombre'), ['prompt'=>'Para que se cualifica al inspector']) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
