<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CriteriosMantenimientosCualificacion */

$this->title = 'Update Criterios Mantenimientos Cualificacion: ' . $model->idCualificacion;
$this->params['breadcrumbs'][] = ['label' => 'Criterios Mantenimientos Cualificacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCualificacion, 'url' => ['view', 'idCualificacion' => $model->idCualificacion, 'idTipoMantenimientoCualificacion' => $model->idTipoMantenimientoCualificacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="criterios-mantenimientos-cualificacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cualificaciones' => $cualificaciones,
        'tipoMantenimientoCualificacion' => $tipoMantenimientoCualificacion,
        'grupos' => $grupos,
    ]) ?>

</div>
