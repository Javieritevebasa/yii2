<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\AnalisisCausa */

$this->title = 'Create Analisis Causa';
$this->params['breadcrumbs'][] = ['label' => 'Analisis Causas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analisis-causa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
