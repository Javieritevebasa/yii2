<?php

namespace backend\modules\sisgesdev\controllers;

use Yii;
use backend\modules\sisgesdev\models\Tratamiento;
use backend\modules\sisgesdev\models\TratamientoSearch;
use backend\modules\sisgesdev\models\Hallazgo;
use backend\modules\sisgesdev\models\User;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;

/**
 * TratamientoController implements the CRUD actions for Tratamiento model.
 */
class TratamientoController extends Controller
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
                	//'create-vincular' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tratamiento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TratamientoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	public function actionMisTratamientos()
	{
		$tratamientos = Tratamiento::find()->where(['responsable' => Yii::$app->user->id])->andWhere(['fechaCierre' => null]);
		return $this->render('listarTratamientos', [
            'tratamientos' => $tratamientos->all(),
            
        ]);
	}
    /**
     * Displays a single Tratamiento model.
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
     * Creates a new Tratamiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($desviacionId)
    {
        $model = new Tratamiento();

		$desviacion = Desviacion::findOne($desviacionId);
		
		if ($desviacion === null)
		{
			throw new ForbiddenHttpException('No ha seleccionado una desviación');
		}
		
		
		if (
			$desviacion->responsable != Yii::$app->user->id
			&& $desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para crear un hallazgo');
		
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
        return $this->render('create', [
            'model' => $model,
        	'usuarios' => $usuarios,   
        ]);
    }

	public function actionPendientesValidar()
	{
		$tratamiento = Tratamiento::find()->where(['validadoPor' => Yii::$app->user->id])->andWhere(['not',['fechaCierre' => null]])->andWhere(['fechaValidacion' => null]);
		
        $dataProvider = new ActiveDataProvider([
            'query' => $tratamiento,
        ]);

        return $this->render('listarPendientesValidar', [
            'dataProvider' => $dataProvider,
        ]);
		
	}
	
	public function actionValidar($id)
	{
		$model = $this->findModel($id);
		if (
			$model->validadoPor != Yii::$app->user->id  
			&& $model->desviacion->responsable != Yii::$app->user->id
			&& $model->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para validar éste tratamiento');
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
		
		if ($model->fechaCierre == null)
		{
			throw new ForbiddenHttpException('No puede validar una tratamiento aún abierto');
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
		if (
			$model->responsable != Yii::$app->user->id  
			&& $model->desviacion->responsable != Yii::$app->user->id
			&& $model->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste tratamiento');
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
		if ($model->fechaCierre!=null)
			throw new ForbiddenHttpException('No se puede cerrar un tratamiento ya cerrado');
		
		$date = new \DateTime();
		$model->fechaCierre = $date->format('Y-m-d');
		if (!$model->save())
		{
			throw new NotFoundHttpException('No se pudo cerrar el tratamiento '.json_encode($model->getErrors()));
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
     * Creates a new Tratamiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateVincular($hallazgos = [])
    {
    	if (count(json_decode($hallazgos)) > 0)
		{
			$hallazgo = Hallazgo::findOne(json_decode($hallazgos)[0]);
		
			if ( $hallazgo->desviacion->responsable != Yii::$app->user->id
				&& $hallazgo->desviacion->origen0->creadoPor != Yii::$app->user->id
			) throw new ForbiddenHttpException('Usted no tiene permisos crear un nuevo tratamiento');
		}
		
        $model = new Tratamiento();

		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
	
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			foreach (json_decode($hallazgos) as $value) {
				$hallazgo = Hallazgo::findOne($value);
				$hallazgo->tratamientoId = $model->id;
				if (!$hallazgo->save())
				{
					throw new NotFoundHttpException('No se pudo añadir el hallazgo ' .$hallazgo->id. ' el tratamiento.'); 
				}
				
			}
	 
		    if( isset($session['url-back'])){
				$url = $session['url-back'];
				$session->remove('url-back');
			   	return $this->redirect($url);
			}else{
			 	return $this->redirect(['view', 'id' => $model->id]);
			}
        }
		
		$usuarios = User::find()->select(['id', 'concat(nombre, " ", apellidos) nombre'])->orderBy('nombre')->all();
        return $this->render('create', [
            'model' => $model,
            'usuarios' => $usuarios,
           
        ]);
    }
    /**
     * Updates an existing Tratamiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		if ($model->responsable != Yii::$app->user->id
			&& $model->desviacion->responsable != Yii::$app->user->id
			&& $model->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para modificar éste tratamiento');
		
		
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
        return $this->render('update', [
            'model' => $model,
            'usuarios' => $usuarios,
        ]);
    }


    /**
     * Deletes an existing Tratamiento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->responsable != Yii::$app->user->id
			&& $model->desviacion->responsable != Yii::$app->user->id
			&& $model->desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para eliminar éste hallazgo');
        
        $session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
        $model->delete();

      	if( isset($session['url-back'])){
			$url = $session['url-back'];
			$session->remove('url-back');
		   	return $this->redirect($url);
		}else{
		 	  return $this->redirect(['index']);
		}
    }

    /**
     * Finds the Tratamiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tratamiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tratamiento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
