<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sisgesdev\models\DesviacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tratamientos pendientes de validar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tratamiento-listar-pendientes-validar">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
            	'attribute'=>'fechaCierre',
            	'format' =>'date',
            ],
          
            [
            	'attribute' => 'descripcion',
            	'value' => function($model){
            			$texto = $model->descripcion;
						$texto .="<ul>";
						foreach ($model->hallazgos as $key => $hallazgo) {
							$texto.='<li>'.$hallazgo->descripcion.'</li>';
						}
						$texto .='</ul>';
            			return $texto;
            		},
            	'format' => 'html',
            	'contentOptions' => ['style' => 'word-wrap: break-word !important; white-space: normal !important;'],
            ],
            [
            	'class' => 'yii\grid\ActionColumn',
            	'template' => '{validar}',
            	'buttons' => [
            		'validar' => function($url, $model){
            			return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                            'title' => 'Validar tramite',]);
            		}
            	],
            	'urlCreator' => function ($action, $model, $key, $index) {
				            if ($action === 'validar') {
				                $url = Url::to(['tratamiento/validar', 'id' => $model->id]);
				                return $url;
				            }
				},
            ],
        ],
    ]); ?>
</div>
