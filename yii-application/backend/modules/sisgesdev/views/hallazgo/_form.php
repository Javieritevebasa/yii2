<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Hallazgo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hallazgo-form">

    <?php $form = ActiveForm::begin(); ?>
   
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

    <?php //= $form->field($model, 'tratamientoId')->textInput() ?>

    <?php //= $form->field($model, 'desviacionId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>