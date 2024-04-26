<?php



use yii\web\View;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricoMantenimientosCualificaciones */
/* @var $form yii\widgets\ActiveForm */


$auxEvaluaciones = ArrayHelper::index($evaluaciones, null, 'idTipoEvaluacion');

?>

<div class="historico-mantenimientos-cualificaciones-form" data-evaluaciones="<?= count($evaluaciones)?>">

    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->errorSummary($model); ?>
	 
    <?= $form->field($model, 'idCualificacion')->dropDownList(ArrayHelper::map($cualificaciones, 'id', 'nombre'), ['prompt'=>'Selecciona una cualificación']) ?>

    <?= $form->field($model, 'idUser')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'fechaDesde')->textInput(['type'=>'date']) ?>
    
     <?= $form->field($model, 'cualificadoComo')->dropDownList(ArrayHelper::map($grupos, 'idGrupo', 'nombre'), ['prompt'=>'Para qué se cualifica']) ?>

    <?php //= $form->field($model, 'fechaHasta')->textInput(['type'=>'date']) ?>

    <?php if (isset($accion) && $accion=='update' ) echo $form->field($model, 'resultadoGlobal')->checkbox() ?>

 	<?= $form->field($model, 'examenTeorico')->fileInput() ?>
 
    <?= $form->field($model, 'idTipoMantenimientoCualificacion')->dropDownList(ArrayHelper::map($tipoMantenimientoCualificacion, 'id', 'nombre'),  ['prompt'=>'Selecciona una tipo de cualificación']) ?>
   
   	<h3>Actuaciones mínimas aaa</h3>
   	
   	<?php \yii\widgets\Pjax::begin(['id' => 'actuaciones', ]); ?>
   	<?php 
   		echo "Renderizamos ".date("Y-m-d H:i:s");
		
		if (isset($actuaciones)):
   	?>
		<?= GridView::widget([
			'dataProvider' => $actuaciones,
			'columns' => [
				'estacion',
				'informeMecanica',
				'nombre'
				
			]
		])?>
	<?php endif;?>
	<?php \yii\widgets\Pjax::end(); ?>
    <table id="actuaciones" class="table" >
    <thead>
    		<th>
     		#
     		</th>
     		<th>
     		Referencia / Nº Expediente 
     		</th>
     		<th>
     		Fecha Inspección
     		</th>
     		<th>
     		Tipo servicio
     		</th>
     	</thead>
     	<tbody>
     		
    </table>
    <hr>
     <h3>Evaluaciones in-situ tuteladas</h3>
     <table id="tuteladas" class="table" >
     	<thead>
     		<th>
     		Referencia / Nº Expediente 
     		</th>
     		<th>
     		Fecha evaluación 
     		</th>
     		<th>
     		Evaluador 
     		</th>
     		<th>
     		Resultado
     		</th>
     		<th>
     		Tipo evaluación
     		</th>
     		<th>
     		Impreso IFO-01-02-05/07/08
     		</th>
     		<th>
     			<a id="anyadirEvaluacion" class="btn btn-success" data-target="#tuteladas">Nuevo</a>
     		</th>
     	</thead>
     	<tbody>
     	
     		<tr style="display: none;" id="evaluacion">
     			<td><?= Html::textInput('referenciaEvaluacion',null, ['class' => 'form-control']);?></td>
     			<td><?= Html::textInput('fecha',null, ['class' => 'form-control', 'type' => 'date']);?></td>
     			<td><?= Html::dropdownList('evaluador',null, ArrayHelper::map($usuarios, 'id', function($item) {return $item->nombre.' '. $item->apellidos;}) ,['class' => 'form-control']);?></td>
     			<td><?= Html::dropdownList('resultado',null, [1=> 'Apto', 0 => 'No apto'] ,['class' => 'form-control']);?></td>
     			<td><?= Html::dropdownList('idTipoEvaluacion',null, [2=> 'Tutelada',] ,['class' => 'form-control']);?></td>
     			<td><?= Html::textInput('documentoIFO010205',null, ['class' => 'form-control', 'type' => 'file']);?></td>
     			<td><a class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span></a></td>
     		</tr>
     		
     		<?php 
     		$count=0;
     		if (key_exists('2', $auxEvaluaciones)){ 
     			
	     		foreach ($auxEvaluaciones['2'] as $key => $evaluacion) :
	     			
	     		?>
	     		 <tr>
				 	<td><?= $form->field($evaluacion,'['.$count.']referenciaEvaluacion')->textInput(['class' => 'form-control'])->label(false);?>
				 		<?= $form->field($evaluacion,'['.$count.']id')->hiddenInput(['class' => 'form-control'])->label(false);?>
				 	</td>
	     			<td><?= $form->field($evaluacion,'['.$count.']fecha')->textInput(['type' => 'date'])->label(false);?></td>
	     			<td><?= $form->field($evaluacion,'['.$count.']evaluador')->dropDownList(ArrayHelper::map($usuarios, 'id', function($item) {return $item->nombre.' '. $item->apellidos;}) )->label(false);?></td>
	     			<td><?= $form->field($evaluacion,'['.$count.']resultado')->dropDownList( [1=> 'Apto', 0 => 'No apto'] )->label(false);?></td>
	     			<td><?= $form->field($evaluacion,'['.$count.']idTipoEvaluacion')->dropDownList( [2=> 'Tutelada'] )->label(false);?> </td>
	     			<td>
	     				<?php if (!$evaluacion->documentoIFO010205) : ?>
	     					<?= $form->field($evaluacion, '['.$count.']documentoIFO010205')->textInput( ['type' => 'file', 'value' => $evaluacion->documentoIFO010205] )->label(false);?>
	     				<?php else: ?>
	     					<?= $evaluacion->documentoIFO010205->nombre ?>
	     				<?php endif ?>
	     			</td>
	     			<td><a class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span></a></td>
				 </tr>
				 <?php $count++; ?>	
			<?php endforeach;
			}
			?>
     	</tbody>
     </table>
    <hr/>
 	<h3>Evaluaciones in-situ supervisadas</h3>
 	<table id="supervisadas" class="table" >
     	<thead>
     		<th>
     		Referencia / Nº Expediente 
     		</th>
     		<th>
     		Fecha evaluación 
     		</th>
     		<th>
     		Evaluador 
     		</th>
     		<th>
     		Resultado
     		</th>
     		<th>
     		Tipo evaluación
     		</th>
     		<th>
     		Impreso IFO-01-02-05/07/08
     		</th>
     		<th>
     			<a id="anyadirEvaluacion" class="btn btn-success" data-target="#supervisadas">Nuevo</a>
     		</th>
     	</thead>
     	<tbody>
     	
     		<tr style="display: none;" id="evaluacion">
     			<td><?= Html::textInput('referenciaEvaluacion',null, ['class' => 'form-control']);?></td>
     			<td><?= Html::textInput('fecha',null, ['class' => 'form-control', 'type' => 'date']);?></td>
     			<td><?= Html::dropdownList('evaluador',null, ArrayHelper::map($usuarios, 'id', function($item) {return $item->nombre.' '. $item->apellidos;}) ,['class' => 'form-control']);?></td>
     			<td><?= Html::dropdownList('resultado',null, [1=> 'Apto', 0 => 'No apto'] ,['class' => 'form-control']);?></td>
     			<td><?= Html::dropdownList('idTipoEvaluacion',null, [1=> 'Supervisada',] ,['class' => 'form-control']);?></td>
     			<td><?= Html::textInput('documentoIFO010205',null, ['class' => 'form-control', 'type' => 'file']);?></td>
     			<td><a class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span></a></td>
     		</tr>
     		<?php 
     		if (key_exists('1', $auxEvaluaciones)){ 
     			
	     		foreach ($auxEvaluaciones['1'] as $key => $evaluacion) :
	     			
	     		?>
	     		 <tr>
				 	<td><?= $form->field($evaluacion,'['.$count.']referenciaEvaluacion')->textInput(['class' => 'form-control'])->label(false);?>
				 		<?= $form->field($evaluacion,'['.$count.']id')->hiddenInput(['class' => 'form-control'])->label(false);?>
				 	</td>
	     			<td><?= $form->field($evaluacion,'['.$count.']fecha')->textInput(['type' => 'date'])->label(false);?></td>
	     			<td><?= $form->field($evaluacion,'['.$count.']evaluador')->dropDownList(ArrayHelper::map($usuarios, 'id', function($item) {return $item->nombre.' '. $item->apellidos;}) )->label(false);?></td>
	     			<td><?= $form->field($evaluacion,'['.$count.']resultado')->dropDownList( [1=> 'Apto', 0 => 'No apto'], ['options' =>
                    [                        
                      $evaluacion->resultado => ['selected' => true]
                    ]
          ] )->label(false);?></td>
	     			<td><?= $form->field($evaluacion,'['.$count.']idTipoEvaluacion')->dropDownList( [1=> 'Supervisada'] )->label(false);?> </td>
	     			<td>
	     				<?php if (!$evaluacion->documentoIFO010205) : ?>
	     					<?= $form->field($evaluacion, '['.$count.']documentoIFO010205')->textInput( ['type' => 'file', 'value' => $evaluacion->documentoIFO010205] )->label(false);?>
	     				<?php else: ?>
	     					<?= $evaluacion->documentoIFO010205->nombre ?>
	     				<?php endif ?>
	     			</td>
	     					
	     			<td><a class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span></a></td>
				 </tr>
				 <?php $count++; ?>	
			<?php endforeach;
			}
			?>
     	
     	
     	
     	</tbody>
     </table>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php


