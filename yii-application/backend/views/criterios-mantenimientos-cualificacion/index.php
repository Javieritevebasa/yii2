<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CriteriosMantenimientosCualificacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Criterios Mantenimientos Cualificacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="criterios-mantenimientos-cualificacion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Criterios Mantenimientos Cualificacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
            	'attribute' => 'idCualificacion',
            	'value' => 'cualificacion.nombre',
            	'label' => 'Cualificación'
            ],
            [
            	'attribute' => 'idTipoMantenimientoCualificacion',
            	'value' => 'tipoMantenimientoCualificacion.nombre',
            	'label' => 'Tipo cualificación'
            ],
            'numeroMinimoTuteladas',
            'numeroSupervisiones',
            'numeroActuacionesMinimo',
            [
            	'attribute' => 'cualificadoComo',
            	'value' => 'cualificadoComo0.nombre',
            	'label' => 'Cualificado como'
            ],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
