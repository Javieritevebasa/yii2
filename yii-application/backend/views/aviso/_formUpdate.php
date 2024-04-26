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

	<?= GridView::widget([	'dataProvider' => $dataProviderUsers,
							
							'columns' => [
							[	'class' => 'yii\grid\CheckboxColumn', 
								'name'=> 'Aviso[_usuariosSeleccionados][]',
								
								
								'checkboxOptions' => function ($model, $key, $index, $column) use ($usuariosNotificados) {
															    return ['Id'=>'Aviso[_usuariosNotificados][]','value' => $model->id, 'checked'=>in_array($model->id, $usuariosNotificados)];
															}
							],
							
							'nombre',
							'apellidos'], 
							
							]);
	
	?>
	
	
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
