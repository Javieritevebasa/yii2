<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricoMantenimientosCualificaciones */

$this->title = 'Seguimiento de la cualificación';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->apellidos.', '.$model->user->nombre, 'url' => ['user/view', 'id' => $model->user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-mantenimientos-cualificaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'tipoMantenimientoCualificacion' => $tipoMantenimientoCualificacion,
         'cualificaciones' => $cualificaciones,
         'usuarios' => $usuarios,
          'grupos' => $grupos,
         'evaluaciones' => $evaluaciones,
    	 'actuaciones' => isset($actuaciones) ? $actuaciones : null,
    ]) ?>

</div>
