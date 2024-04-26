<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\ArrayHelper;


use backend\assets\JqWidgetsAsset;
JqWidgetsAsset::register($this);


/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Dashboard';
//$this->params['breadcrumbs'][] = $this->title;
?>
<style>
	.widget{
		border: 1px; 
		border-style: solid;
		width: 100%; 
		padding: 0.5em;
		border-color: rgb(188,188,188); 
		display: block; 
	}
	
</style>

<div class="dashboard-index">
   <div class="row">
		
		<div class="col-xs-7" id='chartDatosEconomicos' style="height:471px"></div>
		
		<div class="col-xs-5" style="">
			<div class="widget">
				<label for="estacionesITV">Estación
				<?= Html::dropDownList('estacionesITV_chartDatosEconomicosEstacion[]',null, ArrayHelper::map($estaciones,'codigo','nombre'), ['class' => 'form-control input-sm', ]); ?>
				</label>
				<div id="chartDatosEconomicosEstacion" style="width: 100%; height: 400px;"></div>
			
			</div>
		</div>
	</div>
	<div class="row">			
		<div class="col-xs-6">
			<div class="widget">
				<label for="estacionesITV">Estación
				<?= Html::dropDownList('estacionesITV_chartInspectoresActivos[]',null, ArrayHelper::map($estaciones,'codigo','nombre'), ['class' => 'form-control input-sm', ]); ?>
				</label>
				<div id="chartInspectoresActivos" style="width: 100%; height: 400px;"></div>
			</div>
		</div>
		<div class="col-xs-3">
			<div class="widget"></div>
		</div>
	</div>
</div>
<?php


$script=<<<EOT
	
//Eventos:
	$(document).ready(function(){
//		 setTimeout(function(){cargarChartDatosEconomicos('#chartDatosEconomicos');}, 0); 
		 setTimeout(cargarChartDatosEconomicos, 0, '#chartDatosEconomicos'); 
		
	});
	
	$(document).on('change','select[name="estacionesITV_chartDatosEconomicosEstacion[]"]', function(){
		setTimeout(cargarChartDatosEconomicosEstacion, 0, '#chartDatosEconomicosEstacion', $(this).val()); 
		
	});
	
	$(document).on('change','select[name="estacionesITV_chartInspectoresActivos[]"]', function(){
		 setTimeout(cargarChartInspectoresActivos, 0, '#chartInspectoresActivos', $(this).val()); 
	});
	
	
//Fin eventos	
	
	


	
	
	
	
	
	
	
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>