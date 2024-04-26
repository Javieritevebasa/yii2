<?php

namespace backend\modules\sisgesdev\controllers;

use Yii;
use backend\modules\sisgesdev\models\Accion;
use backend\modules\sisgesdev\models\TipoAccion;
use backend\modules\sisgesdev\models\AccionSearch;
use backend\modules\sisgesdev\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccionController implements the CRUD actions for Accion model.
 */
class AccionController extends Controller
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
     * Lists all Accion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Accion model.
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
     * Creates a new Accion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tratamientoId = null)
    {
    	
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
        $model = new Accion();
		
		if ($tratamientoId !== null) $model->tratamientoId = $tratamientoId;
		
		$tiposAccion = TipoAccion::find()->all();
		$usuarios = User::find()->select(['id', 'concat(nombre, " ", apellidos) nombre'])->orderBy('nombre')->all();
      
	  
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if( isset($session['url-back'])){
				$url = $session['url-back'];
				$session->remove('url-back');
			   	return $this->redirect($url);
			}else{
			 	return $this->redirect(['view', 'id' => $model->id]);
			}
        }
		else {
			//print_r($model->getErrors()); die();
		}

        return $this->render('create', [
            'model' => $model,
            'tipoAccion' => $tiposAccion,
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Updates an existing Accion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
    	$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
        $model = $this->findModel($id);
		
		$tiposAccion = TipoAccion::find()->all();
		$usuarios = User::find()->select(['id', 'concat(nombre, " ", apellidos) nombre'])->orderBy('nombre')->all();
      
	  
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
            'tipoAccion' => $tiposAccion,
            'usuarios' => $usuarios,
        ]);
    }


	public function actionVerEvidencias()
	{
		die('Not implementet jet');
	}

    /**
     * Deletes an existing Accion model.
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
     * Finds the Accion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Accion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
