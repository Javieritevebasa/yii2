<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricoMantenimientosCualificaciones */

$this->title = 'Update Historico Mantenimientos Cualificaciones: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Historico Mantenimientos Cualificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="historico-mantenimientos-cualificaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'accion' =>'update',
         'tipoMantenimientoCualificacion' => $tipoMantenimientoCualificacion,
         'cualificaciones' => $cualificaciones,
         'usuarios' => $usuarios,
         'grupos' => $grupos,
         'evaluaciones' => $evaluaciones
    ]) ?>

</div>
