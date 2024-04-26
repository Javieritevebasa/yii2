<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ControlImparcialidadEmpresas */

$this->title = 'Update Control Imparcialidad Empresas: ' . $model->matricula;
$this->params['breadcrumbs'][] = ['label' => 'Control Imparcialidad Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->matricula, 'url' => ['view', 'id' => $model->matricula]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="control-imparcialidad-empresas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
