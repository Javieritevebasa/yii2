<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AvisoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avisos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aviso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Aviso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            
 			[
            	'attribute'=>'idAviso',
            	'value'=>'idAviso',
            	'headerOptions'=> [
            		'style'=>'width:80px; max-width: 80px; ',
            		]
            ],
           
            'titulo',
            //'descripcion',
            [
            	'attribute'=>'descripcion',
            	'value'=>'descripcion',
            	'contentOptions'=> [
            		'style'=>'width:200px; overflow: hidden; text-overflow: ellipsis',
            		]
            ],
           
            [
            	'attribute'=>'creadoEl',
            	'value'=>'creadoEl',
            	'headerOptions'=> [
            		'style'=>'width:100px; max-width: 100px; ',
            		]
            ],
            //'creadoPor',
            // 'idCategoria',

            ['class' => 'yii\grid\ActionColumn',
            'headerOptions'=> [
            		'style'=>'width:100px; max-width: 100px; ',
            		]
            ],
        ],
         'tableOptions' => [
         'class'=> 'table table-striped table-bordered',
         'style' => 'table-layout: fixed',],
    ]); ?>
</div>
