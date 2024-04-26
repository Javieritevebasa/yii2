<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Formacion */

$this->title = 'Update Formacion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Formacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="formacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'grupos' => $grupos,
        'responsablesFormacion' => $responsablesFormacion
    ]) ?>

</div>
