<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\TipoOrigen */

$this->title = 'Create Tipo Origen';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Origens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-origen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
