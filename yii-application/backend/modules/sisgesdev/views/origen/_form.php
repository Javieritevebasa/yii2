<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use yii\web\View;

use dosamigos\tinymce\TinyMce;

use backend\assets\JqWidgetsAsset;
JqWidgetsAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Origen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="origen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numeroExpediente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipoOrigen')->dropDownList(ArrayHelper::map($tiposOrigen, 'id', 'nombre'), ['prompt'=>'Selecciona un tipo'] ) ?>

    <?= $form->field($model, 'fecha')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'fechaLimite')->textInput(['type'=>'date']) ?>

   
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
	
    <?= $form->field($model, 'validadoPor')->dropDownList(ArrayHelper::map($usuarios, 'id', 'nombre'), ['prompt'=>'Selecciona un usario'] ) ?>

    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php 
$script=<<<EOT

EOT;
$this->registerJs( $script, View::POS_READY ); 
?>

