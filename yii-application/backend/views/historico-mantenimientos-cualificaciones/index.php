<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HistoricoMantenimientosCualificacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Historico Mantenimientos Cualificaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-mantenimientos-cualificaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Historico Mantenimientos Cualificaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idCualificacion',
            'idUser',
            'fechaDesde',
            'fechaHasta',
            //'resultadoGlobal:boolean',
            //'idTipoMantenimientoCualificacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
