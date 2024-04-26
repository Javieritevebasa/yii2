<?php

namespace backend\controllers;

use Yii;
use app\models\ControlImparcialidadVolumenFacturacion;
use app\models\ControlImparcialidadVolumenFacturacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * ControlImparcialidadVolumenFacturacionController implements the CRUD actions for ControlImparcialidadVolumenFacturacion model.
 */
class ControlImparcialidadVolumenFacturacionController extends Controller
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
                        	
                            return count(array_intersect([0, 11, 38,41], ArrayHelper::getColumn(Yii::$app->user->identity->idGrupos,'idGrupo'))) > 0;
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
     * Lists all ControlImparcialidadVolumenFacturacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ControlImparcialidadVolumenFacturacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ControlImparcialidadVolumenFacturacion model.
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
     * Creates a new ControlImparcialidadVolumenFacturacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ControlImparcialidadVolumenFacturacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ControlImparcialidadVolumenFacturacion model.
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
     * Deletes an existing ControlImparcialidadVolumenFacturacion model.
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
     * Finds the ControlImparcialidadVolumenFacturacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ControlImparcialidadVolumenFacturacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ControlImparcialidadVolumenFacturacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
