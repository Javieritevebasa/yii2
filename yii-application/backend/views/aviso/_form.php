<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\jui\DatePicker;
use common\models\Categoria;

/* @var $this yii\web\View */
/* @var $model common\models\Aviso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aviso-form">

    <?php $form = ActiveForm::begin(); ?>


	<div class="row">
	 	<div class="col-lg-*">
	 		<?= $form->errorSummary($model); ?>
	 	</div>
	 </div>
	 
    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'creadoEl')->widget(\yii\jui\DatePicker::classname(), [
    	'language' => 'es',
	    'dateFormat' => 'dd-MM-yyyy',
		]) ?>


    <?= $form->field($model, 'idCategoria')
        ->dropDownList(
             ArrayHelper::map(Categoria::find()->all(), 'idCategoria', 'nombre'),           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        );
		?>
	
	<label class="control-label" for="Aviso[_estacionesSeleccionadas][]">Grupos:</label>
	<?= GridView::widget([	'dataProvider' => $dataProviderGrupos,
							'summary' => "",
							'columns' => [
							[	'class' => 'yii\grid\CheckboxColumn', 
								'name'=> 'Aviso[_gruposSeleccionados][]',
								'checkboxOptions' => function ($model, $key, $index, $column) {
    									return ['value' => $model->idGrupo];
								}
							],
							
							'nombre'], ]);
	
	?>
	
	<label class="control-label" for="Aviso[_estacionesSeleccionadas][]">Estaciones:</label>
	<?= GridView::widget([	'dataProvider' => $dataProviderEstaciones,
							'summary' => "",
							'columns' => [
							[	'class' => 'yii\grid\CheckboxColumn', 
								'name'=> 'Aviso[_estacionesSeleccionadas][]',
								'checkboxOptions' => function ($model, $key, $index, $column) {
    									return ['value' => $model->codigo];
								}
							],
							
							'nombre'], 
							
							]);
	
	?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
