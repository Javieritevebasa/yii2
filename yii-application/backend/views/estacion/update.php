<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estacion */

$this->title = 'Update Estacion: ' . $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Estacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo, 'url' => ['view', 'id' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
