<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EvaluacionInSitu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Evaluacion In Situs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="evaluacion-in-situ-view">

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
        'attributes' => [
            'id',
            'fecha',
            'evaluador',
            'resultado:boolean',
            'idHistoricoMantenimientosCualificacion',
            'referenciaEvaluacion',
            'idTipoEvaluacion',
            'IFO_01_02_05',
        ],
    ]) ?>

</div>
