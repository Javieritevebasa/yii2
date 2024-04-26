<?php

namespace backend\modules\sisgesdev\controllers;

use Yii;
use backend\modules\sisgesdev\models\AnalisisExtension;
use backend\modules\sisgesdev\models\AnalisisExtensionSearch;
use backend\modules\sisgesdev\models\Tratamiento;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * AnalisisExtensionController implements the CRUD actions for AnalisisExtension model.
 */
class AnalisisExtensionController extends Controller
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
     * Lists all AnalisisExtension models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnalisisExtensionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnalisisExtension model.
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
     * Creates a new AnalisisExtension model.
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
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste análisis de extensión');
		
        $model = new AnalisisExtension();
		$model->tratamientoId = $tratamientoId;
		
		
		
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
     * Updates an existing AnalisisExtension model.
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
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste análisis de extensión');
		
		
		
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
     * Deletes an existing AnalisisExtension model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		if ($model->tratamiento->responsable != Yii::$app->user->id
			&& $model->tratamiento->desviacion->responsable != Yii::$app->user->id
			&& $model->tratamiento->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste análisis de extensión');
		
		$model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnalisisExtension model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnalisisExtension the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnalisisExtension::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
