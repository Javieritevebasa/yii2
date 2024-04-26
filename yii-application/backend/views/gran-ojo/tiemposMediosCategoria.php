<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\ArrayHelper;

use backend\assets\JqWidgetsAsset;
JqWidgetsAsset::register($this);

$this->title = 'Tiempos medios por categoría';
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
			<label for="fechaDesde">Fecha desde<input type="date" class="form-control input-sm" id="fechaDesde" name="fechaDesde" value='2019-01-01'/></label>
		</div>
		<div class="col-xs-2">
			<label for="fechaHasta">Fecha hasta<input type="date" class="form-control input-sm" id="fechaHasta" name="fechaHasta"  value='2019-01-31'/></label>
		</div>
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
		 <div id="PivotGrid"  style="height: 400px; width: 100%; background-color: white;"></div>
	</div>
</div>




<?php


$todasEstaciones = json_encode($estaciones);


$script=<<<EOT
	var todasEstaciones = $todasEstaciones;
	
	$(document).on('click','button[name="cargarDatos"]', function(){
		var estaciones = $('select[name="estacionesITV[]"]').val();
		cargarDatos('#PivotGrid');
		
	});
	
	$(document).ready(function(){
		$('#PivotGrid').css("height", $('.wrap').prop('scrollHeight')-$('#PivotGrid').offset().top - 44);
	});
	
	function cargarDatos(selector)
	{

		
		var sql = `
			SELECT 	
				Categoria,
				sec_to_time( Avg( time_to_sec( subtime( CAST(Hora2 AS TIME) , CAST(Hora1 AS TIME)   ))) + (10*60)) TiempoMedio
 			FROM estadisticasITEVEBASA.inspecciones 
 			where 
				(anyo = :anyoDesde or anyo = :anyoHasta)   
				and TipoInspeccion='001' 
 				and FaseInspeccion=1 
 				and Estacion=:estacion 
 				and Hora1<>'000000' 
 				and Hora2<>'000000' 
 				and STR_TO_DATE(inspecciones.FechaInspeccion, '%d%m%Y') between :fechaDesde AND :fechaHasta 
 			group by categoria	
		`;
		
		sql = `
			SELECT 	
				Categoria,
				sec_to_time( Avg( time_to_sec( subtime( CAST(HoraImpresionInforme AS TIME) , CAST(Hora1 AS TIME)   ))) + (10*60)) TiempoMedio
 			FROM estadisticasITEVEBASA.inspecciones 
 			where 
				(anyo = :anyoDesde or anyo = :anyoHasta)   
				and TipoInspeccion='001' 
 				and FaseInspeccion=1 
 				and Estacion=:estacion 
 				and Hora1<>'000000' 
 				and HoraImpresionInforme<>'000000' 
 				and STR_TO_DATE(inspecciones.FechaInspeccion, '%d%m%Y') between :fechaDesde AND :fechaHasta 
 			group by categoria	
		`;
		
		var parametros = {
				':anyoDesde' : (new Date($('input[name="fechaDesde"]').val())).getFullYear(),
				':anyoHasta' : (new Date($('input[name="fechaHasta"]').val())).getFullYear(),
				':fechaDesde' : $('input[name="fechaDesde"]').val(),
				':fechaHasta' : $('input[name="fechaHasta"]').val(),
				':estacion' : $('select[name="estacionesITV[]"]').val(),
				
		};
		$.ajax({
				url: 'index.php?r=gran-ojo/json-sql-post',
				type: 'post',
				data: {
					 'sql' : sql
					 ,'parametros' : JSON.stringify( parametros )
				
				//	 ,'debug' : true  
					},
					
				success: function (data) {
					
					datos = $.parseJSON(data) ;
					cargarGrid(selector, datos);
					
				},
				error:function (data) {
					console.log('Incio errores');
					console.log(data);
					console.log('Fin errores');
					return false;
				}	
			});		
	}
	
	
	function cargarGrid (selector, data)
	{
		
		$('#total').text(datos.length);
		
		
		var source =
            {
                localdata: data,
                datatype: "array",
                datafields:
                [
                    
                    { name: 'Categoria', type: 'string' },
                    { name: 'TiempoMedio', type: 'time' },
                    
                ]                     
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
			
			$(selector).jqxGrid(
            {
                width: $(selector).width(),
                source: dataAdapter,                
                altrows: true,
                sortable: true,
                selectionmode: 'multiplecellsextended',
                columns: [
                   { text: 'Categoria', datafield: 'Categoria', width: 200 },
                  { text: 'Teimpos Medios', datafield: 'TiempoMedio', width: 200 },
                   
                 
                ]
            });
		
		
	}
	
	
	
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>