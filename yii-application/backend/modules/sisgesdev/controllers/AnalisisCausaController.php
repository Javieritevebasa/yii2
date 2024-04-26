<?php

namespace backend\modules\sisgesdev\controllers;

use Yii;
use backend\modules\sisgesdev\models\Tratamiento;
use backend\modules\sisgesdev\models\AnalisisCausa;
use backend\modules\sisgesdev\models\AnalisisCausaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * AnalisisCausaController implements the CRUD actions for AnalisisCausa model.
 */
class AnalisisCausaController extends Controller
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
     * Lists all AnalisisCausa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnalisisCausaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnalisisCausa model.
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
     * Creates a new AnalisisCausa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tratamientoId)
    {
    	$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
		$tratamiento = Tratamiento::findOne($tratamientoId);
		if (
			$tratamiento->responsable != Yii::$app->user->id
			&& $tratamiento->desviacion->responsable != Yii::$app->user->id
			&& $tratamiento->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste análisis de causas');
		
        $model = new AnalisisCausa();
		
		
		if ($tratamientoId != null) $model->tratamientoId = $tratamientoId;
		
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
     * Updates an existing AnalisisCausa model.
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
		if ($model->tratamiento->responsable != Yii::$app->user->id
			&& $model->tratamiento->desviacion->responsable != Yii::$app->user->id
			&& $model->tratamiento->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste análisis de causas');
		
		

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
     * Deletes an existing AnalisisCausa model.
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
		
        $model = $this->findModel($id);
		if ($model->tratamiento->responsable != Yii::$app->user->id
			&& $model->tratamiento->desviacion->responsable != Yii::$app->user->id
			&& $model->tratamiento->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste análisis de causas');
		
		$model->delete();
		if( isset($session['url-back'])){
				$url = $session['url-back'];
				$session->remove('url-back');
			   	return $this->redirect($url);
			}else{
			 	return $this->redirect(['index']);
			}
        
    }

    /**
     * Finds the AnalisisCausa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnalisisCausa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnalisisCausa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
