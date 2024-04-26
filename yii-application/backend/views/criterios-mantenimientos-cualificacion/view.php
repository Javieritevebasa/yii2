<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CriteriosMantenimientosCualificacion */

$this->title = $model->idCualificacion;
$this->params['breadcrumbs'][] = ['label' => 'Criterios Mantenimientos Cualificacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="criterios-mantenimientos-cualificacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idCualificacion' => $model->idCualificacion, 'idTipoMantenimientoCualificacion' => $model->idTipoMantenimientoCualificacion, 'cualificadoComo' => $model->cualificadoComo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idCualificacion' => $model->idCualificacion, 'idTipoMantenimientoCualificacion' => $model->idTipoMantenimientoCualificacion, 'cualificadoComo' => $model->cualificadoComo], [
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
            'idCualificacion',
            'idTipoMantenimientoCualificacion',
            'numeroMinimoTuteladas',
            'numeroSupervisiones',
            'cualificadoComo',
        ],
    ]) ?>

</div>
