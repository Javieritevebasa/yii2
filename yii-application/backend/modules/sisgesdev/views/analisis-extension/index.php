<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sisgesdev\models\AnalisisExtensionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Analisis Extensions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analisis-extension-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Analisis Extension', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'descripcion:ntext',
            'tratamientoId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
