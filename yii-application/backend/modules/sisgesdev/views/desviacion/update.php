<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Desviacion */

$this->title = 'Update Desviacion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Desviacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="desviacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'usuarios' => $usuarios,
         'tipoDesviacion' => $tipoDesviacion,
          'departamento' => $departamento,
    ]) ?>

</div>
