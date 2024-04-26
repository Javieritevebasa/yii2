<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Origen */

$this->title = 'Editar expediente: ' . $model->numeroExpediente;
$this->params['breadcrumbs'][] = ['label' => 'Origens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'expediente '.$model->numeroExpediente, 'url' => ['sisgesdev/view-form', 'origen' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="origen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposOrigen' => $tiposOrigen,
        'usuarios' => $usuarios,
    ]) ?>

</div>
