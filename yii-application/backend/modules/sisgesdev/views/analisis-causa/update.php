<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\AnalisisCausa */

$this->title = 'Update Analisis Causa: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Analisis Causas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="analisis-causa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
