<?php

namespace backend\modules\sisgesdev\controllers;

use Yii;
use backend\modules\sisgesdev\models\Desviacion;
use backend\modules\sisgesdev\models\DesviacionSearch;
use backend\modules\sisgesdev\models\Tratamiento;
use backend\modules\sisgesdev\models\Hallazgo;
use backend\modules\sisgesdev\models\TipoDesviacion;
use backend\modules\sisgesdev\models\User;
use backend\modules\sisgesdev\models\Departamento;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;

/**
 * DesviacionController implements the CRUD actions for Desviacion model.
 */
class DesviacionController extends Controller
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
     * Lists all Desviacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DesviacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	/**
     * Lists all Desviacion de las que el usuario es responsable.
     * @return mixed
     */
    public function actionMisDesviaciones()
    {
       $desviaciones = Desviacion::find()->where(['responsable' => Yii::$app->user->id])->all();
		
		$aux = (Hallazgo::find()->where(['in','desviacionId' , ArrayHelper::getColumn($desviaciones,'id')  ])->asArray()->all());
		
		
		$tratamientosActivos = ArrayHelper::getColumn($aux,'tratamientoId');
		
		$tratamientosActivos = Tratamiento::find()->where(['id' => array_unique( $tratamientosActivos)])->all();
		
		
        return $this->render('listarDesviacionesOrigen', [
            'desviaciones' => $desviaciones,
            'tratamientos' => $tratamientosActivos,
			
        ]);
    }
	
	
	/**
     * Lists all Desviacion models of one origen.
     * @return mixed
     */
    public function actionListarDesviaciones($origen)
    {
    
	 	$desviaciones = Desviacion::find()->where(['origen' => $origen])->orderBy(['orden'=>SORT_ASC,'id'=>SORT_ASC])->all();
		
		$aux = (Hallazgo::find()->where(['in','desviacionId' , ArrayHelper::getColumn($desviaciones,'id')  ])->asArray()->all());
		
		$tratamientosActivos = ArrayHelper::getColumn($aux,'tratamientoId');
		
		$tratamientosActivos = Tratamiento::find()->where(['id' => array_unique( $tratamientosActivos)])->all();
		
		$this->layout = FALSE;
		
		
		
		
        return $this->render('listarDesviacionesOrigen', [
            'desviaciones' => $desviaciones,
            'tratamientos' => $tratamientosActivos,
            'origen' => $origen,
        ]);
    }
    /**
     * Displays a single Desviacion model.
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
     * Creates a new Desviacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($origen)
    {
        $model = new Desviacion();
		$model->origen = $origen;
		
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if( isset($session['url-back'])){
				$url = $session['url-back'];
				$session->remove('url-back');
			   	return $this->redirect($url);
			}else{
			 	return $this->redirect(['view', 'id' => $model->id]);
			}
        }

		
		$usuarios = User::find()->select(['id', 'concat(nombre, " ", apellidos) nombre'])->orderBy('nombre')->all();
		$departamento = Departamento::find()->all();
        return $this->render('create', [
            'model' => $model,
            'usuarios' => $usuarios,
            'tipoDesviacion' => TipoDesviacion::find()->all(),
            'departamento' => $departamento,
        ]);
    }

    /**
     * Updates an existing Desviacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

		if ($model->responsable != Yii::$app->user->id
			&& $model->origen0->creadoPor != Yii::$app->user->id
			) throw new ForbiddenHttpException('Usted no tiene permisos para modificar ésta desviación');
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             if( isset($session['url-back'])){
				$url = $session['url-back'];
				$session->remove('url-back');
			   	return $this->redirect($url);
			}else{
			 	return $this->redirect(['view', 'id' => $model->id]);
			}
        }

        $usuarios = User::find()->select(['id', 'concat(nombre, " ", apellidos) nombre'])->orderBy('nombre')->all();
		$departamento = Departamento::find()->all();
        return $this->render('update', [
            'model' => $model,
            'usuarios' => $usuarios,
            'tipoDesviacion' => TipoDesviacion::find()->all(),
            'departamento' => $departamento,
        ]);
    }

	/**
	 * Devuelve las desviaciones que están pendientes de validar
	 *
     * @return mixed
     * 
     */
	
	public function actionPendientesValidar()
	{
		$desviaciones = Desviacion::find()->where(['validadoPor' => Yii::$app->user->id])->andWhere(['not',['fechaCierre' => null]])->andWhere(['fechaValidacion' => null]);
		//$desviaciones = Desviacion::find()->where(['validadoPor' => Yii::$app->user->id])->andWhere(['fechaCierre' => null])->andWhere(['fechaValidacion' => null]);
		
        $dataProvider = new ActiveDataProvider([
            'query' => $desviaciones,
        ]);

        return $this->render('listarPendientesValidar', [
            'dataProvider' => $dataProvider,
        ]);
		
	}
	
	
    public function actionValidar($id)
    {
        $model = $this->findModel($id);

		if ($model->validadoPor != Yii::$app->user->id
			&& $model->origen0->creadoPor != Yii::$app->user->id
			) throw new ForbiddenHttpException('Usted no tiene permisos para validar ésta desviación');
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
		if ($model->fechaCierre == null)
		{
			throw new ForbiddenHttpException('No puede validar una desviación aún abierta');
		}
		
		$date = new \DateTime();
		$model->fechaValidacion = $date->format('Y-m-d');
		if (!$model->save())
		{
			throw new NotFoundHttpException('No se pudo marcar como validada la desviación');
		}
		
        if( isset($session['url-back'])){
			$url = $session['url-back'];
			$session->remove('url-back');
			return $this->redirect($url);
		}else{
		 	return $this->redirect(['view', 'id' => $model->id]);
		}
	}
	
	public function actionCerrar($id)
    {
        $model = $this->findModel($id);

		if ($model->responsable != Yii::$app->user->id
			&& $model->origen0->creadoPor != Yii::$app->user->id
			) throw new ForbiddenHttpException('Usted no tiene permisos para modificar ésta desviación');
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
		$sePuedeCerrar = true;
		foreach ($model->tratamientos as $key => $tratamiento) {
			if ($tratamiento->fechaValidacion == null) {$sePuedeCerrar = false; break;}
		}
		
		if (!$sePuedeCerrar)
		{
			throw new ForbiddenHttpException('No puede cerrar una desviación con tratamientos todavía sin validar');
		}
		
		$date = new \DateTime();
		$model->fechaCierre = $date->format('Y-m-d');
		if (!$model->save())
		{
			throw new NotFoundHttpException('No se pudo marcar como cerrada la desviación');
		}
		
        if( isset($session['url-back'])){
			$url = $session['url-back'];
			$session->remove('url-back');
			return $this->redirect($url);
		}else{
		 	return $this->redirect(['view', 'id' => $model->id]);
		}
	}
    /**
     * Deletes an existing Desviacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       	$model = $this->findModel($id);
        if ($model->responsable != Yii::$app->user->id
			&& $model->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para eliminar éste hallazgo');
        $model->delete();

       	$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
		if( isset($session['url-back'])){
			$url = $session['url-back'];
			$session->remove('url-back');
		   	return $this->redirect($url);
		}else{
		 	  return $this->redirect(['index']);
		}
    }

    /**
     * Finds the Desviacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Desviacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Desviacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
