<?php

namespace backend\controllers;

use Yii;
use backend\models\ControlDocumentalFichasTecnicas;
use backend\models\ControlDocumentalFichasTecnicasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ControlDocumentalFichasTecnicasController implements the CRUD actions for ControlDocumentalFichasTecnicas model.
 */
class ControlDocumentalFichasTecnicasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
         return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','produccion', ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            
        ];
	}

    /**
     * Lists all ControlDocumentalFichasTecnicas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ControlDocumentalFichasTecnicasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
	/**
     * Lists all ControlDocumentalFichasTecnicas models.
     * @return mixed
     */
    public function actionProduccion()
    {
        $searchModel = new ControlDocumentalFichasTecnicasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('produccion', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	

    /**
     * Finds the ControlDocumentalFichasTecnicas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ControlDocumentalFichasTecnicas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ControlDocumentalFichasTecnicas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
