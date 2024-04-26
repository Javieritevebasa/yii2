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
			<label for="fechaDesde">Fecha desde<input type="date" class="form-control input-sm" id="fechaDesde" name="fechaDesde" value='2018-01-01'/></label>
		</div>
		<div class="col-xs-2">
			<label for="fechaHasta">Fecha hasta<input type="date" class="form-control input-sm" id="fechaHasta" name="fechaHasta"  value='2018-01-31'/></label>
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
	<div class="row">
		 <div class="col-lg-3 col-md-6">
          	<div class="panel panel-primary">
              	<div class="panel-heading">
                  	<div class="row">
                       	<div class="col-xs-3">
                        	<i id="codigoEstacion" class="fa fa-comments fa-5x">Estación</i>
                        </div>
                      	<div class="col-xs-9 text-right">
                            <div id="rechazoEstacion" class="huge">0</div>
                        	<div>Índice rechazo</div>
                    	</div>
                	</div>
            	</div>
        	</div>
		</div>
		<div class="col-lg-3 col-md-6">
          	<div class="panel panel-primary">
              	<div class="panel-heading">
                  	<div class="row">
                       	<div class="col-xs-3">
                        	<i class="fa fa-comments fa-5x">Itevebasa (comunidad) </i>
                        </div>
                      	<div class="col-xs-9 text-right">
                            <div id="rechazoItevebasaComunidad" class="huge">0</div>
                        	<div>Índice rechazo</div>
                    	</div>
                	</div>
            	</div>
        	</div>
		</div>
		<div class="col-lg-3 col-md-6">
          	<div class="panel panel-primary">
              	<div class="panel-heading">
                  	<div class="row">
                       	<div class="col-xs-3">
                        	<i class="fa fa-comments fa-5x">Comunidad autónoma</i>
                        </div>
                      	<div class="col-xs-9 text-right">
                            <div id="rechazoComunidadAutonoma" class="huge">0</div>
                        	<div>Índice rechazo</div>
                    	</div>
                	</div>
            	</div>
        	</div>
		</div>
		<div class="col-lg-3 col-md-6">
          	<div class="panel panel-primary">
              	<div class="panel-heading">
                  	<div class="row">
                       	<div class="col-xs-3">
                        	<i class="fa fa-comments fa-5x">Nacional</i>
                        </div>
                      	<div class="col-xs-9 text-right">
                            <div id="rechazoNacional" class="huge">0</div>
                        	<div>Índice rechazo</div>
                    	</div>
                	</div>
            	</div>
        	</div>
		</div>
	</div>
	<div class="row" style="">          
		 <div id="PivotGrid"  style="height: 400px; width: 100%; background-color: white;"></div>
	</div>
</div>




<?php

