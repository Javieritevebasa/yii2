<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EstarEspecializado */

$this->title = 'Update Estar Especializado: ' . $model->idUser;
$this->params['breadcrumbs'][] = ['label' => 'Estar Especializados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idUser, 'url' => ['view', 'idUser' => $model->idUser, 'idEspecialidad' => $model->idEspecialidad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estar-especializado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
