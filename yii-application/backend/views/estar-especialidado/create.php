<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EstarEspecializado */

$this->title = 'Create Estar Especializado';
$this->params['breadcrumbs'][] = ['label' => 'Estar Especializados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estar-especializado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
