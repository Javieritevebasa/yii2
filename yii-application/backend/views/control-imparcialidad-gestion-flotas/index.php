<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ControlImparcialidadGestionFlotasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Control Imparcialidad Gestion Flotas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="control-imparcialidad-gestion-flotas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Control Imparcialidad Gestion Flotas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cif',
            'nombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
