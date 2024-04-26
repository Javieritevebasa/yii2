<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\models\GranOjo;
use backend\models\User;
use common\models\DServiciosPonderados;

/**
 * AvisoController implements the CRUD actions for Aviso model.
 */
class GranOjoController extends Controller
{
    /**
     * @inheritdoc
     */
     
    
    public function behaviors()
    {
        return [
        	'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['pbi','inspecciones-por-codigo-postal','vencimientos', 'tiempos-medios-categoria', 'control-inspectores', 'indice-rechazo', 'control-imparcialidad', 'dashboard','actuaciones-inspectores-por-cualificacion', 'json-sql-post', 'json-sql'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'json-sql-post' => ['POST'],
                ],
            ],
        ];
    }

    
	
	/**
     * Displays a single Aviso model.
     * @param integer $id
     * @return mixed
     */
    public function actionPbi()
    {
    	
		
    	return $this->render('pbi', []);
    }
	
	
	/**
     * Displays a single Aviso model.
     * @param integer $id
     * @return mixed
     */
    public function actionInspeccionesPorCodigoPostal()
    {
    	
		$model = new GranOjo ();
    	return $this->render('inspeccionesPorCodigoPostal', [
           'estaciones' => $model->getEstaciones(),
           'municipios' => $model->getMunicipios(),
        ]);
    }
	
	

    /**
     * Displays a single Aviso model.
     * @param integer $id
     * @return mixed
     */
    public function actionVencimientos()
    {
    	
		$model = new GranOjo ();
    	return $this->render('vencimientos', [
           'estaciones' => $model->getEstaciones(),
           'categorias' => $model->getCategoriasVehiculos(),
        ]);
    }
	
	
	public function actionControlImparcialidad()
	{
		$model = new GranOjo ();
		$inspectores = User::find()->joinWith('codigoEstacions')->where(['not', ['codigoInspector' => null]])->andWhere(['not', ['codigoInspector' => '']])->andWhere(['in','codigoEstacion', $model->getCodigoEstaciones()] )->all();
		$inspectores = ArrayHelper::map($inspectores, 'codigoInspector', function($element){return $element['nombre'].' '.$element['apellidos'];});
		
		
		return $this->render('controlImparcialidad', 
								[
								'inspectores' => $inspectores,
								]);	
	}
	
	public function actionControlInspectores()
    {
    	
		$model = new GranOjo ();
		
		$inspectores = User::find()->joinWith('codigoEstacions')->where(['not', ['codigoInspector' => null]])->andWhere(['not', ['codigoInspector' => '']])->andWhere(['in','codigoEstacion', $model->getCodigoEstaciones()] )->all();
		$inspectores = ArrayHelper::map($inspectores, 'codigoInspector', function($element){return $element['nombre'].' '.$element['apellidos'];});
		
		$estaciones = $model->getEstaciones();
			
		
		$serviciosPonderados = DServiciosPonderados::find()->select('*')->innerJoin('d_cualificaciones', 'd_serviciosPonderados.cualificacion=d_cualificaciones.id')->asArray()->all();
		
		return $this->render('controlInspectores', 
								[
								'inspectores' => $inspectores,
								'estaciones' => $estaciones,
								'anyos' => [2019,2018,2017],
								'serviciosPonderados' => $serviciosPonderados,
								 'todasEstaciones' =>  ArrayHelper::map($model->getAllEstaciones(), 'codigo', function($element){return $element; }),
								]);	
    }

	public function actionIndiceRechazo()
	{
		$model = new GranOjo();
		$estaciones = $model->getEstaciones();
		
		
		return $this->render('indiceRechazo', [

			'estaciones' => $estaciones,
			'todasEstaciones' =>  ArrayHelper::map($model->getAllEstaciones(), 'codigo', function($element){return $element; }),
		]);
	}
	
	
	/**
     * Displays a single Aviso model.
     * @param integer $id
     * @return mixed
     */
    public function actionTiemposMediosCategoria()
    {
    	
		$model = new GranOjo ();
    	return $this->render('tiemposMediosCategoria', [
           'estaciones' => $model->getEstaciones(),
          
        ]);
    }
	
	public function actionDashboard()
	{
		$this->layout = false;
		
		$model = new GranOjo();
		
		$estaciones = $model->getEstaciones();
		return $this->render('dashboard', ['estaciones' => $estaciones] ); 
		
	}
	
	
	public function actionActuacionesInspectoresPorCualificacion()
	{
		$model = new GranOjo();
		$inspectores = User::find()->joinWith('codigoEstacions')->where(['not', ['codigoInspector' => null]])->andWhere(['not', ['codigoInspector' => '']])->andWhere(['in','codigoEstacion', $model->getCodigoEstaciones()] )->all();
		$inspectores = ArrayHelper::map($inspectores, 'id', function($element){return $element['nombre'].' '.$element['apellidos'];});
		
		$estaciones = $model->getEstaciones();
	
		$connection = Yii::$app->db;
		$sql = '
			select drvTbl.idUser, drvTbl.nombre, fechaCualificacion, fechaVencimiento, codigosAlfa, idServicio,  group_concat(categoriaVehiculo.nombre) categorias from (
			SELECT idUser, grupoCategorias.nombre, estarCualificado.fechaCualificacion, estarCualificado.fechaVencimiento, group_concat(serviciosAlfa.codigo) codigosAlfa, serviciosAlfa.idServicio, grupoCategorias.id FROM  grupoCategorias 
				left join tickadas.estarCualificado on grupoCategorias.id=estarCualificado.idGrupoCategorias
				left join serviciosAlfa on serviciosAlfa.idServicio = grupoCategorias.idServicio
				
			where cualificadoComo = 2 
			group by grupoCategorias.nombre, estarCualificado.fechaCualificacion, estarCualificado.fechaVencimiento,  serviciosAlfa.idServicio, grupoCategorias.id) drvTbl
			left join categoriaVehiculo on categoriaVehiculo.idGrupoCategorias = drvTbl.id
			where drvTbl.idUser in ('.join(',', array_keys($inspectores)) .')
			group by drvTbl.nombre, fechaCualificacion, fechaVencimiento, codigosAlfa, idServicio
		';
		
		
		$command = $connection->createCommand($sql);
		
		$cualificaciones = $command->queryAll();
		
		$c = ArrayHelper::getColumn($cualificaciones, function($element){ return '(\''.join('\',\'', $element).'\')'; });
		
		
		$connection = Yii::$app->dbPentaho;
		$sql = '
	        drop table if exists tmpCualificaciones;
			create TEMPORARY table tmpCualificaciones (
				idUser int,
				nombre varchar(50),
				fechaCualificacion date,
				fechaVencimiento date,
				codigosAlfa nvarchar(500),
				idServicio int,
				categorias  nvarchar(500)
			);
		';
		
		$command = $connection->createCommand($sql);
		
		$resultado = $command->execute();
		
		$sql = 'insert into tmpCualificaciones values '.join(',', $c);
		
		
		$command = $connection->createCommand($sql);
		
		$resultado = $command->execute();
		
		$sql = "select count(0) inspecciones, idUser, tmpCualificaciones.nombre, userFedereated.codigoInspector from tmpCualificaciones  
	left join userFedereated on  userFedereated.id=tmpCualificaciones.idUser
    left join alcances a on userFedereated.codigoInspector = a.CodigoInspector
	left join inspecciones i on a.Estacion=i.Estacion and a.Anyo=i.Anyo and a.InformeMecanica=i.InformeMecanica 
	where 
		str_to_date(i.FechaInspeccion,'%d%m%Y')  between tmpCualificaciones.fechaCualificacion and tmpCualificaciones.fechaVencimiento
        and find_in_set(CONVERT(i.TipoInspeccion, signed integer), tmpCualificaciones.codigosAlfa) > 0  
        and find_in_set(i.categoria, tmpCualificaciones.categorias) > 0   
group by  idUser, tmpCualificaciones.nombre, userFedereated.codigoInspector";
		
		$command = $connection->createCommand($sql);
		
		$resultado = $command->queryAll();
		
		$connection->close();
		
		
		$provider = new ArrayDataProvider([
        'allModels' => $resultado,
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'attributes' => ['inspecciones', 'idUser', 'nombre', 'codigoInspector'],
        ],
    ]);
    
		return $this->render('actuacionesInspectoresPorCualificacion', ['estaciones' => $estaciones, 'provider' => $provider ] ); 
		return json_encode($resultado);	
	}
	
	public function actionJsonSqlPost()
	{
		$sql = Yii::$app->request->post('sql');
		$parametros = Yii::$app->request->post('parametros');
		$debug= Yii::$app->request->post('debug');
		
		return $this->actionJsonSql($sql, $parametros, $debug);
		
	}
	public function actionJsonSql($sql, $parametros, $debug = false, $db= 'dbPentaho')
	{
		switch ($db) {
			case 'dbPentaho':
				$connection = Yii::$app->dbPentaho;
				break;
			case 'dbTickadas':
				$connection = Yii::$app->db;
				break;
			default:
				$connection = Yii::$app->dbPentaho;
				break;
		}
		
		$p = json_decode($parametros);
		$parametros = [];
		$condiction ='';
		foreach ($p as $key => $value) {
			if ( is_array($value))
			{
				$sql = str_replace($key, "'".implode("','", $value)."'", $sql);
				
			}
			else 
				$parametros[$key] =  $value ;
		}
		
		$command = $connection->createCommand($sql, $parametros);
		
		if ($debug){
			header('HTTP/1.0 500 Internal Server Error');
			//print_r( json_decode($parametros));
		 	echo $command->getRawSql(); 
		 	die();
		}
		$resultado = $command->queryAll();
		
		
		return json_encode($resultado);	
	}
	

    
}
