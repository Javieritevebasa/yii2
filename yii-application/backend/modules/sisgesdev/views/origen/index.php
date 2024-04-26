<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sisgesdev\models\OrigenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Origens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Origen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // 'id',
            'numeroExpediente',
            [
            	'attribute' => 'tipoOrigen',
            	'value' => 'tipoOrigen0.nombre',
            ],
            [
            	'attribute' => 'fecha',
            	'format' => 'date',
            ],
            [
            	'attribute' => 'fechaLimite',
            	'format' => 'date',
            ],
            [
            	'attribute' => 'descripcion',
            	'format' => 'html',
            ],
            //'creadoPor',
           /* [
            	'attribute' => 'validadoPor',
            	'value' => function($model) {return $model->validadoPor0->nombre.' '.$model->validadoPor0->apellidos;},
            ],
            [
            	'attribute' => 'fechaValidacion',
            	'format' => 'date',
            ],*/
            [
            	'class' => 'yii\grid\ActionColumn',
            	'template' => '{update} {delete}',
				'buttons'  => [
				    'view'   => function ($url, $model) {
				        $url = Url::to(['origen/view', 'id' => $model->id]);
				        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => 'view']);
				    },
				    'update' => function ($url, $model) {
				        $url = Url::to(['sisgesdev/view-form', 'origen' => $model->id]);
				        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => 'update']);
				    },
				    'delete' => function ($url, $model) {
				        $url = Url::to(['origen/delete', 'id' => $model->id]);
				        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
				            'title'        => 'delete',
				            'data-confirm' => Yii::t('yii', '¿Estás seguro que quieres eliminar el informe?'),
				            'data-method'  => 'post',
				        ]);
				    },
				],
            ],
        ],
    ]); ?>
</div>
