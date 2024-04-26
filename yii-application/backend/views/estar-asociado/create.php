<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EstarAsociado */

$this->title = 'Create Estar Asociado';
$this->params['breadcrumbs'][] = ['label' => 'Estar Asociados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estar-asociado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
