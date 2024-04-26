<?php

use yii\helpers\Html;

use yii\jui\DatePicker;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = 'Detalle fichadas trabajador '.$usuario->nombre.' '.$usuario->apellidos ;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichaje-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<p></p>
	<?= GridView::widget([
		
	    'dataProvider' => $fichadas,
	    'columns' => [
	        ['attribute' => 'dia', 'label' => 'Día', 'format' => ['date'],], 
	        ['attribute' => 'hora', 'label' => 'Hora'], 
	        ['attribute' => 'accion', 'label' => 'Acción'],
	    ],
	]) ?>
	</div>
