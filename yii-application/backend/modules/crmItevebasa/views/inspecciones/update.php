<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\crmItevebasa\models\Inspecciones */

$this->title = 'Update Inspecciones: ' . $model->Estacion;
$this->params['breadcrumbs'][] = ['label' => 'Inspecciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Estacion, 'url' => ['view', 'Estacion' => $model->Estacion, 'Anyo' => $model->Anyo, 'InformeMecanica' => $model->InformeMecanica]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inspecciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
