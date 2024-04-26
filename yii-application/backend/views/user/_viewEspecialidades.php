<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

$formatter = \Yii::$app->formatter;

?>

<tr>
	<td><button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseHistorico<?= $model->idEspecialidad ?>" aria-expanded="false" aria-controls="collapseHistorico<?= $model->idEspecialidad ?>"><span class="glyphicon glyphicon-collapse-down"></span></button></td>
	<td><?= Html::encode($model->especialidad->cualificacion->nombre) ?></td>
	<td><?= Html::encode($model->cualificadoComo0->nombre) ?></td>
	<td><?=$formatter->asDate($model->fechaPrimeraCualificacion, 'dd-MM-yyyy'); ?></td>
	<td><?= $formatter->asDate($model->fechaCualificacion, 'dd-MM-yyyy'); ?></td>
	<td><?= $formatter->asDate($model->fechaVencimiento, 'dd-MM-yyyy'); ?></td>
	<td><?= ($model->apto? 'Si':'No'); ?></td>
</tr>
<tr class="collapse"  id="collapseHistorico<?= $model->idEspecialidad ?>">
	<td colspan="6" style="padding-left:5em;" >
		<table class="table  table-condensed">
			<tr>
				<th>Fecha desde</th>
				<th>Fecha hasta</th>
				<th>Tipo</th>
				<th>Apto</th>
				<th></th>
			</tr>
		<?php 
	    $dataProvider = new ActiveDataProvider([ 'query' => $model->getHistoricoMantenimientosCualificacion(), ]);
	    echo  ListView::widget([
		    'dataProvider' => $dataProvider,
		    'itemView' => '_viewHistoricoMantenimientosCualificacion',
		    //'itemOptions' => [
		    //    'tag' => false
		    //],
		    'summary'=>'',
		    'options' => [
			//        'class' => '',
			//	    'id' => false
				   ]
		    
			]); 
	    ?>
	    </table>
	</td>
</tr>