$script=<<<EOT
	$(document).on('click','a#anyadirEvaluacion', function(){
		var target = $(this).data('target');
		var i = $('div.historico-mantenimientos-cualificaciones-form').data("evaluaciones");//.find('tbody tr').length-2;
		$('div.historico-mantenimientos-cualificaciones-form').data("evaluaciones", i+1)
		var tr = $(target).find('tr#evaluacion').clone();


		$(tr).find('td').each(function(index,item){
			var input = $(item).find('input,select')
			var name = (input).attr('name');
			$(item).find('input,select').attr('name', 'EvaluacionInSitu['+i+']['+name+']');
			
		});
		$(tr).css('display', '');
		$(tr).removeAttr('id');
		$(target).find('tbody').append(tr);
		
	});
	
	$(document).on('click','a.delete', function(){
		var target = $(this).closest('tr');
		$(target).remove();
	});
	
	$(document).on('change','select[name="HistoricoMantenimientosCualificaciones[idTipoMantenimientoCualificacion]"]', function(){
		var option = $(this).children("option:selected").val();
		if (option == 1) //Es inicial.
		{
			$('input[name="HistoricoMantenimientosCualificaciones[examenTeorico]"]').attr('required',true);
		}
		else {
			$('input[name="HistoricoMantenimientosCualificaciones[examenTeorico]"]').attr('required',false);
		}
	});
	
	
	///Recarga el gridView de las actuaciones por tipo de cualificacion:
	$(document).on('change', '#historicomantenimientoscualificaciones-idtipomantenimientocualificacion, #historicomantenimientoscualificaciones-idcualificacion, #historicomantenimientoscualificaciones-cualificadocomo', function(){
		console.log('Actualizar GridView');
		$.pjax.reload({type:"POST", container:"#actuaciones", data: "idCualificacion="+$('#historicomantenimientoscualificaciones-idcualificacion').val()+"&cualificadoComo="+$('#historicomantenimientoscualificaciones-cualificadocomo').val()+"&idTipoMantenimientoCualificacion="+$('#historicomantenimientoscualificaciones-idtipomantenimientocualificacion').val() });
	});
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>
