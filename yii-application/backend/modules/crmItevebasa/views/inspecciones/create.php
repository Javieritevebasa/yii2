<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\crmItevebasa\models\Inspecciones */

$this->title = 'Create Inspecciones';
$this->params['breadcrumbs'][] = ['label' => 'Inspecciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inspecciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
