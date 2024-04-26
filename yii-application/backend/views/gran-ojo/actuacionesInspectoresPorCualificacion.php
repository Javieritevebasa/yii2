<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use backend\assets\JqWidgetsAsset;
JqWidgetsAsset::register($this);

$this->title = 'Gran Ojo';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
	.hidden
	{
		display: hidden;
	}
	#main {
		min-height: 100% !important;
    	height: auto !important;
	}
	.jqx-pivotgrid-item
	{
		height:20px !important;
		
	} 
	.jqx-pivotgrid-expand-button
	{
		padding-right:17px !important;
	}
	.jqx-pivotgrid-collapse-button
	{
		padding-right:17px !important;
	}
</style>

<div class="container-fluid">
	<div class="row">
		
		<div class="col-xs-2">
			<label for="estacionesITV">Estación
			<?= Html::dropDownList('estacionesITV[]',null, ArrayHelper::map($estaciones,'codigo','nombre'), ['class' => 'form-control input-sm', ]); ?>
			</label>
		</div>
		<div class="col-xs-2">
			<button name="cargarDatos" class="btn btn-default">Cargar</button>
		</div>
		
	</div>
	<hr>
	
	<div class="row" style="">          
		 <div id="PivotGrid"  style="height: 400px; width: 100%; background-color: white;">
		 	<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        
        'inspecciones', 'idUser', 'nombre', 'codigoInspector',

        
    ],
]); ?>
		 </div>
	</div>
</div>




<?php




$script=<<<EOT
	
	
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>