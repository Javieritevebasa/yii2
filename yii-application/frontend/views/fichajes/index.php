<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FichajesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fichajes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichajes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fichajes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idFichajes',
            'fechaHora',
            'idAccion',
            'comentario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
