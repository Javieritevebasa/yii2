<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServiciosAlfa */

$this->title = 'Update Servicios Alfa: ' . $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Servicios Alfas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo, 'url' => ['view', 'codigo' => $model->codigo, 'idZona' => $model->idZona]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicios-alfa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
