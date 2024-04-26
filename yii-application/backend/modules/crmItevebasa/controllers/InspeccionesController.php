<?php

namespace backend\modules\crmItevebasa\controllers;

use Yii;
use yii\data\SqlDataProvider;
use backend\modules\crmItevebasa\models\Inspecciones;
use backend\modules\crmItevebasa\models\InspeccionesSearch;
use backend\modules\crmItevebasa\models\VencimientosSearch;
use backend\modules\crmItevebasa\models\VencimientosForm;
use backend\modules\crmItevebasa\models\Municipio;
use backend\modules\crmItevebasa\models\Poblacion;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



/**
 * InspeccionesController implements the CRUD actions for Inspecciones model.
 */
class InspeccionesController extends Controller
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
     * Lists all Inspecciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InspeccionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	public function actionExportar($fechaDesde, $fechaHasta)
	{
		
		$searchModel = new VencimientosSearch();
		$searchModel->fechaDesde = $fechaDesde;
		$searchModel->fechaHasta = $fechaHasta;
		
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$this->layout = 'excel';
		echo header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
		echo header('Content-Disposition: attachment; filename=nombre_archivo.xls');
		
		
		echo $this->render('exportar', [
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		        ]);
				
	}

	public function actionVencimientos()
	{
		
		$formModel = new VencimientosForm();
		if ($formModel->load(Yii::$app->request->post())) {
			//die('"'.implode('","',  $formModel->estaciones).'"');
			
			$sql = "
			select 
				crm_vencimientos.FechaProximaInspeccion 'FechaProximaInspeccion', 
				str_to_date(inspecciones.FechaInspeccion,'%d%m%Y') 'UltimaInspeccion', 
				inspecciones.estacion Estacion, 
				inspecciones.matricula Matricula, 
				inspecciones.FaseInspeccion FaseInspeccion, 
				inspecciones.Categoria Categoria, 
				d_categorias.tipo TipoVehiculo,
				inspecciones.marca Marca, 
				inspecciones.nombre Propietario, 
				case when drvTblCodigosPostales.nombreMunicipio is null then inspecciones.Municipio else drvTblCodigosPostales.nombreMunicipio end 'Municipio',
				inspecciones.Telefono1 Telefono1, 
				inspecciones.Telefono2 Telefono2 
			from crm_vencimientos 
			inner join inspecciones on crm_vencimientos.InformeMecanica = inspecciones.InformeMecanica and crm_vencimientos.matricula=inspecciones.matricula
			left join  (select distinct codigoPostal, nombreMunicipio  from d_codigosPostales) drvTblCodigosPostales on  (drvTblCodigosPostales.codigoPostal = inspecciones.codigoPostal)
			left join d_categorias on inspecciones.Categoria =  d_categorias.codigo collate latin1_spanish_ci
			where 
				crm_vencimientos.FechaProximaInspeccion between :fechaDesde and :fechaHasta
			    and estacion in (:estaciones)
			order by Estacion, FechaProximaInspeccion
			";			
			
			$dataProvider = new SqlDataProvider([
			    'sql' => $sql,
			    'params' => [':fechaDesde' => $formModel->fechaDesde, ':fechaHasta' => $formModel->fechaHasta, ':estaciones' => $formModel->estacion],
			    'db' => 'dbPentaho',
			    'pagination' => [
			        'pageSize' => 0,
			    ],
			]);
			
			$this->layout = 'excel';
			

		//echo  $dataProvider->db->createCommand($dataProvider->sql, $dataProvider->params)->getRawSql();die();
		
		
			echo $this->render('exportar', [
		            'dataProvider' => $dataProvider,
		        ]);
				
		//	 return $this->redirect(['index']);
		}
        
		//$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'formModel' => $formModel,
        ]);
	}
	
	public function actionVencimientosV1()
	{
		
		$searchModel = new VencimientosSearch();
		if ($searchModel->load(Yii::$app->request->post())) {
			
			
			$sql = "
			select 
				crm_vencimientos.FechaProximaInspeccion 'FechaProximaInspeccion', 
				str_to_date(inspecciones.FechaInspeccion,'%d%m%Y') 'UltimaInspeccion', 
				inspecciones.estacion Estacion, 
				inspecciones.matricula Matricula, 
				inspecciones.FaseInspeccion FaseInspeccion, 
				inspecciones.Categoria Categoria, 
				d_categorias.tipo TipoVehiculo,
				inspecciones.marca Marca, 
				inspecciones.nombre Propietario, 
				case when drvTblCodigosPostales.nombreMunicipio is null then inspecciones.Municipio else drvTblCodigosPostales.nombreMunicipio end 'Municipio',
				inspecciones.Telefono1 Telefono1, 
				inspecciones.Telefono2 Telefono2 
			from crm_vencimientos 
			inner join inspecciones on crm_vencimientos.InformeMecanica = inspecciones.InformeMecanica and crm_vencimientos.matricula=inspecciones.matricula
			left join  (select distinct codigoPostal, nombreMunicipio  from d_codigosPostales) drvTblCodigosPostales on  (drvTblCodigosPostales.codigoPostal = inspecciones.codigoPostal)
			left join d_categorias on inspecciones.Categoria =  d_categorias.codigo collate latin1_spanish_ci
			where 
				crm_vencimientos.FechaProximaInspeccion between :fechaDesde and :fechaHasta
			    and estacion in ('0302','0308','0352','0355')
			order by Estacion, FechaProximaInspeccion
			";			
			$dataProvider = new SqlDataProvider([
			    'sql' => $sql,
			    'params' => [':fechaDesde' => $searchModel->fechaDesde, ':fechaHasta' => $searchModel->fechaHasta],
			    'db' => 'dbPentaho',
			    'pagination' => [
			        'pageSize' => 0,
			    ],
			]);
			
			$this->layout = 'excel';
			
		
		
			echo $this->render('exportar', [
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		        ]);
				
			 return $this->redirect(['index']);
		}
        
		//$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => null,
        ]);
	}

    /**
     * Displays a single Inspecciones model.
     * @param string $Estacion
     * @param integer $Anyo
     * @param string $InformeMecanica
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Estacion, $Anyo, $InformeMecanica)
    {
    	$model = $this->findModel($Estacion, $Anyo, $InformeMecanica);
		echo "Municipio: ". $model->municipio->nombreMunicipio; die();
		
        return $this->render('view', [
            'model' => $this->findModel($Estacion, $Anyo, $InformeMecanica),
        ]);
    }

    /**
     * Creates a new Inspecciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inspecciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Estacion' => $model->Estacion, 'Anyo' => $model->Anyo, 'InformeMecanica' => $model->InformeMecanica]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Inspecciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Estacion
     * @param integer $Anyo
     * @param string $InformeMecanica
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Estacion, $Anyo, $InformeMecanica)
    {
        $model = $this->findModel($Estacion, $Anyo, $InformeMecanica);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Estacion' => $model->Estacion, 'Anyo' => $model->Anyo, 'InformeMecanica' => $model->InformeMecanica]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Inspecciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Estacion
     * @param integer $Anyo
     * @param string $InformeMecanica
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Estacion, $Anyo, $InformeMecanica)
    {
    	throw new NotFoundHttpException('The requested page does not exist.');
		 
        $this->findModel($Estacion, $Anyo, $InformeMecanica)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inspecciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Estacion
     * @param integer $Anyo
     * @param string $InformeMecanica
     * @return Inspecciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Estacion, $Anyo, $InformeMecanica)
    {
        if (($model = Inspecciones::findOne(['Estacion' => $Estacion, 'Anyo' => $Anyo, 'InformeMecanica' => $InformeMecanica])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
