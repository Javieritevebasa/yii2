<?php

namespace backend\controllers;

use Yii;
use backend\models\Formacion;
use backend\models\Formado;
use backend\models\FormacionSearch;
use common\models\User;
use common\models\Grupo;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormacionController implements the CRUD actions for Formacion model.
 */
class FormacionController extends Controller
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
     * Lists all Formacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Formacion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    	$model = $this->findModel($id);

        // add conditions that should always apply here

       	$dataProvider = new ActiveDataProvider([
            'query' => $model->getUsuarios(),
        ]);
		
		
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Formacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Formacion();
  		$grupos = Grupo::find()->all();
		$responsablesFormacion = User::find()->where(['status' => 10])->orderBy(['nombre' => SORT_ASC, 'apellidos' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'grupos' => $grupos,
            'responsablesFormacion' => $responsablesFormacion,
        ]);
    }

    /**
     * Updates an existing Formacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
    	$model = $this->findModel($id);
        $grupos = Grupo::find()->all();
		$responsablesFormacion = User::find()->where(['status' => 10])->orderBy(['nombre' => SORT_ASC, 'apellidos' => SORT_ASC])->all();
        if ($model->load(Yii::$app->request->post())){
        	
			//print_r($model); die();
			if($model->save()) {
				//die('save');
        		return $this->redirect(['view', 'id' => $model->id]);
			}
			else {
				print_r($model->getErrors()); die();
			}
        }
		

        return $this->render('update', [
            'model' => $model,
            'grupos' => $grupos,
            'responsablesFormacion' => $responsablesFormacion,
        ]);
    }

	public function actionSubirResultados($id)
	{
		$model = $this->findModel($id);
		
		$file =Yii::getAlias('@webroot').'/uploads/reporting_student_list.csv';
		$csv = [];
		if (($gestor = fopen($file, "r")) !== FALSE) {
			while (($resultado = fgetcsv($gestor, 1000, ";")) !== FALSE) {
				$usuario = User::findOne(['username' => $resultado[3]]);
				if ($usuario !== null)
				{
					$formado = Formado::findOne(['idFormacion' => $model->id, 'idUsuario' => $usuario->id ]);
					if ($formado !==null)
					{
						$formado->aprobado = ($resultado[8] == '100%' ? 1 : 0);
						$formado->nota = str_replace("%","", $resultado[8]);
						$date = \DateTime::createFromFormat("d M Y",  $resultado[13]);
						if($date)
							$formado->fechaFin = $date->format('Y-m-d');
						
						if(!$formado->save())
						{}
					}
				}
			}
		}
	}


    /**
     * Deletes an existing Formacion model.
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
     * Finds the Formacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Formacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Formacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
