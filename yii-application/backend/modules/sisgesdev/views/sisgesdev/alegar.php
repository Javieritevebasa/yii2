<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sisgesdev\models\HallazgoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alegar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alegar-index">

    <h1><?= Html::encode($this->title) ?></h1>
     <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'hallazgosAAlegar')->dropDownList(ArrayHelper::map($hallazgos, 'id', function($item){ return html_entity_decode(strip_tags ( $item->descripcion ),ENT_QUOTES, "UTF-8");}), ['multiple'=>'multiple'] ) ?> 

	 <?= $form->field($model, 'alegacionDescripcion')->widget(TinyMce::className(), [
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
    

    <div class="form-group">
        <?= Html::submitButton('Alegación al canto!!', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
