<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Aviso */

$this->title = $model->idAviso;
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aviso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idAviso], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idAviso], [
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
            'idAviso',
            'titulo',
            'descripcion',
            'creadoEl',
            'creadoPor',
            'idCategoria',
        ],
    ]) ?>
    
    <?= GridView::widget([
        'dataProvider' => $usuarios,
        //'filterModel' => $searchModel,
        'columns' => [
            'nombre',
            'apellidos',
            'notificadoEl',
            'signadoEl',
        ],
    ]); ?>

</div>
