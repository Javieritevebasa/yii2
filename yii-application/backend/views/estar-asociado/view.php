<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EstarAsociado */

$this->title = $model->idEspecialidad;
$this->params['breadcrumbs'][] = ['label' => 'Estar Asociados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="estar-asociado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idEspecialidad' => $model->idEspecialidad, 'idServicio' => $model->idServicio], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idEspecialidad' => $model->idEspecialidad, 'idServicio' => $model->idServicio], [
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
           
            [
            	'attribute' => 'idEspecialidad',
            	'label' => 'Especialidad',
            	'value' => $model->idEspecialidad0->nombre],
            [
            	'attribute' => 'idServicio',
            	'label' => 'Servicio',
            	'value' =>$model->idServicio0->nombre]
        ],
    ]) ?>

</div>
