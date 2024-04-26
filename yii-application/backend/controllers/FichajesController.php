<?php

namespace backend\controllers;

use Yii;
use backend\models\Fichajes;
use backend\models\FichajesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FichajesController implements the CRUD actions for Fichajes model.
 */
class FichajesController extends Controller
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
                   // 'cerrar' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Fichajes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FichajesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fichajes model.
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
     * Creates a new Fichajes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fichajes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idFichajes]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fichajes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
		{
			//print_r(Yii::$app->request->post());
			//print_r($model); die();
			if( $model->save()) {
            	return $this->redirect(['view', 'id' => $model->idFichajes]);
        	}
		}

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	
	public function actionCerrar()
	{
		$model = new Fichajes();
		if(!array_key_exists('idFichajes', Yii::$app->request->post('Fichajes')))
		{
			$model->load(Yii::$app->request->post());
			$model->fechaHora =  \DateTime::createFromFormat ( 'Y-m-d H:i:s', Yii::$app->request->post('Fichajes')['fechaHora'] );
			return $this->render('create', [
            	'model' => $model,
        	]);
		}
		else{
			if ($model->load(Yii::$app->request->post())  && $model->save())
			{
				$fecha =  \DateTime::createFromFormat ( 'Y-m-d H:i:s',  $model->fechaHora );
			
				return $this->redirect(['fichaje/index', 'fecha' => $fecha->format('d-m-Y')]);
			}
		}
        
		print_r($model->getErrors());
        die('ups');
		
		return $this->render('update', [
            	'model' => $model,
        	]);
		
	}
	
	public function actionCerrarv1()
    {
    	print_r(Yii::$app->request->post());
		//die( Yii::$app->request->post('Fichajes')['idFichajes']);
		if(!array_key_exists('idFichajes', Yii::$app->request->post('Fichajes')))
		{
			$model = new Fichajes();
			$model->fechaHora =  \DateTime::createFromFormat ( 'Y-M-d H:i:s', Yii::$app->request->post('Fichajes')['fechaHora'] );
		}
		else{
			 $model = $this->findModel(Yii::$app->request->post('Fichajes')['idFichajes']);
		}
        
		
        if ($model->load(Yii::$app->request->post()))
		{
			
			if($model->save()) {
	        	
				
	        return $this->render('update', [
            	'model' => $model,
        	]);
        	}
			else {
				
				die('no guarda');
			}
			die('aki');
		}
		else {
			die('error');
			
		}
		
		
    }

    /**
     * Deletes an existing Fichajes model.
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
     * Finds the Fichajes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fichajes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fichajes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
