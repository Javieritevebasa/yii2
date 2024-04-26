<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Aviso;
use common\models\AvisoSearch;
use common\models\Estacion;
use common\models\Grupo;
use backend\models\User;
use common\models\Notificar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\SqlDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
/**
 * AvisoController implements the CRUD actions for Aviso model.
 */
class AvisoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        	'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
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
     * Lists all Aviso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AvisoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aviso model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	//Recuperamos todos los usuarios que debían ver el documento cuando han visto el aviso y cuando han marcado que lo han visto
    	 //$totalCount = Yii::$app->db->createCommand()->queryScalar();
	$estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo');

	//print_r('SELECT user.nombre, user.apellidos, notificar.* from user inner join asignar on user.id=asignar.idUser and predeterminada=1 inner join notificar on notificar.idUser=user.id and status not in (-1, 40, 50, 60) where asignar.codigoEstacion in (\''.join('\',\'', $estaciones).'\') and notificar.idAviso='.$id);
    $dataProvider = new SqlDataProvider([
        'sql' => 'SELECT user.nombre, user.apellidos, notificar.* from user inner join asignar on user.id=asignar.idUser and predeterminada=1 inner join notificar on notificar.idUser=user.id and status not in (-1, 40, 50, 60) where asignar.codigoEstacion in (\''.join('\',\'', $estaciones).'\') and notificar.idAviso='.$id,
        'sort' =>false,
        'pagination' => [
            'pageSize' => -1,
        ],
    ]);
		
		/*$query = User::find()->select('user.nombre, user.apellidos, notificar.notificadoEl')
		            			   ->leftJoin('notificar', 'notificar.idUser = user.id')
								   ->where(['notificar.idAviso'=>$id,])
								   ->all();
			*/					   
		//$dataProvider = new ArrayDataProvider([ 'allModels' => $query, ]);
		
		//die("");
		
		return $this->render('view', [
            'model' => $this->findModel($id),
            'usuarios'=>$dataProvider,
        ]);
    }

    /**
     * Creates a new Aviso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	
        $model = new Aviso();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
			return $this->redirect(['view', 'id' => $model->idAviso]);
        } else {
        	
			
			//Obtenemos las estaciones y los grupos y se los pasamos a la vista
			
			$dataProviderEstaciones = new ArrayDataProvider([ 'allModels' => Estacion::find()->all(), 'pagination' => ['pageSize' => -1, ]]);
			$dataProviderGrupos = new ArrayDataProvider([ 'allModels' => Grupo::find()->all(), 'pagination' => ['pageSize' => -1, ]]);
            return $this->render('create', [
                'model' => $model,
                'dataProviderEstaciones'=>$dataProviderEstaciones,
                'dataProviderGrupos'=>$dataProviderGrupos,
                'errors' => $model->getErrors(),
            ]);
        }
    }

    /**
     * Updates an existing Aviso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idAviso]);
        } else {
        	
			$dataProviderUsers = new ArrayDataProvider([ 'allModels' => User::find()->all(), 'pagination' => ['pageSize' => -1, ]]);
			$dataProviderNotificados = new ArrayDataProvider([ 'allModels' => Notificar::find()->where(['idAviso' => $model->idAviso])->all(), 'pagination' => ['pageSize' => -1, ]]);
            
			
			$model->_usuariosNotificados = [];
			foreach (Notificar::find()->where(['idAviso' => $model->idAviso])->all() as $item ){
				
				array_push($model->_usuariosNotificados,$item->idUser);
			}
			
            return $this->render('update', [
                'model' => $model,
                'dataProviderUsers'=>$dataProviderUsers,
                'usuariosNotificados'=>$model->_usuariosNotificados,
                'errors' => $model->getErrors(),
                
            ]);
        }
    }

    /**
     * Deletes an existing Aviso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	//die (Yii::getAlias('@app').'\\web\\logBorradoAvisos.txt');
    	file_put_contents( Yii::getAlias('@app').'/logBorradoAvisos.txt', $id."\t".Yii::$app->user->identity->id."\t".date("Y-m-d H:i:s")."\n", FILE_APPEND );
		
		return $this->redirect(['index']);
		
        /*$this->findModel($id)->delete();

        return $this->redirect(['index']);*/
    }

    /**
     * Finds the Aviso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aviso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aviso::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
