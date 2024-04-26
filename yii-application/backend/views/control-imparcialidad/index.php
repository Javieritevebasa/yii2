<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ControlImparcialidadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Control Imparcialidads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="control-imparcialidad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Control Imparcialidad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'matricula',
            [
            	'attribute' => 'user',
            	'value' => function($model){ return $model->user0->nombre.' '.$model->user0->apellidos;}],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
