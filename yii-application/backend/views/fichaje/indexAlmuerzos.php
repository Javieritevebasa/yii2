<?php

use yii\helpers\Html;

use yii\jui\DatePicker;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Almuerzos';
$this->params['breadcrumbs'][] = $this->title;
?>
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
   	<div id='contenido'></div>
	
   
</div>
<?php
$script = <<< JS
	jQuery('#dia').change(function(){
			
		recuperaDia(jQuery(this).val());
	})
	
	
	function recuperaDia(dia)
	{
		jQuery.ajax({
			      // have to use synchronous here, else the function 
			      // will return before the data is fetched
			      async: false,
			      url: 'http://192.168.23.40:8082/backend/index.php?r=fichaje%2Fajax-almuerzos&dia='+dia,
			      dataType:"json",
			      error: function(data){console.log(data);},
			      success: 
			      function(data) {
			         fichadas =  data;
			        
			         var table =  jQuery('<table class="table table-striped table-bordered"></table>').addClass('table');
			         table.append('<thead><th>Salida a almorzar</th><th>Vuelta de almorzar</th><th>Tiempo empleado</th><th>Persona</th></thead>');
			         var tbody;
			         
			         var estacion="";
					 for(i=0; i<fichadas.length; ++i)
					 {
					 	if (i==0)
						{
							estacion=fichadas[i].codigoEstacion;
							nombre =fichadas[i].nombreEstacion;
							cuantos = fichadas.filter(function(fichada){return fichada.codigoEstacion==estacion;});
					 		tbody = jQuery('<tbody id='+estacion+'><tr><th colspan=4>'+estacion+' '+nombre+' ('+cuantos.length+')</th></tr></tbody>');
							
						}
					 	if(estacion!=fichadas[i].codigoEstacion)
					 	{
					 		table.append(tbody);
						
					 		estacion=fichadas[i].codigoEstacion;
							nombre =fichadas[i].nombreEstacion;
							cuantos = fichadas.filter(function(fichada){return fichada.codigoEstacion==estacion;});
					 		tbody = jQuery('<tbody id='+estacion+'><tr><th colspan=4>'+estacion+' '+nombre+' ('+cuantos.length+')</th></tr></tbody>');
					 	}	
						 
					 	var row ='<tr>';
					 	row +='<td>';
					 	row += fichadas[i].entrada;
					 	row +='</td>';
					 	row +='<td>';
					 	row += fichadas[i].salida;
					 	row +='</td>';
					 	row +='<td>';
					 	row += fichadas[i].tiempo;
					 	row +='</td>';
					 	row +='<td>';
					 	row += '<a target= "_blank" href="http://192.168.23.40:8082/backend/index.php?r=user%2Fview&id='+fichadas[i].id+'">'+fichadas[i].nombre+ ' '+ fichadas[i].apellidos+'</a>';
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
			        
			      },
			     
			    });			
	}
	 	    
		
JS;
$this->registerJs($script);
?>