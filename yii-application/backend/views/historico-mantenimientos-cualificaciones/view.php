<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricoMantenimientosCualificaciones */

$this->title = $model->cualificacion->nombre .' ('.  $model->tipoMantenimientoCualificacion->nombre.')';
//$this->params['breadcrumbs'][] = ['label' => 'Historico Mantenimientos Cualificaciones', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$formatter = \Yii::$app->formatter;
?>
<div class="historico-mantenimientos-cualificaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cualificacion.nombre',
            [	
            	'attribute' => 'idUser',
            	'value' => $model->user->nombre.' '.$model->user->apellidos,
            ],
            [
            	'attribute' => 'fechaDesde',
            	'format' => 'date',
            ],
             [
            	'attribute' => 'fechaHasta',
            	'format' => 'date',
            ],
            [	
            	'attribute' => 'resultadoGlobal',
            	'value' => $model->resultadoGlobal? 'Apto ' : 'No apto',
            ],
           
            [
            	'label' => 'Tipo',
            	'attribute' => 'idTipoMantenimientoCualificacion',
            	'value' => $model->tipoMantenimientoCualificacion->nombre,
            ],
            [
            	'label' => 'Documentos',
            	'value' => function($item){
            		$ul ='<ul class="list-unstyled">';
            		foreach ($item->documentos as $key => $documento) {
						$ul.='<li>'.Html::a(utf8_decode($documento->nombre), ['documento/view', 'id' => $documento->id], ['target' => '_blank']) .'</li>';
					};
					$ul .= '</ul>';
					return $ul;
            	},
            	'format' => 'html',
            ]
          
        ],
    ]) ?>
    
    <h3>Evaluaciones in-situ tuteladas</h3>
     <table id="tuteladas" class="table">
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
     		Evaluación in situ (IFO-01-02-05)
     		</th>
     		
     	</thead>
     	<tbody>
     		<?php foreach ($model->evaluacionInSitus as $key => $evaluacion) :?>
     		 <tr>
			 	<td><?= $evaluacion->referenciaEvaluacion; ?></td>
     			<td><?= $formatter->asDate($evaluacion->fecha, 'dd-MM-yyyy'); ?></td>
     			<td><?= $evaluacion->evaluador0->nombre. ' ' .$evaluacion->evaluador0->apellidos; ?></td>
     			<td><?= $evaluacion->resultado? 'Apto' : 'No apto'; ?></td>
     			<td><?= $evaluacion->tipoEvaluacion->nombre; ?> </td>
     			<td><?= Html::a(utf8_decode($evaluacion->documentoIFO010205->nombre), ['documento/view', 'id' => $evaluacion->documentoIFO010205->id], ['target' => '_blank']);?></td>
			 </tr>
		<?php endforeach;
			
			?>
     	</tbody>
     </table>

</div>
