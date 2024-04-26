<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ControlImparcialidad */

$this->title = 'Update Control Imparcialidad: ' . $model->matricula;
$this->params['breadcrumbs'][] = ['label' => 'Control Imparcialidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->matricula, 'url' => ['view', 'matricula' => $model->matricula, 'user'=>$model->user]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="control-imparcialidad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
