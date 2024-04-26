<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

  	<div class="row">
	 	<div class="col-lg-*">
	 		<?= $form->errorSummary($model); ?>
	 	</div>
	</div>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'password')->passwordInput() ?>

 	<?= $form->field($model, 'foto')->fileInput() ?>
    
    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'certificado')->fileInput() ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

 	<?= $form->field($model, 'emailCorporativo')->textInput(['maxlength' => true]) ?>
 
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'movil')->textInput() ?>
    
    <?= $form->field($model, 'movilPersonal')->textInput() ?>
     
    <?= $form->field($model, 'codigoInspector')->textInput() ?>
    
    <?php $items = ArrayHelper::map(common\models\Status::find()->all(), 'idStatus', 'descripcion'); ?>
    <?= $form->field($model, 'status')->dropDownList($items, ['prompt' => 'Selecciona un estado']) ?>

	<label class="control-label" for="User[_grupos][]">Grupos:</label>
	<?php Pjax::begin(); ?>
  	<?= GridView::widget([	'dataProvider' => $dataProvider,
							'summary' => "",
							'columns' => [
							[	'class' => 'yii\grid\CheckboxColumn', 
								'name'=> 'User[_grupos][]',
								'checkboxOptions' => function ($model, $key, $index, $column) use ($gruposSeleccionados) {
															    return [
															    	'Id'=>'User[_grupos][]',
															    	'value' => $model->idGrupo, 
															    	'checked'=>in_array($model->idGrupo, $gruposSeleccionados)];
															}
							],
							
							'nombre'], 
							
							]);
	
	?>
	<?php Pjax::end(); ?>
	
	<label class="control-label" for="User[_estaciones][]">Estaciones:</label>
	<?php Pjax::begin(); ?>
	<?= GridView::widget([	'dataProvider' => $dataProviderEstaciones,
							'summary' => "",
							'columns' => [
								[	'class' => 'yii\grid\CheckboxColumn', 
									
									'name'=> 'User[_estaciones][]',
									'checkboxOptions' => function ($model, $key, $index, $column) use ($estacionesSeleccionadas) {
																    return [
																    	'Id'=>'User[_estaciones][]',
																    	'value' => $model->codigo, 
																    	'checked'=>in_array($model->codigo, $estacionesSeleccionadas)
																    	];
																}
								],
								
								
								[	
									'class' => 'yii\grid\ActionColumn',
									'header' => 'Estación predeterminada',
									'template' =>'{predeterminar}',
									'contentOptions'=>['style'=>'min-width: 120px; max-width:60px; width:120px; text-align:center'],
									'buttons' => 
											[
												'predeterminar' => function($url, $model) use ($estacionPredeterminada)
																	{
																		
																		 return Html::Radio('User[_estacionPredeterminada]',($model->codigo==$estacionPredeterminada['codigoEstacion']),['id'=>'User[_estacionPredeterminada]', 'value' => $model->codigo]) ;
																	},
																	
									 		]
								],
								'nombre',
							], 
							
							]);
	
	?>
	<?php Pjax::end(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
