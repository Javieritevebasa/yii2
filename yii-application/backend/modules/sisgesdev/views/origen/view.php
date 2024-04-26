<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Origen */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Origens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
         'formatter' => [
            'class' => '\yii\i18n\Formatter',
            'dateFormat' => 'dd/MM/yyyy',
            'datetimeFormat' => 'dd/MM/yyyy HH:mm::ss',
        ],
        'attributes' => [
            'id',
            'numeroExpediente',
            [
            	'attribute' => 'tipoOrigen',
            	'value' =>  $model->tipoOrigen0->nombre,
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
            [
            	'attribute' => 'creadoPor',
            	'value' => $model->creadoPor0->nombre. ' '. $model->creadoPor0->apellidos
            ],
             [
            	'attribute' => 'validadoPor',
            	'value' => $model->validadoPor0->nombre. ' '. $model->validadoPor0->apellidos
            ],
            [
            	'attribute' => 'fechaValidacion',
            	'format' => 'date',
            ],
        ],
    ]) ?>

</div>
