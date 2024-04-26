<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\ArrayHelper;


use backend\assets\JqWidgetsAsset;
JqWidgetsAsset::register($this);


/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inspecciones por código postal';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
	.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 80px;
  height: 80px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div class="vencimientos-index">

   <h1><?= Html::encode($this->title) ?></h1>
   <div class="row">
		<div class="col-xs-2">
			<label for="fechaDesde1">Fecha desde<input type="date" class="form-control input-sm" id="fechaDesde1" name="fechaDesde1"/></label>
			<label for="fechaDesde2">Fecha desde<input type="date" class="form-control input-sm" id="fechaDesde2" name="fechaDesde2"/></label>
		</div>
		<div class="col-xs-2">
			<label for="fechaHasta1">Fecha hasta<input type="date" class="form-control input-sm" id="fechaHasta1" name="fechaHasta1"/></label>
			<label for="fechaHasta2">Fecha hasta<input type="date" class="form-control input-sm" id="fechaHasta2" name="fechaHasta2"/></label>
		</div>
		<div class="col-xs-2">
			<label for="estacionesITV">Estación
			<?= Html::dropDownList('estacionesITV[]',null, ArrayHelper::map($estaciones,'codigo','nombre'), ['multiple' => 'multiple', 'class' => 'form-control input-sm', ]); ?>
			</label>
		</div>
		<div class="col-xs-2">
			<label for="categoriasVehiculos">Municipios
			<?= Html::dropDownList('municipios[]',null, ArrayHelper::map($municipios,'codigoMunicipio', 'nombreMunicipio'), ['multiple' => 'multiple', 'class' => 'form-control input-sm', ]); ?>
			</label>
		</div>
		<div class="col-xs-2">
			<button name="cargarDatos" class="btn btn-default">Cargar</button>
			<div class="loader"></div>
		</div>
	</div>
	<hr>
	
    
    
	<div class="row">
		<div class="col-xs-2">
			<label > Total municipios <span  id="total" class="badge badge-light">0</span></label>
		</div>        
		<div class="col-xs-2 pull-right">
			<button type="button" class='btn btn-info' value="Exportar" id='excelExport' >
				<span class="glyphicon glyphicon-export" aria-hiden="true"></span> Exportar
			</button>
    	</div>
   </div>
    <div class="row">
    	<div class="col-xs-6">
    		<label for='#grid1'>Criterio 1</label>
			<div id="grid1"></div>
		</div>
		<div class="col-xs-6">
			<label for='#grid2'>Criterio 2</label>
			<div id="grid2"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6"><button id="zoomIn">+</button><button id="zoomOut">-</button></div>
		<div class="col-xs-6"><button id="zoomIn">+</button><button id="zoomOut">-</button></div>
	</div>
	<div class="row">
		<div class="col-xs-6">
		
			<?= /*Yii::getAlias('@web');*/  file_get_contents( '/var/www/tickadas/backend/web/imagenes/Municipalities_of_Spain_2.svg'); ?></div>
		<div class="col-xs-6">
			
			<?= /*Yii::getAlias('@web');*/  file_get_contents( '/var/www/tickadas/backend/web/imagenes/Municipalities_of_Spain_2.svg'); ?></div>
	</div>
	
    
</div>
<div class='info' style="position: absolute; z-index: 2030; background-color:green; top:0; left:0">Mensaje</div>
<?php


$script=<<<EOT
	
	
	
	function rgb(minimum, maximum, value){
    
    var ratio = 2 * (value-minimum) / (maximum - minimum);
    b = parseInt(Math.max(0, 255*(1 - ratio)));
    r = parseInt(Math.max(0, 255*(ratio - 1)));
    g = 255 - b - r;
    return [r, g, b]
	}
	
	function rgb2(minimum, maximum, value)
	{
		var a = [255,255,0];
		var b = [255,0,0];
		 
		val = ((value - minimum) / (maximum - minimum));
console.log(val);		  
		red   = parseFloat((b[0] - a[0]) * val + a[0]);      // Evaluated as -255*value + 255.
		green = parseFloat((b[1] - a[1]) * val + a[1]);      // Evaluates as 0.
		blue  = parseFloat((b[2] - a[2]) * val + a[2]);      // Evaluates as 255*value + 0.
		
		return [red, green, blue];
	}
	
	$(document).ready(function(){
		$('.loader').hide();
		
		
	});
	
	
	
