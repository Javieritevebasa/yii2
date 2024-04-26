<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Tratamiento */

$this->title = 'Create Tratamiento';
$this->params['breadcrumbs'][] = ['label' => 'Tratamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tratamiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'usuarios' => $usuarios,
    ]) ?>

</div>
