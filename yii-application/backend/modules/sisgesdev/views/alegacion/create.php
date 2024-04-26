<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Alegacion */

$this->title = 'Create Alegacion';
$this->params['breadcrumbs'][] = ['label' => 'Alegacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alegacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
