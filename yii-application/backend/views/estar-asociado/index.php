<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

use common\models\Especialidad;
use common\models\Servicios;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstarAsociadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estar Asociados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estar-asociado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Estar Asociado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
            	'attribute'=>'idEspecialidad',
            	'value' => 'idEspecialidad0.nombre',
            	'filter' => ArrayHelper::map(Especialidad::find()->all(),'id','nombre'),
            ],

            
            [
            	'attribute'=>'idServicio',
            	'value' => 'idServicio0.nombre',
            	'filter' => ArrayHelper::map(Servicios::find()->all(),'id','nombre'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
