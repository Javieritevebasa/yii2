<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use common\models\HistoricoMantenimientosCualificaciones;
use common\models\HistoricoMantenimientosCualificacionesSearch;
use common\models\TipoMantenimientoCualificacion;
use common\models\Cualificaciones;
use common\models\EvaluacionInSitu;
use common\models\User;
use common\models\Grupo;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HistoricoMantenimientosCualificacionesController implements the CRUD actions for HistoricoMantenimientosCualificaciones model.
 */
class HistoricoMantenimientosCualificacionesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }




    /**
     * Lists all HistoricoMantenimientosCualificaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HistoricoMantenimientosCualificacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionPlanSupervisionesInSitu()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [2,3]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC]);
		//echo $usuarios->createCommand()->getRawSql();
		$usuarios = $usuarios->all();
			
		$cualificaciones = Cualificaciones::find()->where(['activo' => true])->orderBy('orden')->all();
		 return $this->render('planSupervisionesInSitu', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}
	

	public function actionIfo010206ed3()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [2,3]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC]);
		//echo $usuarios->createCommand()->getRawSql();
		$usuarios = $usuarios->all();
			
		$cualificaciones = Cualificaciones::find()->where(['activo' => true])->orderBy('orden')->all();
		 return $this->render('ifo010206ed3', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}
	
	
	public function actionIfo010206ed5()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [2,3]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC]);
		//echo $usuarios->createCommand()->getRawSql();
		$usuarios = $usuarios->all();
			
		$cualificaciones = Cualificaciones::find()->where(['in', 'id', [1,2,3,4,5, 18, 20 ]])->orderBy('orden')->all();
		 return $this->render('ifo010206ed5', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
		
	} 
	public function actionIfo010206ed4()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [2,3]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC]);
		//echo $usuarios->createCommand()->getRawSql();
		$usuarios = $usuarios->all();
			
		$cualificaciones = Cualificaciones::find()->where(['in', 'id', [1,2,3,4,5, 10, 18, 20 ]])->orderBy('orden')->all();
		 return $this->render('ifo010206ed4', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
		
	}
	
	
	
	public function actionIfo010210ed0()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [4]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC]);
		//echo $usuarios->createCommand()->getRawSql();
		$usuarios = $usuarios->all();
			
		$cualificaciones = Cualificaciones::find()->joinWith('especialidad')->where(['activo' => true])->andWhere(['in', 'especialidad.id', [ 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18 ]])->orderBy('orden')->all();
		 return $this->render('ifo010210ed0', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}


	public function actionIfo010210ed2()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [4]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC]);
		//echo $usuarios->createCommand()->getRawSql();
		$usuarios = $usuarios->all();
			
		$cualificaciones = Cualificaciones::find()->joinWith('especialidad')->where(['activo' => true])->andWhere(['in', 'especialidad.id', [ 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ]])->orderBy('orden')->all();
		 return $this->render('ifo010210ed2', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}
	
	
	public function actionIfo010210ed1()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [4]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC]);
		//echo $usuarios->createCommand()->getRawSql();
		$usuarios = $usuarios->all();
			
		$cualificaciones = Cualificaciones::find()->joinWith('especialidad')->where(['activo' => true])->andWhere(['in', 'especialidad.id', [ 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ]])->orderBy('orden')->all();
		 return $this->render('ifo010210ed1', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}
	
	public function actionIfo010201()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [2,3]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC])
			->all();
			
		$cualificaciones = Cualificaciones::find()->where(['activo' => true])->orderBy('orden')->all();
		 return $this->render('ifo010201', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}
	
	public function actionIfo010201ed3()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [2, 3]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC])
			->all();
			
		$cualificaciones = Cualificaciones::find()->where(['activo' => true])->orderBy('orden')->all();
		 return $this->render('ifo010201ed3', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}
	
	
	public function actionIfo010201ed5()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [2, 3]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC])
			->all();
			
		$cualificaciones = Cualificaciones::find()->where(['in', 'id', [1,2,3,4,5, 18, 20 ]])->orderBy('orden')->all();
		 return $this->render('ifo010201ed5', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}

	public function actionIfo010201ed4()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [2, 3]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC])
			->all();
			
		$cualificaciones = Cualificaciones::find()->where(['in', 'id', [1,2,3,4,5, 10, 18, 20 ]])->orderBy('orden')->all();
		 return $this->render('ifo010201ed4', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}


	
	public function actionIfo010209ed0()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
			->joinWith('especialidades')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [4]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC])
			->all();
			
		$cualificaciones = Cualificaciones::find()->joinWith('especialidad')->where(['activo' => true])->andWhere(['in', 'especialidad.id', [ 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18 ]])->orderBy('orden')->all();
		 return $this->render('ifo010209ed0', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}
	
	public function actionIfo010209ed2()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
			->joinWith('especialidades')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [4]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC])
			->all();
			
		$cualificaciones = Cualificaciones::find()->joinWith('especialidad')->where(['activo' => true])->andWhere(['in', 'especialidad.id', [ 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ]])->orderBy('orden')->all();
		 return $this->render('ifo010209ed2', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}
	
	
	public function actionIfo010209ed1()
	{
		
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
        //$query = User::find();
		$usuarios = \backend\models\User::find()
			->joinWith('asignars')
			->joinWith('idGrupos')
			->joinWith('especialidades')
	 		->andWhere(['predeterminada' => true])
			//->andWhere(['in','idGrupo',[2,3]])
			->andWhere(['in','codigoEstacion', $_estaciones] )
			->andWhere(['in','grupo.idGrupo', [4]] )
			->andWhere(['in','status' , [10, 20, 21, 30]])
			->orderBy(['codigoEstacion' => SORT_ASC, 'apellidos' => SORT_ASC, 'codigoInspector' => SORT_ASC])
			->all();
			
		$cualificaciones = Cualificaciones::find()->joinWith('especialidad')->where(['activo' => true])->andWhere(['in', 'especialidad.id', [ 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ]])->orderBy('orden')->all();
		 return $this->render('ifo010209ed1', [
            'usuarios' => $usuarios,
            'cualificaciones' => $cualificaciones,
        ]);
	}
	
    /**
     * Displays a single HistoricoMantenimientosCualificaciones model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HistoricoMantenimientosCualificaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idUser, $especialidad = 0)
    {
    	
        $model = new HistoricoMantenimientosCualificaciones();
		
		
		$evaluaciones = [];
		$model->idUser = $idUser;
		
		$tipoMantenimientoCualificacion = TipoMantenimientoCualificacion::find()->all();
		if ($especialidad == 0)
			$cualificaciones = Cualificaciones::find()->innerJoinWith('grupoCategorias')->where(['activo' => true])->orderBy('orden')->all();
		else
			$cualificaciones = Cualificaciones::find()->innerJoinWith('especialidad')->where(['activo' => true])->orderBy('orden')->all();
		
        $usuarios = User::find()->innerJoinWith('pertenecers')->where(['in', 'idGrupo', [15,4]])->orderBy('nombre,apellidos')->all();
	   	
		$grupos = Grupo::find()->where(['in', 'idGrupo', [2,4]])->all(); //Inspectores, Responsable técnico
	    if ($model->load(Yii::$app->request->post())){
	    	
			
	    	$transaccion = $model->db->beginTransaction();

			$model->resultadoGlobal = true;
			try{
			
				$evaluacionesTuteladas = 0;
				$evaluacionesSupervisadas = 0;
				
				if (!key_exists('EvaluacionInSitu', Yii::$app->request->post()))
				{
					$model->addError('idCualificacion', 'Debe incluir evaluciones in situ');
				}
				
		        foreach (Yii::$app->request->post()['EvaluacionInSitu'] as $evaluacion) {
		             $e = new EvaluacionInSitu();
		             $evaluaciones[] = $e;
					 $model->resultadoGlobal &= $evaluacion['resultado'];
					 switch ($evaluacion['idTipoEvaluacion']) {
						 case 1:
							 $evaluacionesSupervisadas++;
							 break;
						 case 2:
							 $evaluacionesTuteladas++;
							 break;
						 default:
							 
							 break;
					 }
		        }
				
				
			
				
				if (!$model->resultadoGlobal)
				{
					//$model->fechaHasta = new \yii\db\Expression('NOW()');
					$model->fechaHasta = $model->fechaDesde;
				}
				else {
					
					$date = \DateTime::createFromFormat ('Y-m-d', $model->fechaDesde);
					$date = $date->modify('+1 year');
					$model->fechaHasta = $date->format('Y-m-d');
					
					//$model->fechaHasta =   ;
				}
					
				if ($model->save()) {
					
						
					foreach ($evaluaciones as $key => $evaluacion) 	
						$evaluacion->idHistoricoMantenimientosCualificacion = $model->id;
					
					if (Model::loadMultiple($evaluaciones, Yii::$app->request->post()))
					{
						
						
						//if( Model::validateMultiple($evaluaciones) )
						{
							//Comprobamos que tenemos todos las evaluaciones necesiarias
							$minimoSupervisadas = $model->cualificacion->getCriteriosMantenimientosCualificacions()
												->andWhere(['idTipoMantenimientoCualificacion' => $model->idTipoMantenimientoCualificacion])
												->andWhere(['cualificadoComo' => $model->cualificadoComo])->one()->numeroSupervisiones;
						
							if ($evaluacionesSupervisadas < $minimoSupervisadas )
							{
								$model->addError('idCualificacion', 'Faltan evaluaciones supervisadas encontradas '.$evaluacionesSupervisadas. ' requeridas '.$minimoSupervisadas);
								throw new \Exception('Faltan evaluaciones supervisadas');
							}
							
							$minimoTuteladas = $model->cualificacion->getCriteriosMantenimientosCualificacions()
															->andWhere(['idTipoMantenimientoCualificacion' => $model->idTipoMantenimientoCualificacion])
															->andWhere(['cualificadoComo' => $model->cualificadoComo])
															->one()->numeroMinimoTuteladas;
							if ($evaluacionesTuteladas < $minimoTuteladas)
							{
								$model->addError('idCualificacion', 'Faltan evaluaciones tuteladas');
								throw new \Exception('Faltan evaluaciones tuteladas '. $minimoTuteladas);
							}
								
							$e = 0;
							foreach ($evaluaciones as $key => $evaluacion) {
								$evaluacion->documentoIFO010205 = '['.$e.']documentoIFO010205';
								//echo '->'.$evaluacion->documentoIFO010205.'<-' .$evaluacion->referenciaEvaluacion;
								if (!$evaluacion->save()) throw new \Exception('No se ha podido guardar la evaluacion in situ');
								$model->resultadoGlobal &= $evaluacion->resultado;
								$e++;
							}	

							//throw new \Exception('Resultado global'.$model->resultadoGlobal );
							//if(!$model->save()) throw new \Exception('No se ha podido guardar el resultado de global');
			            	//return $this->redirect(['view', 'id' => $model->id]);
						}
						/*else {
							foreach ($evaluaciones as $key => $evaluacion) {
								$model->addErrors($evaluacion->getErrors());	
							}
							
							throw new \Exception('Revise los datos de las evaluciones in situ');
						}*/
					}
					else {
						throw new \Exception('No se ha podido guardar la evaluación');
					}
					
					$transaccion->commit();
					return $this->redirect(['user/view', 'id' => $model->idUser]);
				}
				
			}catch(\Exception $ex)
			{
				
				$transaccion->rollback();
				$model->addError('idCualificacion', $ex->getMessage());
				
			}
			
        }
	if (Yii::$app->request->isAjax) {
		echo "#1"; 
		//print_r (Yii::$app->request->post()['idUser']);  
		$idCualificacion= Yii::$app->request->post()['idCualificacion'];
		$cualificadoComo= Yii::$app->request->post()['cualificadoComo'];
		$idTipoMantenimientoCualificacion = Yii::$app->request->post()['idTipoMantenimientoCualificacion'];
		
		if ($idCualificacion==='') die('Falta la cualificación');
		if ($cualificadoComo==='') die('Falta en que se cualifica');
		if ($idTipoMantenimientoCualificacion==='') die('Falta el tipo de cualificación');
		echo "#2"; //die($idTipoMantenimientoCualificacion);
		$usuario = User::find()->where(['id' => $idUser])->one();
		
		$connection = Yii::$app->db;
		$sql = '
		select idUser, codigosAlfaEspecilizaciones, drvServiciosAlfa.idZona, idEspecialidad, codigosAlfaCualificacionBase, categorias  from (
			select codigosAlfaEspecilizaciones, group_concat(estacion.codigo) estaciones, estacion.idZona, idEspecialidad from estacion inner join (
			select group_concat(serviciosAlfa.codigo) codigosAlfaEspecilizaciones, idZona, idEspecialidad from serviciosAlfa inner join estarAsociado on estarAsociado.idServicio = serviciosAlfa.idServicio group by idZona, idEspecialidad) drvTbl
			on drvTbl.idZona = estacion.idZona
			group by estacion.idZona, idEspecialidad
		) drvServiciosAlfa
		inner join (
			select drvTbl.idUser,  drvTbl.idZona, codigosAlfaCualificacionBase, group_concat(categoriaVehiculo.nombre) categorias 
			from ( 
				SELECT idUser, grupoCategorias.nombre, idZona, group_concat(serviciosAlfa.codigo) codigosAlfaCualificacionBase, serviciosAlfa.idServicio, grupoCategorias.id 
				FROM grupoCategorias 
					left join tickadas.estarCualificado on grupoCategorias.id=estarCualificado.idGrupoCategorias 
					left join serviciosAlfa on serviciosAlfa.idServicio = grupoCategorias.idServicio
				  
				where cualificadoComo = '.$cualificadoComo.' and idUser = '.$idUser.' 
				group by idUser, grupoCategorias.nombre, estarCualificado.fechaCualificacion, estarCualificado.fechaVencimiento, serviciosAlfa.idServicio, serviciosAlfa.idZona, grupoCategorias.id
			 ) drvTbl 
			left join categoriaVehiculo on categoriaVehiculo.idGrupoCategorias = drvTbl.id 
			
		) drvCategorias on drvServiciosAlfa.idZona = drvCategorias.idZona
		';
		
		echo ('Recuperamos las cualificación');
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
				estaciones nvarchar(500),
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
	
		$sql = "select a.informeMecanica, i.estacion, idUser, tmpCualificaciones.nombre, userFedereated.codigoInspector from tmpCualificaciones  
			left join userFedereated on  userFedereated.id=tmpCualificaciones.idUser
		    left join alcances a on userFedereated.codigoInspector = a.CodigoInspector
			left join inspecciones i on a.Estacion=i.Estacion and a.Anyo=i.Anyo and a.InformeMecanica=i.InformeMecanica 
			where 
				str_to_date(i.FechaInspeccion,'%d%m%Y')  between tmpCualificaciones.fechaCualificacion and tmpCualificaciones.fechaVencimiento
		        and find_in_set(CONVERT(i.TipoInspeccion, signed integer), tmpCualificaciones.codigosAlfa) > 0  
		        and find_in_set(i.categoria, tmpCualificaciones.categorias) > 0   
		        and find_in_set(i.estacion, tmpCualificaciones.estaciones) >0
		    limit 10";
		
		$command = $connection->createCommand($sql);
		
		try
		{
			$resultado = $command->queryAll();
		}catch (\Exception $ex)
		{
			echo $ex->getMessage();
			die('Aki '.__LINE__);	
		}
			
		$connection->close();
	
	
	//print_r($resultado); die();
   	
	    $actuaciones = 	new ArrayDataProvider([
	        'allModels' => $resultado,
	       
	        'pagination' => [
	            'pageSize' => 0,
	        ],
	    ]);
	    //die('Aki '.__LINE__);	
	    try{
	    	//print_r($actuaciones); 
	   		return $this->renderPartial('create', [
	   		'model' => $model,
            'tipoMantenimientoCualificacion' => $tipoMantenimientoCualificacion,
            'cualificaciones' => $cualificaciones,
            'usuarios' => $usuarios,
            'grupos' => $grupos,
            'evaluaciones' => $evaluaciones,
	   		'actuaciones' => $actuaciones], true);
	        
	                //Yii::$app->end();
		}catch (\Exception $ex)
	    {
	    	echo $ex->getMessage();
			die('Aki '.__LINE__);	
	    }
	    return;
	}//if Ajax
    return $this->render('create', [
            'model' => $model,
            'tipoMantenimientoCualificacion' => $tipoMantenimientoCualificacion,
            'cualificaciones' => $cualificaciones,
            'usuarios' => $usuarios,
            'grupos' => $grupos,
            'evaluaciones' => $evaluaciones
        ]);
    }
	
	
	
	/**
     * Creates a new HistoricoMantenimientosCualificaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateEspecialidad($idUser)
    {
        $model = new HistoricoMantenimientosCualificaciones();
		$model->idUser = $idUser;
		
		$tipoMantenimientoCualificacion = TipoMantenimientoCualificacion::find()->all();
		$cualificaciones = Cualificaciones::find()->innerJoinWith('grupoCategorias')->all();
        $usuarios = User::find()->all();
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'tipoMantenimientoCualificacion' => $tipoMantenimientoCualificacion,
            'cualificaciones' => $cualificaciones,
        ]);
    }

    /**
     * Updates an existing HistoricoMantenimientosCualificaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
    	
    	$comprobarEvaluacionesInSitu = false;
		
        $model = $this->findModel($id);

		$tipoMantenimientoCualificacion = TipoMantenimientoCualificacion::find()->all();
		if (!$model->cualificacion->especialidad)
			$cualificaciones = Cualificaciones::find()->innerJoinWith('grupoCategorias')->all();
		else
			$cualificaciones = Cualificaciones::find()->innerJoinWith('especialidad')->all();
        $usuarios = User::find()->innerJoinWith('pertenecers')->where(['in', 'idGrupo', [15,4]])->orderBy('nombre,apellidos')->all();
	   	
		$grupos = Grupo::find()->where(['in', 'idGrupo', [2,4]])->all(); //Inspectores, Responsable técnico
		
        if ($model->load(Yii::$app->request->post())) {
        	
        	$transaccion = $model->db->beginTransaction();

			//
			try{
			
				$evaluacionesTuteladas = 0;
				$evaluacionesSupervisadas = 0;
				
				if ($comprobarEvaluacionesInSitu && !key_exists('EvaluacionInSitu', Yii::$app->request->post()))
				{
					$model->addError('idCualificacion', 'Debe incluir evaluciones in situ');
				}
				$evaluaciones = [];
				
				if (key_exists('EvaluacionInSitu', Yii::$app->request->post())){
					
					$model->resultadoGlobal = true;
			        foreach (Yii::$app->request->post()['EvaluacionInSitu'] as $evaluacion) {
			        	$e = null;
			            if (key_exists('id', $evaluacion))	
							$e = EvaluacionInSitu::findOne($evaluacion['id']);	
						if ( $e === null){
							$e = new EvaluacionInSitu();
	
						}
	 
	  	             	$evaluaciones[] = $e;
						 
						 $model->resultadoGlobal &= $evaluacion['resultado'];
						 switch ($evaluacion['idTipoEvaluacion']) {
							 case 1:
								 $evaluacionesSupervisadas++;
								 break;
							 case 2:
								 $evaluacionesTuteladas++;
								 break;
							 default:
								 
								 break;
						 }
			        }
					
					
				}
				
			
				
				if (!$model->resultadoGlobal)
				{
					//$model->fechaHasta = new \yii\db\Expression('NOW()');
					$model->fechaHasta = $model->fechaDesde;
				}
				else {
					
					$date = \DateTime::createFromFormat ('Y-m-d', $model->fechaDesde);
					$date = $date->modify('+1 year');
					$model->fechaHasta = $date->format('Y-m-d');
					
					//$model->fechaHasta =   ;
				}
				
				if ($model->save()) {
					
						
					foreach ($evaluaciones as $key => $evaluacion) 
					{
						
						if ($evaluacion->isNewRecord)
							$evaluacion->idHistoricoMantenimientosCualificacion = $model->id;
						
					}
					
					$idEvaluacionesActuales = ArrayHelper::getColumn($evaluaciones, 'id');
					
					foreach ($model->evaluacionInSitus as $key => $e) {
					
						if (!in_array($e['id'], $idEvaluacionesActuales))
						{
							$delete = EvaluacionInSitu::findOne($e['id']);
							if (!$delete->delete())
							{
								throw new \Exception('No se pudo eliminar el documento');
							}
						}
					}
				
					if (Model::loadMultiple($evaluaciones, Yii::$app->request->post()))
					{
						
						//Comprobamos que tenemos todos las evaluaciones necesiarias
						if ($comprobarEvaluacionesInSitu){
							$minimoSupervisadas = $model->cualificacion->getCriteriosMantenimientosCualificacions()
												->andWhere(['idTipoMantenimientoCualificacion' => $model->idTipoMantenimientoCualificacion])
												->andWhere(['cualificadoComo' => $model->cualificadoComo])->one()->numeroSupervisiones;
						
							if ($evaluacionesSupervisadas < $minimoSupervisadas )
							{
								$model->addError('idCualificacion', 'Faltan evaluaciones supervisadas encontradas '.$evaluacionesSupervisadas. ' requeridas '.$minimoSupervisadas);
								throw new \Exception('Faltan evaluaciones supervisadas');
							}
							
							$minimoTuteladas = $model->cualificacion->getCriteriosMantenimientosCualificacions()
															->andWhere(['idTipoMantenimientoCualificacion' => $model->idTipoMantenimientoCualificacion])
															->andWhere(['cualificadoComo' => $model->cualificadoComo])
															->one()->numeroMinimoTuteladas;
															
							if ($evaluacionesTuteladas < $minimoTuteladas)
							{
								$model->addError('idCualificacion', 'Faltan evaluaciones tuteladas');
								throw new \Exception('Faltan evaluaciones tuteladas '. $minimoTuteladas);
							}
						}


						$e = 0;
						
						
						foreach ($evaluaciones as $key => $evaluacion) {
							$evaluacion->documentoIFO010205 = '['.$e.']documentoIFO010205';
							
						
							if (!$evaluacion->save()) {
						
								throw new \Exception('No se ha podido guardar la evaluacion in situ');
							}
							$model->resultadoGlobal &= $evaluacion->resultado;
							$e++;
						}	
						
					}
					else {
						if ($comprobarEvaluacionesInSitu)
							throw new \Exception('No se ha podido guardar la evaluación');
					}
					
					$transaccion->commit();
					return $this->redirect(['user/view', 'id' => $model->idUser]);
				}

				
			}catch(\Exception $ex)
			{
				
				$transaccion->rollback();
				
				 echo $ex->getTraceAsString(); die();
				//print_r($ex->getTrace()); die();
				
				
				$model->addError('idCualificacion', $ex->getMessage());
				
			}
           
        }

        return $this->render('update', [
            'model' => $model,
           'tipoMantenimientoCualificacion' => $tipoMantenimientoCualificacion,
            'cualificaciones' => $cualificaciones,
            'usuarios' => $usuarios,
            'grupos' => $grupos,
            'evaluaciones' => $model->evaluacionInSitus
        ]);
    }

    /**
     * Deletes an existing HistoricoMantenimientosCualificaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HistoricoMantenimientosCualificaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HistoricoMantenimientosCualificaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HistoricoMantenimientosCualificaciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
