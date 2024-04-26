<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ServiciosAlfa */

$this->title = $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Servicios Alfas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="servicios-alfa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codigo' => $model->codigo, 'idZona' => $model->idZona], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codigo' => $model->codigo, 'idZona' => $model->idZona], [
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
            'codigo',
            'idZona',
            'idServicio',
            'nombre',
            'codigoComunidad',
        ],
    ]) ?>

</div>
