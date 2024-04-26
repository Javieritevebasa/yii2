<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Desviacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="desviacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'orden')->textInput([]) ?>

    <?= $form->field($model, 'fecha')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'departamento')->dropDownList(ArrayHelper::map($departamento, 'id', 'nombre'), ['prompt'=>'Selecciona un departamento'] ) ?>

    <?= $form->field($model, 'tipoDesviacion')->dropDownList(ArrayHelper::map($tipoDesviacion, 'id', 'nombre'), ['prompt'=>'Selecciona un tipo'] ) ?>

	<?= $form->field($model, 'descripcion')->widget(TinyMce::className(), [
	    'options' => ['rows' => 6],
	    'language' => 'es',
	    'clientOptions' => [
	        'plugins' => [
	            "advlist autolink lists link charmap print preview anchor",
	            "searchreplace visualblocks code fullscreen",
	            "insertdatetime media table contextmenu paste"
	        ],
	        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	    ]
	]);?>
	
    <?php //= $form->field($model, 'origen')->textInput() ?>

    <?= $form->field($model, 'responsable')->dropDownList(ArrayHelper::map($usuarios, 'id', 'nombre'), ['prompt'=>'Selecciona un usario'] ) ?>

    <?php //$form->field($model, 'fechaCierre')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'validadoPor')->dropDownList(ArrayHelper::map($usuarios, 'id', 'nombre'), ['prompt'=>'Selecciona un usario'] ) ?>

    <?php // $form->field($model, 'fechaValidacion')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'fechaLimite')->textInput(['type'=>'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
