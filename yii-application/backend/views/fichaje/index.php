<?php

use yii\helpers\Html;

use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fichajes';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
	.loaderContainer{
	  margin: auto;
	  width: 50%;
	 /* border: 3px solid green;*/
	  padding: 10px;
	  text-align:center;	
	  
	}
	
	.loader {
	  border: 16px solid #f3f3f3; /* Light grey */
	  border-top: 16px solid #3498db; /* Blue */
	  border-radius: 50%;
	  width: 120px;
	  height: 120px;
	  animation: spin 2s linear infinite;
	  display: inline-block
	}
	
	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}
</style>
<div class="fichaje-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<label for="dia">Seleccione un día:</label>
	<?php echo DatePicker::widget([
    	'name'  => 'dia',
		'id' => 'dia',
    	'language' => 'es',
    	'dateFormat' => 'dd-MM-yyyy',
		]);
	?>
	

   <div id='contenido'>
   		<div class="loaderContainer">
   			<div class="loader"></div>	
   		</div>
   		
   </div>

   
</div>
<?php
$script = <<< JS
	jQuery('#dia').change(function(){
			
		recuperaDia(jQuery(this).val());
	})
	
	
	function recuperaDia(dia)
	{
		jQuery('#contenido').empty();
		jQuery('#contenido').append('<div class="loaderContainer"><div class="loader"></div></div>');			
		$.ajax({
			      url: 'http://192.168.23.40:8082/backend/index.php?r=fichaje%2Fajax-fichajes&dia='+dia,
			      dataType:"json",
			   	  type: 'post',
			    }).done( function(data) {
			         fichadas =  data;
			        
			         var table =  jQuery(`<table><thead>
			         	<th>Hora Entrada</th><th>Hora Salida</th><th>Tiempo</th>
			         	<th>Salida Almuerzo</th><th>Entrada Almuerzo</th><th>Tiempo Almuerzo</th>
			         	<th>Entrada Formación</th><th>Salida Formación</th><th>Tiempo Formación</th>
			         	<th>Tiempo efectivo</th><th>Persona</th></thead></table>`).addClass('table table-striped table-bordered');
			         var tbody;
			         
			         var estacion="";
					 for(i=0; i<fichadas.length; ++i)
					 {
					 	if (i==0)
						{
							estacion=fichadas[i].codigoEstacion;
							nombre = fichadas[i].nombreEstacion;
							cuantos = fichadas.filter(function(fichada){return fichada.codigoEstacion==estacion;});
					 		tbody = jQuery('<tbody id='+estacion+'><tr><th colspan=4>'+estacion+' '+nombre+' ('+cuantos.length+')</th></tr></tbody>');
							
						}
					 	if(estacion!=fichadas[i].codigoEstacion)
					 	{
					 		table.append(tbody);
						
					 		estacion=fichadas[i].codigoEstacion;
							nombre = fichadas[i].nombreEstacion;
							cuantos = fichadas.filter(function(fichada){return fichada.codigoEstacion==estacion;});
					 		tbody = jQuery('<tbody id='+estacion+'><tr><th colspan=4>'+estacion+' '+nombre+' ('+cuantos.length+')</th></tr></tbody>');
					 	}	
					 	
					 	var row ='<tr>';
						
					 	row +='<td>';
					 	row +='<a href="index.php?r=fichajes/update&id='+fichadas[i].idEntrada+'">'+fichadas[i].entrada+'</a>';
					 	row +='</td>';
					 	row +='<td>';
					 	row += (fichadas[i].idEntrada != null && fichadas[i].idSalida==null? 
									`<a class="btn btn-sm btn-danger" href="index.php?r=fichajes/cerrar" data-method='post' data-confirm="Estas seguro" data-params='{"Fichajes[idUser]": `+fichadas[i].idUser+`,"Fichajes[fechaHora]":"`+fichadas[i].fechaHora+`", "Fichajes[idAccion]":"2"}'>Cerrar</a>`
									: 
									(fichadas[i].idEntrada == null ?
										''
										:
										'<a href="index.php?r=fichajes/update&id='+fichadas[i].idSalida+'">'+fichadas[i].salida+'</a>'
										)
									);
					 	row +='</td>';
					 	row +='<td>';
					 	row += fichadas[i].tiempo;
					 	row +='</td>';
					 	
						row += '<td>'+ 
								( fichadas[i].idEntradaAlmuerzo == null? 
									'' 
									:
									'<a href="index.php?r=fichajes/update&id='+fichadas[i].idEntradaAlmuerzo+'">'+fichadas[i].horaEntradaAlmuerzo+'</a>'
								)+'</td>';
					 	
					 	row += '<td>'+ 
					 			( fichadas[i].idEntradaAlmuerzo != null && fichadas[i].idSalidaAlmuerzo==null? 
					 				`<a class="btn btn-sm btn-danger" href="index.php?r=fichajes/cerrar" data-method='post' data-confirm="Estas seguro" data-params='{"Fichajes[idUser]": `+fichadas[i].idUser+`,"Fichajes[fechaHora]":"`+fichadas[i].fechaHora+`", "Fichajes[idAccion]":"4"}'>Cerrar</a>`
									:
									( fichadas[i].idSalidaAlmuerzo == null?
										''
										:
										'<a href="index.php?r=fichajes/update&id='+fichadas[i].idSalidaAlmuerzo+'">'+fichadas[i].horaSalidaAlmuerzo+'</a>'
									)
									
								)+'</td>';
					 	
					 	row +='<td>'+ (fichadas[i].tiempoAlmuerzo==null? '': fichadas[i].tiempoAlmuerzo) + '</td>';
						row += '<td><a href="index.php?r=fichajes/update&id='+fichadas[i].idEntradaFormacion+'">'+(fichadas[i].horaEntradaFormacion==null? '': fichadas[i].horaEntradaFormacion)+'</a></td>';
					 	row += '<td><a href="index.php?r=fichajes/update&id='+fichadas[i].idSalidaFormacion+'">'+(fichadas[i].horaSalidaFormacion == null? '': fichadas[i].horaSalidaFormacion)+'</a></td>';
					 	row +='<td>'+ (fichadas[i].tiempoFormacion==null? '':fichadas[i].tiempoFormacion) + '</td>';
						
						row +='<td>'+ fichadas[i].tiempoEfectivo  + '</td>';
						row +='<td>';
					 	row += '<a target= "_blank" href="http://192.168.23.40:8082/backend/index.php?r=fichaje%2Festadistica-trabajador&usuario='+fichadas[i].id+'">'+fichadas[i].nombre+ ' '+ fichadas[i].apellidos+'</a>';
					 	row +='</td>';
					 	row +='</tr>';
					 	row = jQuery(row);
						tbody.append(row);
						if (i==fichadas.length-1)
						{
							table.append(tbody);
						}
					 }
					 
					jQuery('#contenido').empty();
					jQuery('#contenido').append(table);					       
			        
			      });			
	}

	jQuery(document).ready(function(){
		var dia = '$fecha';
		if (dia !== '')
		{
			jQuery('#dia').val(dia);
			recuperaDia(dia);
		}
	});
	 	    
		
JS;
$this->registerJs($script);
?>