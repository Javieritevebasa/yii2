<?php

namespace backend\modules\sisgesdev\controllers;

use Yii;
use backend\modules\sisgesdev\models\Origen;
use backend\modules\sisgesdev\models\OrigenSearch;
use backend\modules\sisgesdev\models\TipoOrigen;
use backend\modules\sisgesdev\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * OrigenController implements the CRUD actions for Origen model.
 */
class OrigenController extends Controller
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
     * Lists all Origen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrigenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Origen model.
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
     * Creates a new Origen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Origen();
		$model->creadoPor = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['sisgesdev/view-form', 'origen' => $model->id]);
        }
	/*	else {
			print_r($model->getErrors());die();
		}
		*/
		$tiposOrigen = TipoOrigen::find()->all();
		$usuarios = User::find()->select(['id', 'concat(nombre, " ", apellidos) nombre'])->orderBy('nombre')->all();
        return $this->render('create', [
            'model' => $model,
            'tiposOrigen' => $tiposOrigen,
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Updates an existing Origen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		if ($model->creadoPor != Yii::$app->user->id) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste origen');


		//print_r(Yii::$app->request->post()); die();
	
        if ($model->load(Yii::$app->request->post())){
        	$model->descripcion = str_replace(chr(226).chr(128).chr(139), '', $model->descripcion);
        	if ($model->save()) {
				return $this->redirect(['sisgesdev/view-form', 'origen' => $model->id]);
			}
        }

		$tiposOrigen = TipoOrigen::find()->all();
		$usuarios = User::find()->select(['id', 'concat(nombre, " ", apellidos) nombre'])->orderBy('nombre')->all();
        return $this->render('update', [
            'model' => $model,
            'tiposOrigen' => $tiposOrigen,
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Deletes an existing Origen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->creadoPor != Yii::$app->user->id) throw new ForbiddenHttpException('Usted no tiene permisos para eliminar éste hallazgo');
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Origen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Origen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Origen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
