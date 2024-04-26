<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ControlImparcialidadGestionFlotas */

$this->title = 'Create Control Imparcialidad Gestion Flotas';
$this->params['breadcrumbs'][] = ['label' => 'Control Imparcialidad Gestion Flotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="control-imparcialidad-gestion-flotas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
