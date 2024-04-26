<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Hallazgo */

$this->title = 'Create Hallazgo';
$this->params['breadcrumbs'][] = ['label' => 'Hallazgos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hallazgo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
