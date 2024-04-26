<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ControlImparcialidad */

$this->title = 'Create Control Imparcialidad';
$this->params['breadcrumbs'][] = ['label' => 'Control Imparcialidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="control-imparcialidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