$inspectores =  json_encode($inspectores);
$serviciosPonderados = json_encode($serviciosPonderados);
$todasEstaciones = json_encode($todasEstaciones);
$script=<<<EOT
	var inspectores = $inspectores;
	var serviciosPonderados = $serviciosPonderados;
	var todasEstaciones = $todasEstaciones;
	var TotalInspeccionesComputadas = 0;
	var TotalFavorablesComputadas = 0;
	var TotalDesfavorablesComputadas = 0;
	var desviacionTipica = 1;
	
	$(document).on('click','button[name="cargarDatos"]', function(){
		var estaciones = $('select[name="estacionesITV[]"]').val();
		cargarDatos('#PivotGrid');
		cargarIndicesRechazo();
		
	});
	
	$(document).ready(function(){
		$('#PivotGrid').css("height", $('.wrap').prop('scrollHeight')-$('#PivotGrid').offset().top - 44);
	});
	
	function cargarIndicesRechazo()
	{
		$('#rechazoItevebasaComunidad').text('--');
		
		var sql = 'SELECT '; 
		sql += '	count(inspecciones.InformeMecanica) as Total'; 
		sql += '	,sum(CASE';
		sql += '		WHEN inspecciones.ResultadoInspeccion in (1,2) THEN 1';
		sql += '		WHEN inspecciones.ResultadoInspeccion in (3,4) THEN 0';
		sql += '		ELSE 0';
		sql += '		END) as Favorables'; 
		sql += '	,sum(CASE';
		sql += '	    WHEN inspecciones.ResultadoInspeccion in (1,2) THEN 0';
		sql += '	    WHEN inspecciones.ResultadoInspeccion in (3,4) THEN 1';
		sql += '	    ELSE 0';
		sql += '		END) as Desfavorables';
		sql += '	,inspecciones.TipoInspeccion';
		sql += '	,d_estaciones.comunidad';
		sql += '   from inspecciones';
		sql += '   left join d_estaciones on d_estaciones.codigo=inspecciones.Estacion';
		sql += '   where ';
		sql += '        (inspecciones.anyo = :anyoDesde or inspecciones.anyo = :anyoHasta) '
		sql += '        and faseInspeccion = :faseInspeccion '
		sql += '    	and STR_TO_DATE(inspecciones.FechaInspeccion, "%d%m%Y") between :fechaDesde AND :fechaHasta';
		//sql += ' 		and d_estaciones.comunidad = :comunidad';
		sql += ' 		and inspecciones.tipoInspeccion = :tipoInspeccion';
		sql += '	group by';
		sql += '        inspecciones.TipoInspeccion, d_estaciones.comunidad'
		sql += '    order by Total desc';
		
		
		var parametros = {
				':anyoDesde' :  (new Date($('input[name="fechaDesde"]').val())).getFullYear(),
				':anyoHasta' : (new Date($('input[name="fechaHasta"]').val())).getFullYear(),
				':fechaDesde' : $('input[name="fechaDesde"]').val(),
				':fechaHasta' : $('input[name="fechaHasta"]').val(),
				//':comunidad' :  todasEstaciones[$('select[name="estacionesITV[]"]').val()].comunidad ,
				':faseInspeccion': '1',
				':tipoInspeccion' : '001',
		};
		$.ajax({
				url: 'index.php?r=gran-ojo/json-sql',
				type: 'get',
				data: {
					 'sql' : sql
					 ,'parametros' : JSON.stringify( parametros )
					 //,'debug' : true  
					},
					
				success: function (data) {
					
					datos = $.parseJSON(data) ;
					$.each(datos, function(index, d){
						if (d.comunidad == todasEstaciones[$('select[name="estacionesITV[]"]').val()].comunidad)
						{
							$('#rechazoItevebasaComunidad').text( ((parseInt(d.Desfavorables) / parseInt(d.Total))*100).toFixed(2) );
						}
						
					});
					
					$('#rechazoComunidadAutonoma').text( '--' );
					$('#rechazoNacional').text( '--' );
					
				},
				error:function (data) {
					console.log('Incio errores');
					console.log(data);
					console.log('Fin errores');
					return false;
				}	
			});		
	}
	
	
	function cargarIndiceRechazoItevebasa(selector)
	{
		$(selector).text('--');
	}
	
	function cargarIndiceRechazoNacional(selector)
	{
		$(selector).text('--');
	}
	
	function cargarDatos(selector)
	{
		var sql = 'SELECT '; 
		sql += '	count(inspecciones.InformeMecanica) as Total'; 
		sql += '	,sum(CASE';
		sql += '		WHEN inspecciones.ResultadoInspeccion in (1,2) THEN 1';
		sql += '		WHEN inspecciones.ResultadoInspeccion in (3,4) THEN 0';
		sql += '		ELSE 0';
		sql += '		END) as Favorables'; 
		sql += '	,sum(CASE';
		sql += '	    WHEN inspecciones.ResultadoInspeccion in (1,2) THEN 0';
		sql += '	    WHEN inspecciones.ResultadoInspeccion in (3,4) THEN 1';
		sql += '	    ELSE 0';
		sql += '		END) as Desfavorables';
		sql += '	,(       sum( cast( concat(inspecciones.ConceptoSigno1,inspecciones.ConceptoImporte1) as DECIMAL(9,2)))';
		sql += '		   + sum( cast( concat(inspecciones.ConceptoSigno2,inspecciones.ConceptoImporte2) as DECIMAL(9,2))) ';
		sql += '		   + sum( cast( concat(inspecciones.ConceptoSigno3,inspecciones.ConceptoImporte3) as DECIMAL(9,2))) ';	
		sql += '		   + sum( cast( concat(inspecciones.ConceptoSigno4,inspecciones.ConceptoImporte4) as DECIMAL(9,2))) ';
		sql += '		   + sum( cast( concat(inspecciones.ConceptoSigno5,inspecciones.ConceptoImporte5) as DECIMAL(9,2))) ';
		sql += '		   + sum( cast( concat(inspecciones.ConceptoSigno6,inspecciones.ConceptoImporte6) as DECIMAL(9,2))) ';
		sql += '		   ) valorEconomico ';
		sql += '	,alcances.CodigoInspector';
		sql += '	,inspecciones.TipoInspeccion';
		sql += '	,d_cualificaciones.nombre';
		sql += '	,d_estaciones.comunidad';
		sql += '	,inspecciones.categoria';
		sql += '	,inspecciones.faseInspeccion';
		sql += '	,d_servicios.servicioUnificado';
		sql += '   from inspecciones inner join alcances on inspecciones.Estacion=alcances.Estacion and inspecciones.InformeMecanica=alcances.InformeMecanica';
		sql += '   left join d_cualificaciones on alcances.cualificacionInspeccion=d_cualificaciones.id';
		sql += '   left join d_estaciones on d_estaciones.codigo=inspecciones.Estacion';
		sql += '   left join d_servicios on d_servicios.codigo=inspecciones.tipoInspeccion and d_estaciones.comunidad=d_servicios.comunidad';
		sql += '   where ';
		sql += '        (inspecciones.anyo = :anyoDesde or inspecciones.anyo = :anyoHasta) '
		sql += '    	and STR_TO_DATE(inspecciones.FechaInspeccion, "%d%m%Y") between :fechaDesde AND :fechaHasta';
		sql += ' 		and inspecciones.Estacion = :estacion';
		sql += ' 		and inspecciones.tipoInspeccion = :tipoInspeccion';
		sql += '	group by';
		sql += '        alcances.CodigoInspector, inspecciones.TipoInspeccion, d_cualificaciones.nombre, d_estaciones.comunidad, inspecciones.categoria, inspecciones.faseInspeccion, d_servicios.servicioUnificado'
		sql += '   order by Total desc';
		
		
		var parametros = {
				':anyoDesde' :  (new Date($('input[name="fechaDesde"]').val())).getFullYear(),
				':anyoHasta' : (new Date($('input[name="fechaHasta"]').val())).getFullYear(),
				':fechaDesde' : $('input[name="fechaDesde"]').val(),
				':fechaHasta' : $('input[name="fechaHasta"]').val(),
				':estacion' : $('select[name="estacionesITV[]"]').val() ,
				
				':tipoInspeccion' : '001',
		};
		$.ajax({
				url: 'index.php?r=gran-ojo/json-sql',
				type: 'get',
				data: {
					 'sql' : sql
					 ,'parametros' : JSON.stringify( parametros )
					 //,'debug' : true  
					},
					
				success: function (data) {
					
					datos = $.parseJSON(data) ;
					dataJson = datos;
					
					cargarGrid (selector, datos)
				},
				error:function (data) {
					console.log('Incio errores');
					console.log(data);
					console.log('Fin errores');
					return false;
				}	
			});		
		
	}

	function cargarGrid(selector, datos){
		TotalInspeccionesComputadas = 0;
		TotalFavorablesComputadas = 0;
		TotalDesfavorablesComputadas = 0;
		
		datosPonderados = [];
		$.each(datos, function(index, item){
			item['root'] = 'Todos los servicios';
			item['ponderado'] = 0;
			TotalInspeccionesComputadas += parseInt(item['Total']);
			TotalFavorablesComputadas += parseInt(item['Favorables']);
			TotalDesfavorablesComputadas += parseInt(item['Desfavorables']);
			
			$.each(serviciosPonderados, function(index, s) {
				if (s['nombre'] == item['nombre'] //cualificacion
					&& s['codigoServicioUnificado'] == item['servicioUnificado']
					&& s['faseInspeccion'] == item['faseInspeccion']
					)
					{
						item['ponderado'] = parseInt(item['Total']) * parseFloat(s['ponderacion']);	
						item['servicio'] = s['descripcionServicioUnificado'] ;	
						return false;							}
					});
						
				if (item['servicio'] == undefined)
					console.log (item);
						
				item['inspectorNombre'] = inspectores[item['CodigoInspector']];
				item['rechazo'] = parseInt(item['Desfavorables']) * 100 / parseInt(item['Total']);
				datosPonderados.push(item);
			});
			
			
			$('#rechazoEstacion').text( ((TotalDesfavorablesComputadas/TotalInspeccionesComputadas) * 100).toFixed(2) );
			
			var source =
			{
			   localdata: datosPonderados,
			   datatype: "array",
			   datafields:
			   [
			   	  { name: 'root', type: 'string' },
			      { name: 'Total', type: 'number' },
			      { name: 'Favorables', type: 'number' },
			      { name: 'Desfavorables', type: 'number' },
			      { name: 'inspectorNombre', type: 'string' },
			      { name: 'servicio', type: 'string' },
			      { name: 'faseInspeccion', type: 'number' },
			      { name: 'nombre', type: 'string' },
			      { name: 'estacion', type: 'string' },
			      { name: 'categoria', type: 'number' },
			      { name: 'rechazo', type: 'number' },
			      //{ name: 'valorEconomico', type: 'number' },
			   ]
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			dataAdapter.dataBind();
				
			var pivotDataSource = new $.jqx.pivot(
			   dataAdapter,
			   {
			   	 customAggregationFunctions: {
			   	 	'indiceRechazo' : function (values) {
                           return 0;
                        }
			   	 },
				 pivotValuesOnRows: false,
				 totals: {rows: {subtotals: true, grandtotals: true}, columns: {subtotals: false, grandtotals: true}},
                    
				 columns: [{ dataField: 'root'}, { dataField: 'servicio'},  ],
				 rows: [ { dataField: 'inspectorNombre'},{ dataField: 'faseInspeccion'}, { dataField: 'nombre'},{ dataField: 'categoria'}, ],
					    
					     values: [
					       { dataField: 'Total', 'function' : 'sum', text: 'Inspecciones'},
					       { dataField: 'Favorables', 'function' : 'sum', text: 'Favorables' },
						   { dataField: 'Desfavorables', 'function' : 'sum', text: 'Desfavorables' },
						   { dataField: 'rechazo', 'function' : 'indiceRechazo', text: 'Índice Rechazo', formatSettings: { prefix: '', decimalPlaces: 2}  },
						  // { dataField: 'valorEconomico', 'function': 'sum', text: '€' , formatSettings: { sufix: '€', decimalPlaces: 2} } ,
					     ]
					   }
					);
	  
	  				$(selector).jqxPivotGrid(
					   {
					   	  
					      source: pivotDataSource,
					      treeStyleRows: false,
					      multipleSelectionEnabled: true,
					      cellsRenderer: function (pivotCell) {
				                var getSpecificRow = function (cells, rows, columns, id) {
				                    var specificRow = null;
				                    for (var i = 0; i < myPivotGridRows.items.length; i++) {
				                        var currentRow = myPivotGridRows.items[i]
				                        var currentRowInnerItems = currentRow.items;
				                        if (1 < currentRowInnerItems.length && currentRow.id == id) {
				                            specificRow = currentRow;
				                            break;
				                        }
				                    }
				                    return specificRow;
				                };
				                
				                var myPivotGridCells = $('#PivotGrid').jqxPivotGrid('getPivotCells');
				                var myPivotGridRows = $('#PivotGrid').jqxPivotGrid('getPivotRows');
				                var myPivotGridColumns = $('#PivotGrid').jqxPivotGrid('getPivotColumns');
				                
								
								if (pivotCell.pivotColumn.text == 'Índice Rechazo')
								{
									var columnInspeccionesTotales;
									var columnDefavorables;
									$.each(myPivotGridColumns.items, function(index, item){
										$.each(item.valueItems, function(index1, item1){
											switch (item1.text) {
												case 'Inspecciones':
													 columnInspeccionesTotales = item1;
													break;
												case 'Desfavorables':
													 columnDefavorables = item1;
													break;
											}
										});
									});
									var Inspecciones = myPivotGridCells.getCellValue(pivotCell.pivotRow, columnInspeccionesTotales);
									var Desfavorables = myPivotGridCells.getCellValue(pivotCell.pivotRow, columnDefavorables);
									//console.log( (Desfavorables.value / Inspecciones.value) * 100 );
									
									var indiceRechazo = parseFloat(((Desfavorables.value / Inspecciones.value) * 100 )).toFixed(2);
									var icon = '';
									var style ='';
									if ( indiceRechazo  > parseFloat($('#rechazoEstacion').text()) + desviacionTipica)
									{
										icon =  '<span class="glyphicon glyphicon-arrow-up"></span> ';
										style = 'background-color: #f8efc0 ;';
									}
									if ( indiceRechazo  < parseFloat($('#rechazoEstacion').text())  - desviacionTipica)
									{
										icon =  '<span class="glyphicon glyphicon-arrow-down"></span> ';
										style = 'background-color: #e7c3c3;';
									}
									
									
									return '<div style="'+style+' height:100%;">'+ icon + indiceRechazo +'</div>'; 
									
								}
								
				                return pivotCell.value == 0 ? '' : pivotCell.formattedValue;;
				            },
					   }
					);
		
		
	}
	
	
	
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>