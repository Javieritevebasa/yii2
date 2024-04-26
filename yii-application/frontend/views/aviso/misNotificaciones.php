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
        	
            [
            	'attribute' => 'creadoEl',
            	'format' => 'date',
            ],
            [
            	'attribute' => 'titulo',
            	'contentOptions'=>['style'=>'white-space: normal; max-width:50%']
            ],
            
            [
            	'attribute' => 'descripcion',
            	'contentOptions'=>['style'=>'white-space: normal; max-width:50%']
            ],
            [
            	'attribute' => 'idAviso',
            	'contentOptions'=>['style'=>'white-space: normal; max-width:50%']
            ],
        ],
		
    ]); ?>
</div>