<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estacion */

$this->title = 'Create Estacion';
$this->params['breadcrumbs'][] = ['label' => 'Estacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
