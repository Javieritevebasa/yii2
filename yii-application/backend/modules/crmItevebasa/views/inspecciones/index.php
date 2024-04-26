<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\crmItevebasa\models\InspeccionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inspecciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inspecciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($formModel, 'fechaDesde')->input('date', ['maxlength' => true]) ?>
    <?= $form->field($formModel, 'fechaHasta')->input('date', ['maxlength' => true]) ?>
 	<?= $form->field($formModel, 'estacion') ->dropDownList([
'0302' => '0302',
'0308' => '0308',
'0352' => '0352',
'0355' => '0355',
'0390' => '0390',
'0607' => '0607',
'0608' => '0608',
'0609' => '0609',
'0610' => '0610',
'0611' => '0611',
'0612' => '0612',
'0613' => '0613',
'0651' => '0651',
'0652' => '0652',
'0653' => '0653',
'0654' => '0654',
'0655' => '0655',
'0656' => '0656',
'1009' => '1009',
'1010' => '1010',
'1011' => '1011',
'1051' => '1051',
'1052' => '1052',
'1053' => '1053',
'1054' => '1054',
'1055' => '1055',
'3032' => '3032', 	
 	], []); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
