<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ControlImparcialidadGestionFlotas */

$this->title = 'Update Control Imparcialidad Gestion Flotas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Control Imparcialidad Gestion Flotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="control-imparcialidad-gestion-flotas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
