<?php

namespace backend\modules\sisgesdev\controllers;

use Yii;
use backend\modules\sisgesdev\models\Desviacion;
use backend\modules\sisgesdev\models\Hallazgo;
use backend\modules\sisgesdev\models\Tratamiento;
use backend\modules\sisgesdev\models\Alegacion;
use backend\modules\sisgesdev\models\HallazgoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * HallazgoController implements the CRUD actions for Hallazgo model.
 */
class HallazgoController extends Controller
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
     * Lists all Hallazgo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HallazgoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hallazgo model.
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
     * Creates a new Hallazgo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($desviacionId)
    {
        $model = new Hallazgo();
		$desviacion = Desviacion::findOne($desviacionId);
		if (
			$desviacion->responsable != Yii::$app->user->id
			&& $desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para crear un hallazgo');
		
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
        if ($model->load(Yii::$app->request->post()))
		{
			$model->desviacionId = $desviacionId;
			if ($model->save()) {
				if( isset($session['url-back'])){
					$url = $session['url-back'];
					$session->remove('url-back');
			    	return $this->redirect($url);
				}else{
				 	return $this->redirect(['view', 'id' => $model->id]);
				}
        	}
		}
        return $this->render('create', [
            'model' => $model,
        ]);
    }
	

    /**
     * Updates an existing Hallazgo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		if (
			$model->desviacion->responsable != Yii::$app->user->id
			&& $model->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste hallazgo');
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}

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


	public function actionDesvincularTratamiento($id)
	{
		$model = $this->findModel($id);
		if ($model->tratamiento->responsable != Yii::$app->user->id
			&& $model->desviacion->responsable != Yii::$app->user->id
			&& $model->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste hallazgo');
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		$tratamiento = Tratamiento::findOne($model->tratamientoId);
		$model->tratamientoId = null;
        
        if ($model->save()) {
        	if (count($tratamiento->hallazgos) == 0) 
				$tratamiento->delete();
			
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
	
	public function actionDesvincularAlegacion($id)
	{
		$model = $this->findModel($id);
		if (
			 $model->desviacion->responsable != Yii::$app->user->id
			&& $model->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste hallazgo');
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		$alegacion = Alegacion::findOne($model->alegacionId);
		
		$model->alegacionId = null;
        if ($model->save()) {
        	
			if (count($alegacion->hallazgos) == 0) 
				$alegacion->delete();
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
     * Deletes an existing Hallazgo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		if ($model->desviacion->responsable != Yii::$app->user->id
			&& $model->desviacion->origen0->creadoPor != Yii::$app->user->id) throw new ForbiddenHttpException('Usted no tiene permisos para eliminar éste hallazgo');
		$model->delete();
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
		if( isset($session['url-back'])){
			$url = $session['url-back'];
			$session->remove('url-back');
		   	return $this->redirect($url);
		}else{
		 	  return $this->redirect(['index']);
		}
      
    }

    /**
     * Finds the Hallazgo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hallazgo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hallazgo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
