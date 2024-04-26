<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sisgesdev\models\DesviacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Desviacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desviacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Desviacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'numero',
            'fecha',
            'departamento',
            'tipoDesviacion',
            //'descripcion:ntext',
            //'origen',
            //'responsable',
            //'fechaCierre',
            //'validadoPor',
            //'fechaValidacion',
            //'fechaLimite',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
