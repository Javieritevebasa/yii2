<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Formacion */

$this->title = 'Create Formacion';
$this->params['breadcrumbs'][] = ['label' => 'Formacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'grupos' => $grupos,
        'responsablesFormacion' => $responsablesFormacion
    ]) ?>

</div>
