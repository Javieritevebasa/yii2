<?php

namespace backend\modules\sisgesdev\controllers;

use Yii;
use backend\modules\sisgesdev\models\Evidencia;
use backend\modules\sisgesdev\models\Accion;
use backend\modules\sisgesdev\models\SubirEvidencias;
use backend\modules\sisgesdev\models\EvidenciaSearch;
use backend\modules\sisgesdev\models\ssh;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;

/**
 * EvidenciaController implements the CRUD actions for Evidencia model.
 */
class EvidenciaController extends Controller
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
     * Lists all Evidencia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EvidenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionTest()
	{
		$accion = Accion::findOne(1);
		if ($accion === null)  throw new NotFoundHttpException('No existe la accion');
		$desviacion = $accion->desviacion; 
		
		print_r($desviacion->getEvidencias()->createCommand()->getRawSql());
		print_r($desviacion->getEvidencias()->count());
		$date = \DateTime::createFromFormat("Y-m-d", $desviacion->fecha);
		
		$pathToSave = '/' . $date->format("Y") . '/'. ltrim(rtrim($desviacion->origen0->numeroExpediente)) .'/' . ltrim(rtrim($desviacion->numero));
		echo $pathToSave;
	}
	
	public function actionSubirEvidencias($accionId)
	{
		$accion = Accion::findOne($accionId);
		if ($accion === null)  throw new NotFoundHttpException('No existe la accion');
		$desviacion = $accion->desviacion; 
			
		$model = new SubirEvidencias();
		$model->accionId = $accionId;
		
		
		if (Yii::$app->request->isPost && count($_FILES) != 0) {
		//header('HTTP/1.0 500 Internal Server Error'); die('esto es por pos tabmi'.json_encode(Yii::$app->request->post()['SubirEvidencias']));		
            
			$date = \DateTime::createFromFormat("Y-m-d", $desviacion->fecha);
			$pathToSave = '/' . $date->format("Y") . '/'. ltrim(rtrim($desviacion->origen0->numeroExpediente)) .'/' . ltrim(rtrim($desviacion->numero));
			
			$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
	
            $model->descripcion = Yii::$app->request->post()['SubirEvidencias']['descripcion'];
            if ($model->upload()) {
            	$transaction = $desviacion->db->beginTransaction();
            	$cuantos = $desviacion->getEvidencias()->count();
				
				$evidencia = new Evidencia();
				$evidencia->accionId=$model->accionId;
				$evidencia->ruta = $pathToSave;
				$evidencia->codigoEvidencia = $desviacion->numero.'_'.($cuantos++);
				$evidencia->descripcion = $model->descripcion;
				$evidencia->save();
				
				$ext = pathinfo($model->imageFile, PATHINFO_EXTENSION);
					
				$ssh = new ssh();
				if (!$ssh->subirFichero($model->imageFile, $evidencia->ruta, $evidencia->codigoEvidencia.'.'.$ext))
				{
					 $transaction->rollback();
					 header('HTTP/1.0 500 Internal Server Error');
					 die(json_encode($ssh->getErrors()));
					 throw new NotFoundHttpException('No se pudo guardar los archivos '. json_encode($ssh->getErrors()));
				}

				
 				$transaction->commit(); 
 				
                // file is uploaded successfully
                return;
            }
			else {
				header('HTTP/1.0 500 Internal Server Error');
				die(json_encode($model->getErrors()));
						 
				//throw new NotFoundHttpException('No se pudo cargar el archivo '. json_encode($model->getErrors()));
			}
        }
		
		return $this->renderAjax('formSubirEvidencias', [
            			'model' => $model,
            			'evidencias' => $desviacion->getEvidencias()->all(),
            			]);
		die();
		if ($model->load(Yii::$app->request->post())) {
			
        	//Subimos los ficheros:
        	die('subiendo ...');
    	}
		elseif (Yii::$app->request->isAjax) {
            
		}
	}

    /**
     * Displays a single Evidencia model.
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
     * Creates a new Evidencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
        $model = new Evidencia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if( isset($session['url-back'])){
				$url = $session['url-back'];
				$session->remove('url-back');
			   	return $this->redirect($url);
			}else{
			 	return $this->redirect(['view', 'id' => $model->id]);
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Evidencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
    	if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if( isset($session['url-back'])){
				$url = $session['url-back'];
				$session->remove('url-back');
			   	return $this->redirect($url);
			}else{
			 	return $this->redirect(['view', 'id' => $model->id]);
			}
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Evidencia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
    	$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
        $evidencia = $this->findModel($id);
		$ssh = new ssh();
        $ssh->eliminarFichero($evidencia->ruta,$evidencia->codigoEvidencia);
		
        $evidencia->delete();

        if( isset($session['url-back'])){
			$url = $session['url-back'];
			$session->remove('url-back');
		   	return $this->redirect($url);
		}else{
		 	 return $this->redirect(['index']);
		}
    }

    /**
     * Finds the Evidencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evidencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evidencia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
