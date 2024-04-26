<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sisgesdev\models\DesviacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Desviaciones pendientes de validar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desviacion-listar-pendientes-validar">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'numero',
            [
            	'attribute'=>'fecha',
            	'format' =>'date',
            ],
            [
            	'attribute' => 'departamento',
            	'value' => 'departamento0.nombre',
            ],
            [
            	'attribute' => 'tipoDesviacion',
            	'value' => 'tipoDesviacion0.nombre',
            ],
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
