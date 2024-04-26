<?php

namespace backend\controllers;

use Yii;
use backend\models\SeguimientoRiesgosImparcialidad;
use backend\models\SeguimientoRiesgosImparcialidadSearch;
use app\models\SeguimientoRiesgosImparcialidadJustificaciones;
use app\models\ImpresoPDG0305;
use app\models\PdfDocument;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * SeguimientoControlImparcialidadController implements the CRUD actions for SeguimientoRiesgosImparcialidad model.
 */
class SeguimientoControlImparcialidadController extends Controller
{
    /**
     * {@inheritdoc}
     */
     public function behaviors()
    {
        return [
        	'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create', 'update','delete' ],
                'rules' => [
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                        	
                            return count(array_intersect([0, 7, 11, 41], ArrayHelper::getColumn(Yii::$app->user->identity->idGrupos,'idGrupo'))) > 0;
                        }
                    ],
                    [
                        'actions' => ['create','delete'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                        	
                            return count(array_intersect([0, 7, 41], ArrayHelper::getColumn(Yii::$app->user->identity->idGrupos,'idGrupo'))) > 0;
                        }
                    ],
                    [
                        'actions' => ['index','view', 'informe-control','generarPdg0305' ],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                        	
                            return count(array_intersect([0, 4, 5, 7, 11, 38, 41], ArrayHelper::getColumn(Yii::$app->user->identity->idGrupos,'idGrupo'))) > 0;
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
     * Lists all SeguimientoRiesgosImparcialidad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeguimientoRiesgosImparcialidadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SeguimientoRiesgosImparcialidad model.
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
     * Creates a new SeguimientoRiesgosImparcialidad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SeguimientoRiesgosImparcialidad();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SeguimientoRiesgosImparcialidad model.
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
     * Deletes an existing SeguimientoRiesgosImparcialidad model.
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
	
	public function actionInformeControl($id){
		$model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
			
            return $this->redirect(['view', 'id' => $model->id]);
        }
		
		$plantillasJustificacion = SeguimientoRiesgosImparcialidadJustificaciones::find()->all();
		  
		return $this->render('informeControl', ['model' => $model, 'justificaciones'=> $plantillasJustificacion]);	
	}

	public function actionGenerarPdg0305($id)
	{
		
		$model = $this->findModel($id);
		$pdg0305 = new ImpresoPDG0305();
		$pdg0305->GenerarInforme($model,Yii::getAlias('@app').'/plantillas/tmp/testPDG0305.pdf');
		$pdg0305->firmarDocumento('alfa');
		$pdg0305->subirAAlfresco();
		
		
	}
	
    /**
     * Finds the SeguimientoRiesgosImparcialidad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SeguimientoRiesgosImparcialidad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SeguimientoRiesgosImparcialidad::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
