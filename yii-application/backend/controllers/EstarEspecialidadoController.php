<?php

namespace backend\controllers;

use Yii;
use common\models\EstarEspecializado;
use backend\models\EstarEspecializadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use yii\filters\AccessControl;

/**
 * EstarEspecialidadoController implements the CRUD actions for EstarEspecializado model.
 */
class EstarEspecialidadoController extends Controller
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
	                        	
	                            return count(array_intersect([0, 14], ArrayHelper::getColumn(Yii::$app->user->identity->idGrupos,'idGrupo'))) > 0;
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
     * Lists all EstarEspecializado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstarEspecializadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EstarEspecializado model.
     * @param integer $idUser
     * @param integer $idEspecialidad
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idUser, $idEspecialidad)
    {
        return $this->render('view', [
            'model' => $this->findModel($idUser, $idEspecialidad),
        ]);
    }

    /**
     * Creates a new EstarEspecializado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EstarEspecializado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idUser' => $model->idUser, 'idEspecialidad' => $model->idEspecialidad]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EstarEspecializado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idUser
     * @param integer $idEspecialidad
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idUser, $idEspecialidad)
    {
        $model = $this->findModel($idUser, $idEspecialidad);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idUser' => $model->idUser, 'idEspecialidad' => $model->idEspecialidad]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EstarEspecializado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idUser
     * @param integer $idEspecialidad
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idUser, $idEspecialidad)
    {
        $this->findModel($idUser, $idEspecialidad)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EstarEspecializado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idUser
     * @param integer $idEspecialidad
     * @return EstarEspecializado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idUser, $idEspecialidad)
    {
        if (($model = EstarEspecializado::findOne(['idUser' => $idUser, 'idEspecialidad' => $idEspecialidad])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
