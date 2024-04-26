<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SeguimientoRiesgosImparcialidad */

$this->title = 'Update Seguimiento Riesgos Imparcialidad: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seguimiento Riesgos Imparcialidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="seguimiento-riesgos-imparcialidad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
