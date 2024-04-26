<?php

namespace backend\controllers;

use Yii;
use app\models\ControlImparcialidadGestionFlotas;
use app\models\ControlImparcialidadGestionFlotasSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ControlImparcialidadGestionFlotasController implements the CRUD actions for ControlImparcialidadGestionFlotas model.
 */
class ControlImparcialidadGestionFlotasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        	'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view', 'create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index','view', 'create','update','delete'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                        	
                            return count(array_intersect([0, 11, 38, 41], ArrayHelper::getColumn(Yii::$app->user->identity->idGrupos,'idGrupo'))) > 0;
                        }
                    ],
                     [
                        'actions' => ['index',],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                        	
                            return count(array_intersect([4], ArrayHelper::getColumn(Yii::$app->user->identity->idGrupos,'idGrupo'))) > 0;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ControlImparcialidadGestionFlotas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ControlImparcialidadGestionFlotasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ControlImparcialidadGestionFlotas model.
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
     * Creates a new ControlImparcialidadGestionFlotas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ControlImparcialidadGestionFlotas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ControlImparcialidadGestionFlotas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ControlImparcialidadGestionFlotas model.
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
     * Finds the ControlImparcialidadGestionFlotas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ControlImparcialidadGestionFlotas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ControlImparcialidadGestionFlotas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
