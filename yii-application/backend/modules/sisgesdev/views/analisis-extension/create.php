<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\AnalisisExtension */

$this->title = 'Create Analisis Extension';
$this->params['breadcrumbs'][] = ['label' => 'Analisis Extensions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analisis-extension-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
