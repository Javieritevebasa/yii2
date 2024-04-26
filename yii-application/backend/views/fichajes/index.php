<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FichajesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fichajes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichajes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fichajes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idFichajes',
            'fechaHora',
            'idAccion',
            'comentario',
            'idUser',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
