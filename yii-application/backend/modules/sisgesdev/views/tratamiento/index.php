<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sisgesdev\models\TratamientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tratamientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tratamiento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tratamiento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'descripcion',
            'analisisExtensionId',
            'responsable',
            'fechaCierre',
            //'fechaValidacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
