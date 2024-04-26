<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Accion */

$this->title = 'Update Accion: ' . $model->idAccion;
$this->params['breadcrumbs'][] = ['label' => 'Accions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAccion, 'url' => ['view', 'id' => $model->idAccion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
