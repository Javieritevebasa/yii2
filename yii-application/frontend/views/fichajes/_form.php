<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Accion;

/* @var $this yii\web\View */
/* @var $model common\models\Fichajes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fichajes-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<div class="row">
	 	<div class="col-lg-*">
	 		<?= $form->errorSummary($model); ?>
	 	</div>
	 </div>
   
    
    <?= $form->field($model, 'idAccion')
        ->dropDownList(
             ArrayHelper::map(Accion::find()->all(), 'idAccion', 'nombre'),           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        )
		->label('Seleccione una acción de fichaje') ;
		?>

    <?= $form->field($model, 'comentario')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Fichar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
