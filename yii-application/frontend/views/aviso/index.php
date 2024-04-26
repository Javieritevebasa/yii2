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

    
    <?= GridView::widget([
        'dataProvider' => $avisosUsuario,
        'columns' => [
        	
            ['class' => 'yii\grid\SerialColumn'],

            'idAviso',
            [
            	'attribute'=>'titulo',
            	'contentOptions' => ['style' => 'word-wrap: break-word !important; white-space: normal !important;'],
            ],
            [
            	'attribute'=>'descripcion',
            	'contentOptions' => ['style' => 'word-wrap: break-word !important; white-space: normal !important;'],
            ],
            [
            	'class' => 'yii\grid\ActionColumn',
		        //'contentOptions' => ['style' => 'width:260px;'],
		        'header'=>'',
		        'template' => '{enterado}',
		        'buttons' => [
		
		            //view button
		            'enterado' => function ($url, $model) {
		                return Html::a('<span class="fa fa-search"></span>Enterado', $url, [
		                            'title' => Yii::t('app', 'Enterado'),
		                            'class'=>'btn btn-primary btn-xs',  
		                            'data-pjax'=>'w0'                                
		                ]);
		            },
		        ],
            ],
           
        ],

    ]); ?>
</div>