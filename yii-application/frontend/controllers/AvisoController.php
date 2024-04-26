<?php

namespace frontend\controllers;

use Yii;
use common\models\Aviso;
use common\models\Notificar;
use common\models\Mail;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
       $query = Aviso::find()->select('aviso.*')
		            ->leftJoin('notificar', 'aviso.idAviso = notificar.idAviso')
		            ->where(['notificar.idUser' => Yii::$app->user->identity->id,
		            	'notificar.signadoEl' => null
		            ]);
		
		date_default_timezone_set('Europe/Madrid');
		foreach ($query->all() as $item) {
				$notificacion = Notificar::find()->where(['notificar.idAviso'=>$item->idAviso, 
														'notificar.idUser' => Yii::$app->user->identity->id ,
														'notificar.notificadoEl' => null
														])->one();
				if ($notificacion) {
					$notificacion->notificadoEl= date('Y-m-d H:i:s');
					$notificacion->save();
				}
		}		
		
		
		$avisosUsuario = new ActiveDataProvider([
		    'query' => $query,
		]);
					
         //   die("");
        return $this->render('index', [
             'avisosUsuario' => $avisosUsuario,
        ]);
    }


	public function actionMisNotificaciones()
    {
       $query = Aviso::find()
		            ->leftJoin('notificar', 'aviso.idAviso = notificar.idAviso')
		            ->where(['notificar.idUser' => Yii::$app->user->identity->id])
					->orderBy('notificar.notificadoEl desc');
		
		date_default_timezone_set('Europe/Madrid');
		
		
		$avisosUsuario = new ActiveDataProvider([
		    'query' => $query,
		]);
					
         //   die("");
        return $this->render('misNotificaciones', [
             'avisosUsuario' => $avisosUsuario,
        ]);
    }

	public function actionRecordarNotificaciones()
    {
    	$hoy = new \DateTime();
		
       $query = Aviso::find()
		            ->leftJoin('notificar', 'aviso.idAviso = notificar.idAviso')
		            ->where(['notificar.idUser' => Yii::$app->user->identity->id])
					->where([ '>=', 'notificar.notificadoEl', $hoy->sub(new \DateInterval('P1M'))->format('Y-m-d')])
					->orderBy('notificar.notificadoEl desc');
		
		date_default_timezone_set('Europe/Madrid');
		$avisosUsuario = new ActiveDataProvider([
		    'query' => $query,
		    'pagination' => false,
		]);
		$this->layout = 'mail';
		$body =  $this->render('misNotificaciones', [
             'avisosUsuario' => $avisosUsuario,
        ]);
		
		
		Mail:: SendMail(['mfonseca.atrain@gmail.com'], "Recordatorio de avisos", $body );
		return $body;
		die('aki');
		
					
        return $this->redirect(['index']);
    }

    /**
     * Displays a single Aviso model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

  /**
     * actualiza el estado de signadoel
     * @param integer $id
     * @return mixed
     */
    public function actionEnterado($id)
    {
        $this->findModel($id);
		
		$notificacion = Notificar::find()->where(['notificar.idAviso'=>$id,])
										 ->andWhere(['notificar.idUser' => Yii::$app->user->identity->id ,])
										 ->andWhere(['notificar.signadoEl' => null])
										 ->one();
		if ($notificacion) {
			date_default_timezone_set('Europe/Madrid');
			$notificacion->signadoEl= date('Y-m-d H:i:s');
			$notificacion->save();
		}
				
	    if (Yii::$app->getRequest()->isAjax) {
	    	
			
			
			 $query = Aviso::find()->select('aviso.*')
		            			   ->leftJoin('notificar', 'aviso.idAviso = notificar.idAviso')
								   ->where(['notificar.idAviso'=>$id,])
		            			   ->andWhere(['notificar.idUser' => Yii::$app->user->identity->id ,])
								   ->orWhere(['notificar.signadoEl' => null])->all();
					
					
	        $dataProvider = new ActiveDataProvider([
	            'query' =>  $query,
	            'sort' => false
	        ]);
	        return $this->renderPartial('index', [
	                    'dataProvider' => $dataProvider
	        ]);
	    }
	    return $this->redirect(['index']);
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
