<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Fichajes */

$this->title = 'Update Fichajes: ' . $model->idFichajes;
$this->params['breadcrumbs'][] = ['label' => 'Fichajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idFichajes, 'url' => ['view', 'id' => $model->idFichajes]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fichajes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
