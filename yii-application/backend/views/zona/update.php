<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Zona */

$this->title = 'Update Zona: ' . $model->idZona;
$this->params['breadcrumbs'][] = ['label' => 'Zonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idZona, 'url' => ['view', 'id' => $model->idZona]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zona-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
