<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServiciosAlfa */

$this->title = 'Create Servicios Alfa';
$this->params['breadcrumbs'][] = ['label' => 'Servicios Alfas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicios-alfa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
