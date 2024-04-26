<?php

namespace frontend\controllers;

use Yii;
use common\models\Aviso;
use common\models\Fichajes;
use common\models\FichajesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FichajesController implements the CRUD actions for Fichajes model.
 */
class FichajesController extends Controller
{
    /**
     * @inheritdoc
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
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


	public function actionForzarEkon($idUser, $idAccion)
	{
		$model = new Fichajes();
		$model->idUser = $idUser;
		$model->idAccion = $idAccion;
		$model->FicharEkon();
		die();
	}
	
    /**
     * Creates a new Fichajes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	
		//Modificacion para que si tienes avisos pendientes no puedas tickar (pido por Antonio 24-11-2016)
		$query = Aviso::find()->select('aviso.*')
		            ->leftJoin('notificar', 'aviso.idAviso = notificar.idAviso')
		            ->where(['notificar.idUser' => Yii::$app->user->identity->id,
		            	'notificar.signadoEl' => null
		            ]);
					
		if (count($query->all()) != 0)
		{
			return $this->redirect(['aviso/index']);
		}
		
        $model = new Fichajes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/index', 'id' => $model->idFichajes]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Fichajes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idFichajes]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Fichajes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
