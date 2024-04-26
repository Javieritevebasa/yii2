<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\ArrayHelper;


use backend\assets\JqWidgetsAsset;
JqWidgetsAsset::register($this);


/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vencimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vencimientos-index">

   <h1><?= Html::encode($this->title) ?></h1>
   <div class="row">
		<div class="col-xs-2">
			<label for="fechaDesde">Fecha desde<input type="date" class="form-control input-sm" id="fechaDesde" name="fechaDesde"/></label>
		</div>
		<div class="col-xs-2">
			<label for="fechaHasta">Fecha hasta<input type="date" class="form-control input-sm" id="fechaHasta" name="fechaHasta"/></label>
		</div>
		<div class="col-xs-2">
			<label for="estacionesITV">Estación
			<?= Html::dropDownList('estacionesITV[]',null, ArrayHelper::map($estaciones,'codigo','nombre'), ['multiple' => 'multiple', 'class' => 'form-control input-sm', ]); ?>
			</label>
		</div>
		<div class="col-xs-2">
			<label for="categoriasVehiculos">Categorías
			<?= Html::dropDownList('categoriasVehiculos[]',null, ArrayHelper::map($categorias,'nombre','nombre'), ['multiple' => 'multiple', 'class' => 'form-control input-sm', ]); ?>
			</label>
		</div>
		<div class="col-xs-2">
			<button name="cargarDatos" class="btn btn-default">Cargar</button>
		</div>
	</div>
	<hr>
	
    
    
	<div class="row">
		<div class="col-xs-2">
			<label > Total vehículos <span  id="total" class="badge badge-light">0</span></label>
		</div>        
		<div class="col-xs-2 pull-right">
			<button type="button" class='btn btn-info' value="Exportar" id='excelExport' >
				<span class="glyphicon glyphicon-export" aria-hiden="true"></span> Exportar
			</button>
    	</div>
   </div>
    <div class="row">
    	<div class="col-xs-12">
			<div id="grid"></div>
		</div>
	</div>
	 
	

    
</div>
<?php


$script=<<<EOT
	
	

	$(document).ready(function(){
		
	});
	
//Eventos:	
	$(document).on('click','button[name="cargarDatos"]', function(){
		
		cargarDatos('#grid');
		
	});
	
	$("#excelExport").click(function () {
    	var csv = Papa.unparse(dataJson, {
    		quotes: true,
			quoteChar: '"',
			delimiter: ";",
			header: true,});

	    var csvData = new Blob([csv], {type: 'text/csv;charset=utf-8;'});
	    var csvURL =  null;
	    if (navigator.msSaveBlob)
	    {
	        csvURL = navigator.msSaveBlob(csvData, 'download.csv');
	    }
	    else
	    {
	        csvURL = window.URL.createObjectURL(csvData);
	    }
	
	    var tempLink = document.createElement('a');
	    tempLink.href = csvURL;
	    tempLink.setAttribute('vencimientos', 'vencimientos.csv');
	    tempLink.click(); 
    
     });
//Fin eventos	
	
	
	
	var dataJson = [];
	function cargarDatos(selector)
	{
		var sql = 'select str_to_date(FechaProximaInspeccion, "%d%m%Y") FechaVencimiento, str_to_date(FechaInspeccion, "%d%m%Y") FechaInspeccion, CodigoPostal, Municipio, Matricula, Marca, Tipovehiculo, concat(CodigoConstruccion, CodigoUtilizacion) Clasificacion, Nombre, Telefono1 from inspecciones where TipoInspeccion = :tipoInspeccion and str_to_date(FechaProximaInspeccion, "%d%m%Y") between :fechaDesde and :fechaHasta and Estacion in (:estacion) and Categoria in (:categoriasVehiculos)';
		
		
		var parametros = {
				':estacion' :  $('select[name="estacionesITV[]"]').val(),
				':fechaDesde' : $('input[name="fechaDesde"]').val(),
				':fechaHasta' : $('input[name="fechaHasta"]').val(),
				':tipoInspeccion' : '001',
				':categoriasVehiculos' : $('select[name="categoriasVehiculos[]"]').val()
				
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
	
	function cargarGrid (selector, data)
	{
		
		$('#total').text(datos.length);
		
		
		var source =
            {
                localdata: data,
                datatype: "array",
                datafields:
                [
                    { name: 'FechaVencimiento',  type: 'date' },
                    { name: 'FechaInspeccion',  type: 'date' },
                    { name: 'CodigoPostal', type: 'string' },
                    { name: 'Municipio', type: 'string' },
                    { name: 'Matricula', type: 'string' },
                    { name: 'Marca', type: 'string' },
                    { name: 'Nombre', type: 'string' },
                    { name: 'Clasificacion', type: 'string' },
                    { name: 'Titular', type: 'string' },
                    { name: 'Telefono1', type: 'string' },
                    
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
                  { text: 'Fecha Vencimiento', datafield: 'FechaVencimiento', width: 120, align: 'right', cellsalign: 'right', cellsformat: 'dd-MM-yyyy' },
                  { text: 'Fecha Inspección', datafield: 'FechaInspeccion', width: 120, align: 'right', cellsalign: 'right', cellsformat: 'dd-MM-yyyy' },
                  { text: 'Código Postal', datafield: 'CodigoPostal', width: 130 },
                  { text: 'Municipio', datafield: 'Municipio', width: 200 },
                  { text: 'Mátricula', datafield: 'Matricula', width: 200 },
                  { text: 'Marca', datafield: 'Marca', width: 200 },
                  { text: 'Model', datafield: 'TipoVehiculo', width: 200 },
                  { text: 'Clasificación', datafield: 'Clasificacion', width: 200 },
                  { text: 'Titular', datafield: 'Nombre', width: 200 },
                  { text: 'Teléfono', datafield: 'Telefono1', width: 200 },
                  
                 
                ]
            });
			
			
	}


	
	
	
	
	
	
	
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>