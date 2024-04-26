<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EstarAsociado */

$this->title = 'Update Estar Asociado: ' . $model->idEspecialidad;
$this->params['breadcrumbs'][] = ['label' => 'Estar Asociados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idEspecialidad, 'url' => ['view', 'idEspecialidad' => $model->idEspecialidad, 'idServicio' => $model->idServicio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estar-asociado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
