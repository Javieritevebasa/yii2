<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

use yii\jui\DatePicker;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use backend\models\User;
use common\models\Estacion;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = 'Resumen trabajadores mes '.$mes.' de '.$anyo;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichaje-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<p>
		<div class="panel panel-default">
		  <div class="panel-heading">Criterios</div>
		  <div class="panel-body">
			 <?php $form = ActiveForm::begin(['id'=> 'criterios', 'action' => ['fichaje/resumen-trabajadores'], 'method' =>'get', 'options'=>['class'=>'no-print']]); ?>
		  		<div class="row">
	    	    <div class="col-sm-2">
			  		<?= Html::dropDownList('anyo', $anyo , ['2016' => 2016, '2017' => 2017, '2018'=> 2018, '2019'=> 2019, '2020' => 2020,'2021'=>2021, '2022'=>2022,  '2023'=>2023], ['class' => 'form-control col-sm-1'] ); ?>
			  	</div>
		    	<div class="col-sm-2">
					<?= Html::dropDownList('mes', $mes , ['1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, '11' => 11, '12' => 12], ['class' => 'form-control'] ); ?>
				</div>
				<div class="col-sm-2">
					<?= Html::dropDownList('estacion', $estacion, ArrayHelper::map(Estacion::find()->where(['in', 'codigo', ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo') ])->all(), 'codigo', 'nombre'),['class' => 'form-control']); ?>
				</div>
				<div class="col-sm-4">
					<?= Html::submitButton('Consultar', [ 'id' => 'consultar', 'class' =>'btn btn-success',]) ?>
					<?= Html::a('Imprimir', [ 'fichaje/resumen-trabajadores-estacion'], [ 'id' => 'imprimir', 'class' =>'btn btn-success', 'target'=>'_blank' ]) ?>
				</div>
		    	</div>
	    	<?php ActiveForm::end(); ?>
		  </div>
		</div>
	    
	</p>
	
	<?php foreach ($fichadas as $user => $fichajes) :  ?>
		<?php $trabajador = User::findOne(['id' => $user]); ?>
		
		<div class="panel panel-default" style="page-break-before: always;">
			<div class="panel-heading">
				<div class="panel-title">
		    		<h3>Registro horas acumuladas mes</h3>
		    		<h3><?= $trabajador->apellidos.', ' .$trabajador->nombre ?>
		    		<div style="float:right;clear: both;">Mes: <?= $mes ?> de <?= $anyo ?></div>
		    		</h2>
		    	</div>
		    	
		  	</div>
		  	<div class="panel-body">
			    <?= GridView::widget([
					
				    'dataProvider' => new ArrayDataProvider(['allModels' => $fichajes, 'pagination' => false,] ),
				    'options' => ['class' => 'table'],
				    'columns' => [
				    	['value' => function($model,$key, $index, $widget){  $date = date_create($model['entrada']); return date_format($date, 'd');}, 'label' => 'Día'],
				        ['value' => function($model,$key, $index, $widget){  $date = date_create($model['entrada']); return date_format($date, 'H:i');}, 'label' => 'Entrada'], 
				        ['value' => function($model,$key, $index, $widget){ if ($model['salida']===null) return '--:--';  $date = date_create($model['salida']);  return date_format($date, 'H:i');}, 'label' => 'Salida'],
				        
				        ['attribute' => 'tiempo', 'label' => 'Tiempo'],
				    ],
				]) ?>
				
		  	</div>
		  	<div class="panel-footer">
				<?php 
					$sum = array_sum( ArrayHelper::getColumn($fichajes, function($fichaje){ $parsed=date_parse($fichaje['tiempo']); return $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];})) ;
					echo '<h4>Total horas: ';
					printf("%d:%d",  $sum / 3600, ($sum % 3600) / 60);
					echo '<div style="float:right; margin-right: 20vw;">Conforme:</div>';
					echo '</h4>';
				?>	
		  	</div>
		</div>
				
		
		
	<?php endforeach; ?>
	</div>

<?php

$script = <<< JS
	jQuery(document).on('click', '#imprimir', function(e){
		e.preventDefault();
		var url = jQuery(this).attr('href');
		
		url += '&anyo='+jQuery('select[name=anyo]').val();
		url += '&mes='+jQuery('select[name=mes]').val();
		url += '&estacion='+jQuery('select[name=estacion]').val();
		
		var win = window.open(url, '_blank');
		
	});
	
	
JS;
$this->registerJs($script);
?>
