<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model backend\models\Formacion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Formacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="formacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Subir resultados', ['subir-resultados', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codigo',
            'nombre',
            'horas',
            'fechaCreacion',
            'fechaInicio',
            'fechaFin',
            [
            	'attribute' => 'responsable',
            	'value' => function($m) { return $m->responsable0->nombre.' '.$m->responsable0->apellidos;}
            ],
            
        ],
    ]) ?>
    
    <h2>Personal del curso</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'codigoInspector',
             'nombre',
             'apellidos',
             'movil',
             'email:email',
             [
             	'header' => 'Aprobado',
             	'value' => function($m, $index, $dataColumn) use ($model) {
								return $m->getDetalleFormacion()->where(['idFormacion' => $model->id])->one()->aprobado;
		    					},
             ],
             [
             	'header' => 'Nota',
             	'value' => function($m, $index, $dataColumn) use ($model) {
								return $m->getDetalleFormacion()->where(['idFormacion' => $model->id])->one()->nota;
		    					},
             ],
             [
             	'header' => 'fechaInicio',
             	'value' => function($m, $index, $dataColumn) use ($model) {
								return $m->getDetalleFormacion()->where(['idFormacion' => $model->id])->one()->fechaInicio;
		    					},
		    	'format'=>['date', 'php:d-m-Y'],
             ],
             [
             	'header' => 'fechaFin',
             	'value' => function($m, $index, $dataColumn) use ($model) {
								return $m->getDetalleFormacion()->where(['idFormacion' => $model->id])->one()->fechaFin;
		    					},
		    	'format'=>['date', 'php:d-m-Y'],
             ]
        ],
    ]); ?>

</div>