//Eventos:
	$(document).ready(function(){
		var svg = $('svg');
		
		$.each(svg, function(key, item){ $(item).attr('id', 'svg'+key);  });
	});
	
	$(document).on('mouseover', 'path', function(event){
		if ($(this).data('nombre')=='undefined')
		{
			$('.info').hide();
			return;
		}
		
		console.log($(this).data('nombre') +':' + $(this).data('total')+':'+$('.info').height()); 
		$('.info').text($(this).data('nombre') +':' + $(this).data('total'));
        $('.info').css({top: top,left: left}).show();
		
		var left =event.pageX; // $(this).offset().left;
        var top = event.pageY - $('.info').height(); //$(this).offset().top ;
		$('.info').text($(this).data('nombre') +':' + $(this).data('total'));
        $('.info').css({top: top,left: left}).show();
	});
	
	$(document).on('click', '#zoomIn', function(){
		var svg = document.getElementsByTagName('svg')[0];
		
		var bbox = svg.getBBox();
		var viewBox = svg.viewBox;
		vbox = viewBox.split(' ');
		vbox[0] = parseFloat(vbox[0]);
		vbox[1] = parseFloat(vbox[1]);
		vbox[2] = parseFloat(vbox[2]);
		vbox[3] = parseFloat(vbox[3]);
		
		// the current center of the viewBox
		var cx=vbox[0]+vbox[2]/2;
		var cy=vbox[1]+vbox[3]/2;
		
		
		// the new scale
		var scale = bbox.width*matrix.a/vbox[2] * 1.2;
		
		var scaled_offset_x = absolute_offset_x + vbox[2]*(1-scale)/2;
		var scaled_offset_y = absolute_offset_y + vbox[3]*(1-scale)/2;
		var scaled_width = vbox[2]*scale;
		var scaled_height = vbox[3]*scale;
		
		svg.setAttribute("viewBox", ""+scaled_offset_x+" "+scaled_offset_y+" "+scaled_width+" "+scaled_height);
	});
		
	$(document).on('click','button[name="cargarDatos"]', function(){
		$('[name="cargarDatos"]').hide();
		
		cargarDatos('#grid1',  $('input[name="fechaDesde1"]').val(), $('input[name="fechaHasta1"]').val(), '#svg0');
		cargarDatos('#grid2',  $('input[name="fechaDesde2"]').val(), $('input[name="fechaHasta2"]').val(), '#svg1');
		$('.loader').show();
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
	function cargarDatos(selector, fechaDesde, fechaHasta, mapa)
	{
		$('label[for="'+selector.replace('#','')+'"]').val(fechaDesde+' '+fechaHasta);
		
		var sql = 'select sum(Total) total, d_codigosPostales.nombreMunicipio municipio, d_codigosPostales.codigoMunicipio from ( SELECT count(inspecciones.InformeMecanica) Total, CodigoPostal, Municipio FROM estadisticasITEVEBASA.inspecciones where FaseInspeccion=1 and str_to_date(FechaInspeccion, "%d%m%Y") between :fechaDesde and :fechaHasta and Estacion in (:estacion) group by CodigoPostal, Municipio ) drvTbl inner join (SELECT distinct codigoPostal, codigoMunicipio, nombreMunicipio FROM estadisticasITEVEBASA.d_codigosPostales group by codigoPostal, codigoMunicipio, nombreMunicipio) d_codigosPostales on drvTbl.codigoPostal = d_codigosPostales.codigoPostal where codigoMunicipio in (:municipios) group by d_codigosPostales.nombreMunicipio,  d_codigosPostales.codigoMunicipio order by total desc;';
		
		
		var parametros = {
				':estacion' :  $('select[name="estacionesITV[]"]').val(),
				':fechaDesde' : fechaDesde,
				':fechaHasta' : fechaHasta,
				
				':municipios' : $('select[name="municipios[]"]').val()
				
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
					$('[name="cargarDatos"]').show();
					$('.loader').hide();
					datos = $.parseJSON(data) ;
					dataJson = datos;
					
					$(mapa).find('path[data-code^="muni_"]').css({ fill: "#ffffff" });
					
					if(datos.length == 0 ) return;
					
					var maximo = parseInt(dataJson[0].total);
					var minimo = parseInt(dataJson[dataJson.length-1].total);
					$.each(dataJson, function(key, item){
						$(mapa).find('[data-code="muni_'+item['codigoMunicipio']+'"]').data('nombre', item['municipio']);
						$(mapa).find('[data-code="muni_'+item['codigoMunicipio']+'"]').data('total', item['total']);
						
						$(mapa).find('[data-code="muni_'+item['codigoMunicipio']+'"]').css( 'fill' , 'rgb('+rgb2(minimo, maximo, parseInt(item['total']))+')');
					})
					
					cargarGrid (selector, datos)
				},
				error:function (data) {
					$('[name="cargarDatos"]').show();
					$('.loader').hide();
					console.log('Incio errores');
					console.log(data);
					console.log('Fin errores');
					return false;
				}	
			});		
		
	}
	
	function cargarGrid (selector, data)
	{
		$(selector).jqxGrid('clear');
		
		$('#total1').text(datos.length);
		
		//$(selector).empty();
		
		if(datos.length == 0 ) return;
		
		 
		var source =
            {
                localdata: data,
                datatype: "array",
                datafields:
                [
                    { name: 'total',  type: 'number' },
                    { name: 'municipio',  type: 'string' },
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
                  { text: 'Municipio', datafield: 'municipio', width: 400 },
                  { text: 'Total', datafield: 'total', width: 200 }
                 
                  
                 
                ]
            });
			
			
	}


	
	
	
	
	
	
	
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>