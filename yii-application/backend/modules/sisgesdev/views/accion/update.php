<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Accion */

$this->title = 'Update Accion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipoAccion' => $tipoAccion,
        'usuarios' => $usuarios,
    ]) ?>

</div>
