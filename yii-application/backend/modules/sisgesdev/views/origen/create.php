<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sisgesdev\models\Origen */

$this->title = 'Nuevo expediente';
$this->params['breadcrumbs'][] = ['label' => 'Origens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origen-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposOrigen' => $tiposOrigen,
        'usuarios' => $usuarios,
    ]) ?>

</div>
