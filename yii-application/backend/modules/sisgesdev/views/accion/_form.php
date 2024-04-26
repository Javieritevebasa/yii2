<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Accion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipoAccionId')->dropDownList(ArrayHelper::map($tipoAccion, 'id', 'nombre'), ['prompt'=>'Selecciona un tipo'] ) ?>

    <?= $form->field($model, 'descripcion')->widget(TinyMce::className(), [
	    'options' => ['rows' => 20],
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
 	
 	<?= $form->field($model, 'fecha')->textInput(['type'=>'date']) ?>
    
    <?= $form->field($model, 'fechaLimite')->textInput(['type'=>'date']) ?>
    
    <?= $form->field($model, 'validadoPor')->dropDownList(ArrayHelper::map($usuarios, 'id', 'nombre'), ['prompt'=>'Selecciona un usario'] ) ?>
     
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
