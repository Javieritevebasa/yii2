<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EstarEspecializado */

$this->title = $model->idUser;
$this->params['breadcrumbs'][] = ['label' => 'Estar Especializados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="estar-especializado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idUser' => $model->idUser, 'idEspecialidad' => $model->idEspecialidad], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idUser' => $model->idUser, 'idEspecialidad' => $model->idEspecialidad], [
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
            'idUser',
            'idEspecialidad',
            'fechaCualificacion',
            'fechaVencimiento',
            'fechaPrimeraCualificacion',
            'apto',
            'cualificadoComo',
        ],
    ]) ?>

</div>
