<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\grid\GridView;

use backend\models\Riesgo;
use backend\models\NivelRiesgo;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SeguimientoRiesgosImparcialidadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seguimiento Riesgos Imparcialidads';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="seguimiento-riesgos-imparcialidad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Seguimiento Riesgos Imparcialidad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'matricula',
            [
            	'attribute' =>'propietarioNombre',
            	//'value' => function($model) { return ($model->propietario!=null)? $model->propietario->nombre.' '.$model->propietario->apellidos : 'Empresa del grupo';// $model->propietario->nombre.' '. $model->propietario->apellidos;}
            	'value' => function($model) {
            		 if ($model->propietarioNombre == null)
            		 	return ($model->propietario!=null)? $model->propietario->nombre.' '.$model->propietario->apellidos : 'Empresa del grupo';// $model->propietario->nombre.' '. $model->propietario->apellidos;
            		return $model->propietarioNombre;
				}
            ],
            [
            	'attribute' => 'usuarioNombre',
            	'value' => function($model) { return $model->usuario->nombre.' '. $model->usuario->apellidos; }
            ],
            'fecha',
            [
            	'attribute' => 'anyo',
            	'value' => function ($model){
            		$hora = \DateTime::createFromFormat ( 'Y-m-d H:i:s' , $model->fecha ); 
					return $hora? $hora->format('Y'): null; 
            	},
            ],
            'estacion',
            'servicio',
            [
            	'attribute' => 'riesgoId',
            	'value' => 'riesgo.nombre',
            	'filter' => ArrayHelper::map(Riesgo::find()->asArray()->all(), 'id', 'nombre'),
            ],
            [
            	'attribute' => 'nivelRiesgoId',
            	'value' => 'nivelRiesgo.descripcion',
            	'filter' => ArrayHelper::map(NivelRiesgo::find()->asArray()->all(), 'id', 'descripcion'),
            ],
            [
            	'attribute' => 'validado',
            	'filter' => [ 0 => 'No', 1 => 'Sí'],
            ],

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {justificar} {update} {delete}',
		    'visibleButtons'=>[
		    	'view' =>function($model){
		    		$grupos = [];
					foreach (Yii::$app->user->identity->idGrupos as $key => $value) {
							 	array_push($grupos, $value->idGrupo);
							}
		              return count(array_intersect([0, 1, 4, 5, 11,21,41], $grupos)) > 0;
		         },
		         'justificar' =>function($model){
		         	$grupos = [];
		             foreach (Yii::$app->user->identity->idGrupos as $key => $value) {
							 	array_push($grupos, $value->idGrupo);
							}
		              return count(array_intersect([0, 1, 4, 5, 11,21,41], $grupos)) > 0;
		         },
		         'update' =>function($model){
		         	$grupos = [];
		             foreach (Yii::$app->user->identity->idGrupos as $key => $value) {
							 	array_push($grupos, $value->idGrupo);
							}
		              return count(array_intersect([0, 1, 4, 5, 11,21,41], $grupos)) > 0;
		         },
		        'delete'=> function($model){
		        	$grupos = [];
		              foreach (Yii::$app->user->identity->idGrupos as $key => $value) {
							 	array_push($grupos, $value->idGrupo);
							}
		              return count(array_intersect([0, 1, 4, 5, 11,21], $grupos)) > 0;
		         },
		    ],
		     'buttons' => [
			 		'justificar' => function ($url, $model, $key) {
			 			//http://192.168.23.40:8082/backend/index.php?r=seguimiento-control-imparcialidad%2Finforme-control&id=39
			 			$url = yii\helpers\Url::to(['seguimiento-control-imparcialidad/informe-control', 'id' => $model['id']]);
		        		return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                            'title' => Yii::t('app', 'Justificar'),
                            ]);
		    			},
		    		]
    
    ],
        ],
    ]); ?>


</div>
