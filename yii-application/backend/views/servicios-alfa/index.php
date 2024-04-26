<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\Zona;
use common\models\Servicios;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ServiciosAlfaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asociar Servicios Comunidad a Servicios Itevebasa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicios-alfa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear nueva asociación de servicios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'nombre',
            [
            	'attribute'=>'idZona',
            	'value' => 'idZona0.nombre',
            	'filter' => ArrayHelper::map(Zona::find()->all(),'idZona','nombre'),
            ],
            [
            	'attribute'=>'idServicio',
            	'value' => 'idServicio0.nombre',
            	'filter' => ArrayHelper::map(Servicios::find()->all(),'id','nombre'),
            ],
            
            'codigoComunidad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
