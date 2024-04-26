<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\web\View;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sisgesdev\models\DesviacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (isset($origen))
{
	$this->title = 'Desviaciones';
}
else {
	$this->title = 'Mis desviaciones';
}
use backend\assets\JqWidgetsAsset;
JqWidgetsAsset::register($this);


?>



<div class="desviacion-index">
	<div class="btn-toolbar  pull-right" role="toolbar">
		<?php if (isset($origen)) :?>
			<?= Html::a('<span class="glyphicon glyphicon-plus"></span> Añadir desviación', ['desviacion/create', 'origen' => $origen], ['class' => 'btn btn-primary btn-xs']) ?>
		<?php endif;?>	
	</div>
	<h3><?= $this->title?></h3>
	
	<?php foreach ($desviaciones as $key => $desviacion): 
		
		?>
		<div class="panel panel-primary">
		  <div class="panel-heading">
		  	<div class="btn-toolbar  pull-right" role="toolbar">
				<div class="btn-group">
					<?= Html::a('<span class="glyphicon glyphicon-plus"></span> Añadir hallazgo', ['hallazgo/create', 'desviacionId' => $desviacion->id], ['class' => 'btn btn-default btn-xs']) ?>
					
		  	 		<?= Html::a('<span class="glyphicon glyphicon-screenshot"></span> Alegar hallazgos', ['sisgesdev/create-alegacion', 'desviacionId' => $desviacion->id], ['class' => 'btn btn-default btn-xs']) ?>
		  			
		  			<?= Html::a('<span class="glyphicon glyphicon-plus"></span> Añadir aclaración', ['desviacion/aclarar', 'desviacionId' => $desviacion->id], ['class' => 'btn btn-default btn-xs']) ?>
					
					<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['desviacion/update', 'id' => $desviacion->id], [
							           'class' => 'btn btn-default btn-xs',
						]) ?>
					<?= Html::a('<span class="glyphicon glyphicon-off"></span>', ['desviacion/cerrar', 'id' => $desviacion->id], [
							           'class' => 'btn btn-default btn-xs', 'title' => 'Cerrar desviación'
						]);
						
						?>
					
				  	<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['desviacion/delete', 'id' => $desviacion->id], [
							           'class' => 'btn btn-default btn-xs',
							            'data' => [
							                'confirm' => '¿Estás seguro que quieres eliminarlo',
							                'method' => 'post',
							            ],
						]) ?>
				</div>
				<div class="btn-group">
					<a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#desviacion<?= $desviacion->id?>"><span class="glyphicon glyphicon-chevron-down"></span></a>
				</div>
			</div>
			<h3 class="panel-title" style="padding-top: 7.5px;">
				<?php
				$hoy = new DateTime();
				echo ( DateTime::createFromFormat('Y-m-d',$desviacion->fechaLimite) < $hoy) ? '<span class="glyphicon glyphicon-warning-sign text-white"></span>' : '' ?> Desviación <?= $desviacion->numero; ?> del informe <?=  Html::a($desviacion->origen0->numeroExpediente , ['sisgesdev/view-form', 'origen' => $desviacion->origen0->id], ['class' => 'text-white', 'style'=> 'color: white !important;']) ?> 
				<br>[<?= $desviacion->responsable0->nombre.' '.$desviacion->responsable0->apellidos ?>]
				<!--
				[<?= $desviacion->fechaCierre == null? 'Pendiente de cerrar desde '.Yii::$app->formatter->asDate($desviacion->fecha) : 'Cerrado: '. Yii::$app->formatter->asDate($desviacion->fechaCierre) ?>]
				[Plazo hasta el <?= Yii::$app->formatter->asDate($desviacion->fechaLimite) ?>]
				[<?= $desviacion->fechaValidacion == null? 'Sin validar ' : 'Validado el: '. Yii::$app->formatter->asDate($desviacion->fechaValidacion) ?>]
				-->
			</h3>
		  </div>
		  <div id="desviacion<?= $desviacion->id?>" class="panel-body collapse">
		  	<?= $desviacion->descripcion; ?> 
			<hr>
		  	<?php $form = ActiveForm::begin(['method'=>'post','action' => ['sisgesdev/tramitar'], 'options' =>['class' => 'form-inline']]); ?>
		  	<div style="padding:0.2em;">
			  	<div class="form-group pull-right">
				  	<div class="form-group">
				  		<?= Html::hiddenInput('desviacionId', $desviacion->id,[]) ?>
				        <?= Html::dropDownList('tramite', '',  ArrayHelper::map($desviacion->tratamientos, 'id', function($item){ return html_entity_decode(strip_tags ( $item->descripcion ),ENT_QUOTES, "UTF-8");}), ['class' => 'form-control', 'prompt'=>'Nuevo tratamiento', 'style' => 'width:auto;']) ?>
				    </div>
				    <div class="form-group">
				        <?= Html::submitButton('tratar', ['class' => 'btn btn-success']) ?>
				    </div>
			   	</div>
			   	<h4>Hallazgos sin tratar</h4>
		    </div>
		  	<ul class="list-group">
		  		<?php foreach ($desviacion->hallazgosNoTratados as $key => $hallazgo) : ?>
					   	<li class="list-group-item">
					   		<div class="btn-toolbar pull-right" role="toolbar">
					   			 <div class="btn-group">
					   			<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['hallazgo/update', 'id' => $hallazgo->id], [
												           'class' => 'btn btn-default btn-xs',
											]) ?>
						   		<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['hallazgo/delete', 'id' => $hallazgo->id], [
						            'class' => 'btn btn-default btn-xs',
						            'data' => [
						                'confirm' => '¿Estás seguro que quieres eliminarlo',
						                'method' => 'post',
						            ],
					        	]) ?>
						   		</div>
						   		<div class="btn-group">
						   		<?= $form->field($hallazgo, "[".$hallazgo->id."]checked")->checkbox(['label' => null, 'class' => 'btn btn-default btn-xs']); ?>
						   		</div>
						   	</div>
						   
						   <div class="panel-title" style="padding-right: 5em; text-align: justify;"><?=$hallazgo->descripcion ?></div>
			   			</li>
				<?php endforeach ?>
			</ul>
			<hr>
			<h4>Hallazgos tratados</h4>
		  	<?php 
		  	
		  	foreach ($desviacion->tratamientos as $key => $tratamiento) : ?>
		  			<?php $analisisExtension = $tratamiento->analisisExtension ?>
		  			<div class="panel panel-info">
						<div class="panel-heading"> 
							<div class="btn-toolbar  pull-right" role="toolbar">	
								   <div class="btn-group">
								   		<?= Html::a('<span class="glyphicon glyphicon-plus"></span> Añadir acción', ['accion/create', 'tratamientoId' => $tratamiento->id], [
												           'class' => 'btn btn-default btn-xs ',
											]) ?>
								   		<?= Html::a('<span class="glyphicon glyphicon-plus"></span> Añadir análisis causas', ['analisis-causa/create', 'tratamientoId' => $tratamiento->id], [
												           'class' => 'btn btn-default btn-xs',
											]) ?>
										<?= Html::a('<span class="glyphicon glyphicon-'.($analisisExtension == null ? 'plus' : 'pencil').'"></span> Análisis extensión', $analisisExtension == null ? ['analisis-extension/create' , 'tratamientoId' => $tratamiento->id] : ['analisis-extension/update', 'id' => $analisisExtension->id], [
												           'class' => 'btn btn-default btn-xs',
											]) ?>
										<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['tratamiento/update', 'id' => $tratamiento->id], [
												           'class' => 'btn btn-default btn-xs', 'title' => 'Editar tratamiento',
											]) ?>
										<?= Html::a('<span class="glyphicon glyphicon-off"></span>', ['tratamiento/cerrar', 'id' => $tratamiento->id], [
												           'class' => 'btn btn-default btn-xs', 'title' => 'Cerrar tratamiento',
												           'data' => [
												                'confirm' => '¿Estás seguro que quieres cerrar el tratamiento',
												            ]
											]) ?>
									  	<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['tratamiento/delete', 'id' => $tratamiento->id], [
												           'class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar tratamiento',
												            'data' => [
												                'confirm' => '¿Estás seguro que quieres eliminarlo',
												                'method' => 'post',
												            ],
											]) ?>
									</div>
								</div>
								<strong>
									<?=$tratamiento->descripcion ?>
									[<?= ($tratamiento->responsable0 == null) ? 'Sin responsable' : $tratamiento->responsable0->nombre.' '.$tratamiento->responsable0->apellidos ?>]
								<!--	[<?=$tratamiento->fechaCierre == null? 'Pendiente de cerrar' : 'Cerrado: '. Yii::$app->formatter->asDate($tratamiento->fechaCierre) ?>] -->
								</strong>
						</div>
					   	<div class="panel-body">
						   	<ul class="list-group">
				  			<?php foreach ($tratamiento->hallazgos as $key => $hallazgo) : ?>
							   <li class="list-group-item">
							   <div class="btn-toolbar  pull-right" role="toolbar">	
								   <div class="btn-group">
								   		<?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['hallazgo/desvincular-tratamiento', 'id' => $hallazgo->id], [
												           'class' => 'btn btn-default btn-xs', 'title' => 'Desvincular hallazgo de éste tratamiento',
											]) ?>
										<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['hallazgo/update', 'id' => $hallazgo->id], [
												           'class' => 'btn btn-default btn-xs', 'title' => 'Editar hallazago ',
											]) ?>
									  	<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['hallazgo/delete', 'id' => $hallazgo->id], [
												           'class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar hallazgo',
												            'data' => [
												                'confirm' => '¿Estás seguro que quieres eliminarlo',
												                'method' => 'post',
												            ],
											]) ?>
									</div>
								</div>
								<div class="panel-title" style="padding-right: 5em; text-align: justify;"><?=$hallazgo->descripcion ?></div>
							   </li>
							<?php endforeach ?>
							</ul>
							<div>
								<h4>Análisis de causas</h4>
								<?= ($tratamiento->analisisCausas ? '<ul class="list-group">' : 'Pendiente de análisis de causas'); ?>
								<?php foreach ($tratamiento->analisisCausas as $key => $causa) : ?>
									<li class="list-group-item">
											<div class="btn-toolbar  pull-right" role="toolbar">	
										   	<div class="btn-group">
										   		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['analisis-causa/update', 'id' => $causa->id], [
														           'class' => 'btn btn-default btn-xs', 'title' => 'Editar ',
													]) ?>
											  	<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['analisis-causa/delete', 'id' => $causa->id], [
														           'class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar',
														            'data' => [
														                'confirm' => '¿Estás seguro que quieres eliminarlo',
														                'method' => 'post',
														            ],
													]) ?>
											</div>
										</div>
									<div style="padding-right: 6em; text-align: justify;">
									<?= $causa->descripcion ?>
									</div>
									</li>
								<?php endforeach; ?>
								<?= ($tratamiento->analisisCausas ? '</ul>' : ''); ?>
							</div>
							<div>
								<h4>Análisis de extensión</h4>
								<?= ($analisisExtension !== null ? '<ul class="list-group"><li class="list-group-item"><div style="padding-right: 6em; text-align: justify;">'. $analisisExtension->descripcion.'</div></li></ul>' : 'Pendiente de análisis de extensión'); ?> 	
							</div>
							<div>
								<h4>Acciones</h4>
								<?= ($tratamiento->acciones ? '<ul class="list-group">' : 'Pendiente de acciones'); ?>
								<?php foreach ($tratamiento->acciones as $key => $accion) : ?>
									<li class="list-group-item">
										<div class="btn-toolbar  pull-right" role="toolbar">	
										   	<div class="btn-group">
										   		<?php if ($accion->evidencias !== null): ?>
										   			<?= Html::button('<span class="glyphicon glyphicon-cloud-upload"></span>', ['value'=> Url::to(['evidencia/subir-evidencias', 'accionId' => $accion->id]), 'class' => 'showModalButton btn btn-default btn-xs', 'title' => 'Subir evidencias ']) ?>
										   		<?php endif; ?>
										   		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['accion/update', 'id' => $accion->id], [
														           'class' => 'btn btn-default btn-xs', 'title' => 'Editar ',
													]) ?>
											  	<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['accion/delete', 'id' => $accion->id], [
														           'class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar',
														            'data' => [
														                'confirm' => '¿Estás seguro que quieres eliminarlo',
														                'method' => 'post',
														            ],
													]) ?>
											</div>
										</div>
									 
									<div style="padding-right: 7em; text-align: justify;">
										<span class="label label-<?= $accion->tipoAccion->class; ?>"><?= $accion->tipoAccion->nombre; ?></span>
										<?= $accion->descripcion ?>
									</div>
									</li>
								<?php endforeach; ?>
								<?= ($tratamiento->acciones ? '</ul>' : ''); ?>
							</div>
						</div>	
					</div>
				<?php endforeach ?>
				
			<!--/ul-->
			<hr>
			<h4>Hallazgos alegados</h4>
			<?php 
			
			foreach ($desviacion->alegaciones as $key => $alegacion) : ?>
				<div class="panel panel-info">
					<div class="panel-heading"> 
						<div class="btn-toolbar  pull-right" role="toolbar">	
							   <div class="btn-group">
									<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['alegacion/update', 'id' => $alegacion->id], [
													   'class' => 'btn btn-default btn-xs', 'title' => 'Editar alegacion',
										]) ?>
									
									<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['alegacion/delete', 'id' => $alegacion->id], [
													   'class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar tratamiento',
														'data' => [
															'confirm' => '¿Estás seguro que quieres eliminarlo',
															'method' => 'post',
														],
										]) ?>
								</div>
							</div>
							<strong>
							Alegación #<?= $alegacion->id ?>	
							</strong>
					</div>
					<div class="panel-body">
						<ul class="list-group">
				  			<?php foreach ($alegacion->hallazgos as $key => $hallazgo) : ?>
							   <li class="list-group-item">
							   <div class="btn-toolbar  pull-right" role="toolbar">	
								   <div class="btn-group">
								   		<?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['hallazgo/desvincular-alegacion', 'id' => $hallazgo->id], [
												           'class' => 'btn btn-default btn-xs', 'title' => 'Desvincular hallazgo de ésta alegación',
											]) ?>
										<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['hallazgo/update', 'id' => $hallazgo->id], [
												           'class' => 'btn btn-default btn-xs', 'title' => 'Editar hallazago ',
											]) ?>
									  	<?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['hallazgo/delete', 'id' => $hallazgo->id], [
												           'class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar hallazgo',
												            'data' => [
												                'confirm' => '¿Estás seguro que quieres eliminarlo',
												                'method' => 'post',
												            ],
											]) ?>
									</div>
								</div>
								<div class="panel-title" style="padding-right: 5em; text-align: justify;"><?=$hallazgo->descripcion ?></div>
							   </li>
							<?php endforeach ?>
						</ul>
							
						<?=$alegacion->descripcion ?>
					</div>
				</div>
			<?php endforeach ?>
			 <?php ActiveForm::end(); ?>
		  </div>
		</div>
	
    <?php endforeach; ?>
</div>

<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();
?>

<?php



$script=<<<EOT
	$(document).on('click', '.btn[data-toggle="collapse"]', function(e){
			e.preventDefault();
        	return;
	});
	
	$(document).on('click', '.showModalButton', function(){
        //check if the modal is open. if it's open just reload content not whole modal
        //also this allows you to nest buttons inside of modals to reload the content it is in
        //the if else are intentionally separated instead of put into a function to get the 
        //button since it is using a class not an #id so there are many of them and we need
        //to ensure we get the right button and content. 
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
            //dynamiclly set the header for the modal via title tag
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
             //dynamiclly set the header for the modal via title tag
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    })

	$(document).on('hidden.bs.modal', '#modal', function(){
		$(this).find('#modalContent').empty();
	});

	$(document).ready(function(){
		
		//	$('#PivotGrid').css("height", $('.wrap').prop('scrollHeight')-$('#PivotGrid').offset().top - 44);
	});
	
	
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>