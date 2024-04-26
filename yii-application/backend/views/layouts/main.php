<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\models\User;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= "es-ES"; // Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Itevebasa',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
    	//Obtenemos los grupos del usuario:
    	
    	$usuario = User::findIdentity(Yii::$app->user->identity->id);
    	$grupos= [];
    	foreach ($usuario->idGrupos as $key => $value) {
		 	array_push($grupos, $value->idGrupo);
		}
		
		$menuItems = [
			//Item_fichajes
			[
			'label' => 'Control de fichajes', 
			'visible' => count(array_intersect([0, 4, 5, 11], $grupos))>0, //Lo pueden ver los RTE, DTE, Directores de personal y administradores 
            'items' =>
	            	[
	            		['label' => 'Entradas y salidas', 'url' => ['/fichaje/index']],
		            	['label' => 'Almuerzos', 'url' => ['/fichaje/index-almuerzos']],
		            	['label' => 'Resumen tickadas', 'url' => ['/fichaje/resumen-trabajadores']],
	            	],
	        ],
	        [
	        	'label' => 'Personal', 
				'visible' => count(array_intersect([0, 1, 4, 5, 11], $grupos))>0, 
            	'items' =>
	            	[
	                	['label' => 'Usuarios', 'url' => ['/user/index']],
	                	//['label' => 'Plan supervisiones in situ', 'url' => ['/historico-mantenimientos-cualificaciones/plan-supervisiones-in-situ']],
	                	//['label' => 'Listado de personal cualificados', 'url' => ['/historico-mantenimientos-cualificaciones/ifo010201']],
	                	[	
							'label' => 'Listado de personal cualificado', 
				            'items' =>
					            	[
					            	//	['label' => 'Inspectores ed3', 'url' => ['/historico-mantenimientos-cualificaciones/ifo010201ed3']],
					            		['label' => 'Inspectores', 'url' => ['/historico-mantenimientos-cualificaciones/ifo010201ed5']],
					            		['label' => 'Responsables Técnicos', 'url' => ['/historico-mantenimientos-cualificaciones/ifo010209ed2']],
					            		
					            	],
				        ],
	                	[	
							'label' => 'Planes supervisiones in situ', 
				            'items' =>
					            	[
					           // 		['label' => 'Inspectores ed3', 'url' => ['/historico-mantenimientos-cualificaciones/ifo010206ed3']],
					            		['label' => 'Inspectores', 'url' => ['/historico-mantenimientos-cualificaciones/ifo010206ed5']],
					            		['label' => 'Responsables Técnicos', 'url' => ['/historico-mantenimientos-cualificaciones/ifo010210ed2']],
					            		
					            	],
				        ],
	                	
	                	
	                	
	                	'<li class="divider"></li>',
	                	['label' => 'Control Fichas Técnicas', 'url' => ['/control-documental-fichas-tecnicas'], 'visible' => count(array_intersect([Yii::$app->user->identity->estacionPredeterminada->codigo], ['0302','0308','0355']))>0 ],
	                	['label' => 'Control Producción Fichas Técnicas', 'url' => ['/control-documental-fichas-tecnicas/produccion'], 'visible' => count(array_intersect([0, 1, 11, 14], $grupos))>0 ],
	                	'<li class="divider"></li>',
	                	['label' => 'Formación', 'url' => ['/formacion'], 'visible' => count(array_intersect([0, 1, 11, 14], $grupos))>0, ],
		        	],
	        ],
			//Item_configuracion
			[
			'label' => 'Configuración', 
			'visible' => count(array_intersect([0, 1, 7, 11, 14], $grupos))>0, 
            'items' =>
	            	[
	            		['label' => 'Localizaciones', 'url' => ['/zona/index']],
		            	['label' => 'Sedes', 'url' => ['/estacion/index']],
		            	['label' => 'Usuarios', 'url' => ['/user/index']],
		            	['label' => 'Grupos', 'url' => ['/grupo/index']],
		            	['label' => 'Acciones fichajes', 'url' => ['/accion/index']],
		            	'<li class="divider"></li>',
		            	[
							'label' => 'Configuración cualificaciones', 
				            'items' =>
					            	[
						            	['label' => 'Criterios mantenimiento cualificación', 'url' => ['/criterios-mantenimientos-cualificacion/index']],
						            	['label' => 'Servicios asociados a cualificaciones', 'url' => ['/estar-asociado/index']],
						            	['label' => 'Asociar Servicios Comunidad a Servicios Itevebasa', 'url' => ['/servicios-alfa/index']],
					            	],
				        ],
		            	//['label' => 'Plan supervisiones in situ', 'url' => ['/historico-mantenimientos-cualificaciones/plan-supervisiones-in-situ']],
		            	//['label' => 'IFO 01-02-01', 'url' => ['/historico-mantenimientos-cualificaciones/ifo010201']],
		            	
	            	],
	        ],
			//Item_gestiónAvisos
			[
			'label' => 'Avisos', 
			'visible' => count(array_intersect([0, 1, 4, 5, 11], $grupos))>0, 
            'items' =>
	            	[
		            	['label' => 'Nuevo', 'url' => ['/aviso/create']],
		            	['label' => 'Listar', 'url' => ['/aviso/index']],
	            	],
	        ],
	        //Item_granOjo
			[
			'label' => 'Gran ojo', 
			'visible' => count(array_intersect([0, 1, 4, 5, 11,21,41], $grupos)) > 0, //Lo pueden ver los RTE, DTE y administradores 
            'items' =>
	            	[
	            		['label' => 'Vencimientos', 'url' => ['/gran-ojo/vencimientos']],
	            		['label' => 'Inspecciones por municipio', 'url' => ['/gran-ojo/inspecciones-por-codigo-postal']],
	            		['label' => 'Tiempos medios por categoría', 'url' => ['/gran-ojo/tiempos-medios-categoria']],
	            		['label' => 'Inspecciones por cualificación', 'url' => ['/gran-ojo/actuaciones-inspectores-por-cualificacion']],
	            		'<li class="divider"></li>',
	            		[
										'label' => 'Control imparcialidad', 
							            'items' =>
											            	[
											            		[
											            			'label' => 'Informes',
											            			'items' => [
											            				['label' => 'Control imparcialidad', 'url' => ['/gran-ojo/control-imparcialidad']],
											            				['label' => 'Seguimiento riesgos imparcialidad', 'url' => ['/seguimiento-control-imparcialidad']],
											            				['label' => 'Justificaciones al seguimiento riesgos imparcialidad', 'url' => ['/seguimiento-riesgos-imparcialidad-justificaciones']],
											            			]
											            		],
											            		
											            		'<li class="divider"></li>',
											            		[
											            			'label' => 'Gestión',
											            			'items' => [
											            				['label' => 'Vehículos personal', 'url' => ['/control-imparcialidad']],
											            				['label' => 'Flotas', 'url' => ['/control-imparcialidad-gestion-flotas']],
											            				['label' => 'Volumen facturación', 'url' => ['/control-imparcialidad-volumen-facturacion']],
											            				['label' => 'Vehículos grupo', 'url' => ['/control-imparcialidad-empresas']],
											            			]
											            		],
											            		
											            	]
								        ],
	            		
	            		'<li class="divider"></li>',
	            		['label' => 'Índice rechazo inspectores', 'url' => ['/gran-ojo/control-inspectores']],
	            		['label' => 'Índice rechazo categorías', 'url' => ['/gran-ojo/indice-rechazo']],
	            				            	
	            	],
	        ],
	        //Item_granOjo
			[
			'label' => 'SisGesDev', 
			'visible' => count(array_intersect([0, 37], $grupos)) > 0, //Lo pueden admninistradoers y Gestor de desviaciones
            'items' =>
				            	[
				            		['label' => 'Nuevo informe (origen)', 'url' => ['/sisgesdev/origen/create']],
				            		['label' => 'Ver informes ...', 'url' => ['/sisgesdev/origen/index']],
				            		'<li class="divider"></li>',
				            		['label' => 'Mis desviaciones', 'url' => ['/sisgesdev/desviacion/mis-desviaciones']],
				            		['label' => 'Desviaciones por validar', 'url' => ['/sisgesdev/desviacion/pendientes-validar']],
				            		['label' => 'Mis tratamientos', 'url' => ['/sisgesdev/tratamiento/mis-tratamientos']],
				            		['label' => 'Tratamientos por validar', 'url' => ['/sisgesdev/tratamiento/pendientes-validar']],
				            		'<li class="divider"></li>',
									[
										'label' => 'Configuración', 
										'visible' => count(array_intersect([0], $grupos)) > 0, //Lo pueden admninistradoers
							            'items' =>
											            	[
											            		'<li class="dropdown-header">Tipos acción</li>',
											            			['label' => 'Listar ...', 'url' => ['/sisgesdev/tipo-accion']],
											            			['label' => 'Nuevo', 'url' => ['/sisgesdev/tipo-accion/create']],
											            			
																
													            '<li class="dropdown-header">Tipos origen</li>',
											            			['label' => 'Listar ...', 'url' => ['/sisgesdev/tipo-origen']],
											            			['label' => 'Nuevo', 'url' => ['/sisgesdev/tipo-origen/create']],
											            			
																'<li class="divider"></li>',
											            	]
								        ]
				            	]
	        ],
	        
			//Item_logout
			[
				'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ],
		];
       /* $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';*/
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid" style="margin-left:2em; margin-right: 2em; padding: 70px 15px 20px;">
    	
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
       
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
    	
        <p class="pull-left">&copy; Itevebasa <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
