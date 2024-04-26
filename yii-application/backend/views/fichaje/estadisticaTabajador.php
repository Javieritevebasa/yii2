<?php

use yii\helpers\Html;

use yii\jui\DatePicker;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


use app\assets\JqplotAsset;
JqplotAsset::register($this);


$this->title = 'Estadística trabajador '.$usuario->nombre.' '.$usuario->apellidos ;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichaje-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<div id='chart' style="width: 100%; height: 200px"></div>
	<p></p>
	<?= GridView::widget([
		
	    'dataProvider' => $fichadas,
	    'columns' => [
	        ['attribute' => 'dia', 'label' => 'Día', 'format' => ['date'],], 
	        ['attribute' => 'tiempoTrabajando', 'label' => 'Tiempo trabajado (minutos)'], 
	        ['attribute' => 'tiempoAlmuerzo', 'label' => 'Tiempo almorzando (minutos)'],
	        ['attribute' => 'tiempoOperativo', 'label' => 'Tiempo efectivo (minutos)'],
	        ['class' => 'yii\grid\ActionColumn',
	         'template' => '{view}',
			 'buttons' => [
			 		'view' => function ($url, $model, $key) {
			 			$url = yii\helpers\Url::to(['fichaje/estadistica-trabajador-detalle-dia', 'usuario' => $model['idUser'], 'dia' => $model['dia']]);
		        		return Html::a('<span class="fa fa-search"></span>Detalle', $url, [
                            'title' => Yii::t('app', 'Detalle'),
                            'class'=>'btn btn-primary btn-xs',  ]);
		    			},
		    		]
	          
	        ],
	    ],
	]) ?>
	</div>
<?php
$script = <<< JS
	jQuery.jqplot.config.enablePlugins = true;
	var ajaxDataRenderer = function(url, plot, options) {
			    var ret = null;
			    jQuery.ajax({
			      // have to use synchronous here, else the function 
			      // will return before the data is fetched
			      async: false,
			      url: url,
			      dataType:"json",
			      success: function(data) {
			        
			        ret = data;
			        
			      }
			    });
			    return ret;
			  };
	 var jsonurl = 'http://192.168.23.40:8082/backend/index.php?r=fichaje%2Fajax-grafica-trabajador&idUser=$usuario->id&anyo=2017'
	 var plot3 = jQuery.jqplot('chart', jsonurl, {
					      title:'Tiempos efectivo (en minutos)',
						  animate: true,
					      dataRenderer: ajaxDataRenderer,
					      dataRendererOptions: {
						      	unusedOptionalUrl: jsonurl,
						   		},
						  axes:{
						        xaxis:{
						          renderer:jQuery.jqplot.DateAxisRenderer,
						          tickInterval:'1 day',
						        }
						      },
						  series:[{label: '$usuario->nombre'+' '+'$usuario->apellidos'}],
						  cursor:{
					            zoom:true,
					            looseZoom: true
					        }
					      
					  });
				    
		
JS;
$this->registerJs($script);
?>