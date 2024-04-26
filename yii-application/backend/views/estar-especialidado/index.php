<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstarEspecializadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estar Especializados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estar-especializado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Estar Especializado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idUser',
            'idEspecialidad',
            'fechaCualificacion',
            'fechaVencimiento',
            'fechaPrimeraCualificacion',
            [
            	'value' => 'user.username'
            ],
            //'apto',
            'cualificadoComo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
