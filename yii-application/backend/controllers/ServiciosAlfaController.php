<?php

namespace backend\controllers;

use Yii;
use common\models\ServiciosAlfa;
use backend\models\ServiciosAlfaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiciosAlfaController implements the CRUD actions for ServiciosAlfa model.
 */
class ServiciosAlfaController extends Controller
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
     * Lists all ServiciosAlfa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiciosAlfaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiciosAlfa model.
     * @param string $codigo
     * @param integer $idZona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($codigo, $idZona)
    {
        return $this->render('view', [
            'model' => $this->findModel($codigo, $idZona),
        ]);
    }

    /**
     * Creates a new ServiciosAlfa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiciosAlfa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codigo' => $model->codigo, 'idZona' => $model->idZona]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ServiciosAlfa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $codigo
     * @param integer $idZona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($codigo, $idZona)
    {
        $model = $this->findModel($codigo, $idZona);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codigo' => $model->codigo, 'idZona' => $model->idZona]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ServiciosAlfa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $codigo
     * @param integer $idZona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($codigo, $idZona)
    {
        $this->findModel($codigo, $idZona)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiciosAlfa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $codigo
     * @param integer $idZona
     * @return ServiciosAlfa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($codigo, $idZona)
    {
        if (($model = ServiciosAlfa::findOne(['codigo' => $codigo, 'idZona' => $idZona])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
