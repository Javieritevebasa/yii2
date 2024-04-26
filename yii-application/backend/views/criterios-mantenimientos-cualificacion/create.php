<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CriteriosMantenimientosCualificacion */

$this->title = 'Create Criterios Mantenimientos Cualificacion';
$this->params['breadcrumbs'][] = ['label' => 'Criterios Mantenimientos Cualificacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="criterios-mantenimientos-cualificacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cualificaciones' => $cualificaciones,
        'tipoMantenimientoCualificacion' => $tipoMantenimientoCualificacion,
        'grupos' => $grupos,
    ]) ?>

</div>
