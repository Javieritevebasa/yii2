<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$formatter = \Yii::$app->formatter;

?>
<tr>
	<td><?=$formatter->asDate($model->fechaDesde, 'dd-MM-yyyy'); ?></td>
	<td><?= $formatter->asDate($model->fechaHasta, 'dd-MM-yyyy'); ?></td>
	<td><?= Html::encode($model->tipoMantenimientoCualificacion->nombre) ?></td>
	<td><?= $model->resultadoGlobal? 'Sí' : 'No'; ?></td>
	<td><?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['historico-mantenimientos-cualificaciones/view', 'id' => $model->id], ['class' => '']) ?></td>
</tr>
