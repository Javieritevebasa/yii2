<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ControlImparcialidad */

$this->title = $model->matricula;
$this->params['breadcrumbs'][] = ['label' => 'Control Imparcialidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>

<div class="control-imparcialidad-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'matricula' => $model->matricula, 'user' => $model->user], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'matricula' => $model->matricula, 'user' => $model->user], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'matricula',
            'user',
        ],
    ]) ?>

</div>
