<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Fichajes */

$this->title = 'Create Fichajes';
$this->params['breadcrumbs'][] = ['label' => 'Fichajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichajes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
