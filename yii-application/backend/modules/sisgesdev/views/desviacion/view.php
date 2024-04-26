<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Desviacion */

$this->title = $model->numero;
$this->params['breadcrumbs'][] = ['label' => 'Desviaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desviacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Validar', ['validar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
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
            //'id',
            'numero',
            [
            	'attribute'=>'fecha',
            	'format' => 'date',
            ],
            [
            	'attribute'=>'departamento',
            	'value' => $model->departamento0->nombre,
            ],
            [
            	'attribute'=>'tipoDesviacion',
            	'value' => $model->tipoDesviacion0->nombre,
            ],
            [
            	'attribute' => 'descripcion',
            	'format' => 'html',
            ],
            //'origen',
            [
            	'attribute'=>'responsable',
            	'value' => $model->responsable0->nombre.' '.$model->responsable0->apellidos,
            ],
            [
            	'attribute'=>'fechaCierre',
            	'format' => 'date', 
            ],
            [
            	'attribute'=>'validadoPor',
            	'value' => $model->validadoPor0->nombre.' '.$model->validadoPor0->apellidos,
            ],
            [
            	'attribute'=>'fechaValidacion',
            	'format' => 'date', 
            ],
            [
            	'attribute'=>'fechaLimite',
            	'format' => 'date', 
            ],
        ],
    ]) ?>
    
 
  <?= $this->render('/tratamiento/listarTratamientos', ['tratamientos' => $model->tratamientos, 'title' => 'Tratamientos'], $this->context) ?>
 

</div>
