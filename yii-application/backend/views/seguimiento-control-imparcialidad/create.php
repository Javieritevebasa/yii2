<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SeguimientoRiesgosImparcialidad */

$this->title = 'Create Seguimiento Riesgos Imparcialidad';
$this->params['breadcrumbs'][] = ['label' => 'Seguimiento Riesgos Imparcialidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguimiento-riesgos-imparcialidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
