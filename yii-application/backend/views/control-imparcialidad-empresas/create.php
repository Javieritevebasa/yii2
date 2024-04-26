<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ControlImparcialidadEmpresas */

$this->title = 'Create Control Imparcialidad Empresas';
$this->params['breadcrumbs'][] = ['label' => 'Control Imparcialidad Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="control-imparcialidad-empresas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
