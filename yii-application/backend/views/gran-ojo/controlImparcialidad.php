<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\ArrayHelper;

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
			<label for="fechaDesde">Fecha desde<input type="date" class="form-control input-sm" id="fechaDesde" name="fechaDesde" value='2019-01-01'/></label>
		</div>
		<div class="col-xs-2">
			<label for="fechaHasta">Fecha hasta<input type="date" class="form-control input-sm" id="fechaHasta" name="fechaHasta"  value='2019-01-31'/></label>
		</div>
		<div class="col-xs-2">
			<label for="maximo">Ruptura en
			<?= Html::textInput('maximo', 50, ['class' => 'form-control input-sm', ]); ?>
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
$inspectores =  json_encode($inspectores);

$script=<<<EOT
	var inspectores = $inspectores;
	$(document).on('click','button[name="cargarDatos"]', function(){
		cargarDatos('#PivotGrid');
	});
	
	$(document).ready(function(){
		$('#PivotGrid').css("height", $('.wrap').prop('scrollHeight')-$('#PivotGrid').offset().top - 44);
	});
	
	function cargarDatos(selector)
	{

		
		var sql = `select 
					sum(case when inspecciones.ResultadoInspeccion = 1 or inspecciones.ResultadoInspeccion =2 then 1 else 0 end ) favorables,
					sum(case when inspecciones.ResultadoInspeccion = 3 or inspecciones.ResultadoInspeccion =4 then 1 else 0 end ) desfavorables,
					count(inspecciones.InformeMecanica) total, 
					((sum(case when inspecciones.ResultadoInspeccion = 3 or inspecciones.ResultadoInspeccion =4 then 1 else 0 end ) / count(inspecciones.InformeMecanica)) * 100) indiceRechazo,
					inspecciones.DNI cliente,  
					alcances.CodigoInspector inspector
					from inspecciones
					left join alcances on inspecciones.Estacion=alcances.Estacion and inspecciones.InformeMecanica = alcances.InformeMecanica and inspecciones.anyo=alcances.anyo
					where 
					(alcances.anyo = :anyoDesde or alcances.anyo = :anyoDesde) 
					and STR_TO_DATE(inspecciones.FechaInspeccion, "%d%m%Y") between :fechaDesde AND :fechaHasta 
					and inspecciones.DNI <> '' 
					and inspecciones.faseInspeccion = 1
					group by  inspecciones.DNI, alcances.CodigoInspector
					having total >= :max`;
		
		
		var parametros = {
				':anyoDesde' :  (new Date($('input[name="fechaDesde"]').val())).getFullYear(),
				':anyoHasta' : (new Date($('input[name="fechaHasta"]').val())).getFullYear(),
				':fechaDesde' : $('input[name="fechaDesde"]').val(),
				':fechaHasta' : $('input[name="fechaHasta"]').val(),
				
				':max': $('input[name="maximo"]').val()
			};
			
			
		$.ajax({
				url: 'index.php?r=gran-ojo/json-sql-post',
				type: 'post',
				data: {
					 'sql' : sql
					 ,'parametros' : JSON.stringify( parametros )
					 //,'debug' : true  
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
	
	
	function cargarGrid(selector, datos)
	{
			$.each(datos, function(index, item){
				
			});
		
			var source =
			{
			   localdata: datos,
			   datatype: "array",
			   datafields:
			   [
			      { name: 'favorables', type: 'number' },			//Cantidad total de inspecciones en el perioodo dado
			      { name: 'desfavorables', type: 'number' },			//Cantidad total de inspecciones en el perioodo dado
			      { name: 'total', type: 'number' },			//Cantidad total de inspecciones en el perioodo dado
			      { name: 'indiceRechazo', type: 'number' },			//Cantidad total de inspecciones en el perioodo dado
			      { name: 'cliente', type: 'string' },			//Cliente
			      { name: 'inspector', type: 'string' },		//Inspector
			   ]
			};
			
			var dataAdapter = new $.jqx.dataAdapter(source);
			dataAdapter.dataBind();
				
			$(selector).jqxGrid(
            {
                width: $(selector).width(),
                source: dataAdapter,                
                altrows: true,
                sortable: true,
                selectionmode: 'multiplecellsextended',
                columns: [
                  { text: 'Cliente', datafield: 'cliente', width: 120, align: 'right', cellsalign: 'right',  },
                  { text: 'Inspector', datafield: 'inspector', width: 120, align: 'right', cellsalign: 'right',  },
                  { text: 'Total', datafield: 'total', width: 130 },
                  { text: 'Total Favorables', datafield: 'favorables', width: 130 },
                  { text: 'Total Desfavorables' , datafield: 'desfavorables', width: 130 },
                  { text: 'Índice rechazo' , datafield: 'indiceRechazo', width: 130 },
                ]
            });
	}
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>