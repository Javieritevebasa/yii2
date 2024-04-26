    <?php ?>
    <h1><?=$model->estacion->codigo ?></h1>
	<div class="container-fluid">
		

		        	
	<div class="btn-group cola" role="group" aria-label="Basic example">
  		
  		
	</div>

	<div class="row">
		<?php foreach ($model->estacion->zonasProduccion as $l => $linea) : ?>
		<div class="col-sm">
	      	<div class="card">
	      	  
		      <div class="card-body">
		        <h5 class="card-title d-flex justify-content-center "><?=$linea->nombre ?></h5>
		        <div class="linea-<?=$linea->codigoZonaProduccion ?>">
			        
			      
		        </div>
		      </div>
			</div>
	    </div>
	    	
		<?php endforeach; ?>
		
	</div>
	<div class="btn-group enEstacion" role="group" aria-label="Basic example">
  		
  		
	</div>
	
<?php

$estacion = $model->estacion->codigo;
$script = <<< JS
	var id = setInterval(function() {
		 $.ajax({
	       url: 'index.php?r=colasws/vehiculos-en-cola',
	       type: 'get',
	       data: {
	                 estacion: "$estacion", 
	             },
	       success: function (data) {
	       		$('.cola').empty();
	       		$('.enEstacion').empty();
	       		$('div[class^="linea-"]').empty();
	          	data['enCola'].filter(function(item){
	          		if(!item['horaInicioInspeccion']){
	          			$('.cola').append('<button type="button" class="btn btn-default" style="font-size: 0.6rem;"><img class="img-fluid" src="imagenes/car.svg" style="margin: 1px; display:block"/>'+item['matricula']+'</button>');
	          		}
					else{
						//console.log(item);
						$('.linea-'+item['linea']).append('<p class="d-flex justify-content-center _'+item['servicio']+'"><img src="imagenes/car.svg" style="transform: rotate(+90deg); height:16px; margin: 1px; display:block" data-toggle="tooltip" data-placement="top" title="'+item['matricula']+'"/></p>');
					}
	          	});
	          	data['inspectoresEstacion'].filter(function(item){
	          		if(!item['IniciadaInspeccion']){
	          			$('.enEstacion').append('<button type="button" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="'+item['nombre']+'">'+item['TiempoParado']+'<img src="imagenes/mecanico.svg" style="width:64px; margin: 1px; display:block"/></button>');
	          		}
					else{
						
						//$('.linea-'+item['linea']+' p').append('<img src="imagenes/mecanico.svg" style="height:16px; margin: 1px; display:block"/>');
						$('p._'+item['servicio']).append('<img src="imagenes/mecanico.svg" style="height:16px; margin: 1px; display:block" data-toggle="tooltip" data-placement="top" title="'+item['nombre']+'"/>');
						
					}
	          	});
	          	//console.log(data['inspectoresEstacion']);
	          
       			},
       		error: function (data){
       			console.log(data);
       		}
  		});
	}, 5000); // 30 seconds	
	 	    
		
JS;
$this->registerJs($script);
?>