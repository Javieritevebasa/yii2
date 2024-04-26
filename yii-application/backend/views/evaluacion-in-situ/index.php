<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EvaluacionInSituSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evaluacion In Situs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluacion-in-situ-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Evaluacion In Situ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha',
            'evaluador',
            'resultado:boolean',
            'idHistoricoMantenimientosCualificacion',
            //'referenciaEvaluacion',
            //'idTipoEvaluacion',
            //'IFO_01_02_05',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
