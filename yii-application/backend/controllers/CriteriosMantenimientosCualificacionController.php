<?php

namespace backend\controllers;

use Yii;
use common\models\CriteriosMantenimientosCualificacion;
use common\models\CriteriosMantenimientosCualificacionSearch;
use common\models\TipoMantenimientoCualificacion;
use common\models\Cualificaciones;
use common\models\Grupo;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CriteriosMantenimientosCualificacionController implements the CRUD actions for CriteriosMantenimientosCualificacion model.
 */
class CriteriosMantenimientosCualificacionController extends Controller
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
     * Lists all CriteriosMantenimientosCualificacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CriteriosMantenimientosCualificacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CriteriosMantenimientosCualificacion model.
     * @param integer $idCualificacion
     * @param integer $idTipoMantenimientoCualificacion
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idCualificacion, $idTipoMantenimientoCualificacion, $cualificadoComo)
    {
        return $this->render('view', [
            'model' => $this->findModel($idCualificacion, $idTipoMantenimientoCualificacion, $cualificadoComo),
        ]);
    }

    /**
     * Creates a new CriteriosMantenimientosCualificacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CriteriosMantenimientosCualificacion();
		
		$cualificaciones = Cualificaciones::find()->all();
		$tipoMantenimientoCualificacion = TipoMantenimientoCualificacion::find()->all();
		$grupos = Grupo::find()->where(['in', 'idGrupo', [2,4]])->all(); //Inspectores, Responsable técnico
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idCualificacion' => $model->idCualificacion, 'idTipoMantenimientoCualificacion' => $model->idTipoMantenimientoCualificacion, 'cualificadoComo' => $model->cualificadoComo]);
        }

        return $this->render('create', [
            'model' => $model,
            'cualificaciones' => $cualificaciones,
            'tipoMantenimientoCualificacion' => $tipoMantenimientoCualificacion,
            'grupos' => $grupos,
        ]);
    }

    /**
     * Updates an existing CriteriosMantenimientosCualificacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idCualificacion
     * @param integer $idTipoMantenimientoCualificacion
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idCualificacion, $idTipoMantenimientoCualificacion, $cualificadoComo)
    {
        $model = $this->findModel($idCualificacion, $idTipoMantenimientoCualificacion, $cualificadoComo);

		$cualificaciones = Cualificaciones::find()->all();
		$tipoMantenimientoCualificacion = TipoMantenimientoCualificacion::find()->all();
		$grupos = Grupo::find()->where(['in', 'idGrupo', [2,4]])->all(); //Inspectores, Responsable técnico
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idCualificacion' => $model->idCualificacion, 'idTipoMantenimientoCualificacion' => $model->idTipoMantenimientoCualificacion, 'cualificadoComo' => $cualificadoComo]);
        }

        return $this->render('update', [
            'model' => $model,
            'cualificaciones' => $cualificaciones,
            'tipoMantenimientoCualificacion' => $tipoMantenimientoCualificacion,
            'grupos' => $grupos,
        ]);
    }

    /**
     * Deletes an existing CriteriosMantenimientosCualificacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idCualificacion
     * @param integer $idTipoMantenimientoCualificacion
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idCualificacion, $idTipoMantenimientoCualificacion, $cualificadoComo)
    {
        $this->findModel($idCualificacion, $idTipoMantenimientoCualificacion. $cualficadoComo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CriteriosMantenimientosCualificacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idCualificacion
     * @param integer $idTipoMantenimientoCualificacion
     * @return CriteriosMantenimientosCualificacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idCualificacion, $idTipoMantenimientoCualificacion, $cualificadoComo)
    {
        if (($model = CriteriosMantenimientosCualificacion::findOne(['idCualificacion' => $idCualificacion, 'idTipoMantenimientoCualificacion' => $idTipoMantenimientoCualificacion, 'cualificadoComo' => $cualificadoComo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
