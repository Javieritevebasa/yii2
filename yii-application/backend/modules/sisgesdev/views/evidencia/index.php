<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sisgesdev\models\EvidenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Evidencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evidencia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Evidencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigoEvidencia',
            'ruta',
            'accionId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
