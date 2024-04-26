<?php

namespace backend\modules\sisgesdev\controllers;

use Yii;
use yii\base\Model;
use backend\modules\sisgesdev\models\Origen;
use backend\modules\sisgesdev\models\Hallazgo;
use backend\modules\sisgesdev\models\Tratamiento;
use backend\modules\sisgesdev\models\Sisgesdev;
use backend\modules\sisgesdev\models\Desviacion;

use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

class SisgesdevController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	
	//Es la entrada de creación de los elementos de las desviacion y hallazgos
 	public function actionViewForm($origen)
    {
    	$modelOrigen = Origen::findOne($origen);
        return $this->render('viewForm', [
            'origen' => $modelOrigen,
        ]);
    }
	
	
	public function actionTramitar($tramite = null)
	{
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
		
		$count = count(Yii::$app->request->post('Hallazgo', []));

	    $hallazgos = [];
	   
		foreach (Yii::$app->request->post('Hallazgo', []) as $key => $item) {
			if ($item['checked'] == 1 )
			{
				$hallazgos[] = $key;
			}
		} 
		
		if (!key_exists('tramite', Yii::$app->request->post()) || !Yii::$app->request->post()['tramite'])
		{
			//return Yii::$app->runAction('sisgesdev/tratamiento/create', ['hallazgos' => $hallazgos, 'desviacionId' => Yii::$app->request->post()['desviacionId']]);
			Yii::$app->request->post()['hallazgos'] = $hallazgos;
			return $this->redirect(['tratamiento/create-vincular',
	            'hallazgos' => json_encode($hallazgos),
	          //  'desviacionId' => Yii::$app->request->post()['desviacionId']
	        ]);
		}
		else {
			$tratamiento = Tratamiento::findOne(Yii::$app->request->post()['tramite']);
			if ($tratamiento === null )  throw new NotFoundHttpException('No existen el tratamiento seleccionado.');
			
			$origen = null; 
			foreach ($hallazgos as $value) {
				$hallazgo = Hallazgo::findOne($value);
				$hallazgo->tratamientoId = $tratamiento->id;
				if (!$hallazgo->save())
				{
					throw new NotFoundHttpException('No se pudo añadir el hallazgo ' .$hallazgo->id. ' el tratamiento.'); 
				}
				if($origen==null) {$origen = $hallazgo->origen->id;}	
			}

			if( isset($session['url-back'])){
				$url = $session['url-back'];
				$session->remove('url-back');
			   	return $this->redirect($url);
			}else{
				return $this->redirect(['view-form',
		            'origen' => $origen,
		        ]);
			}
		}
	}
	
	public function actionCreateAlegacion($desviacionId)
	{
		$model = new Sisgesdev();
		
		$desviacion = Desviacion::findOne($desviacionId);
		if (
			$desviacion->responsable != Yii::$app->user->id
			&& $desviacion->origen0->creadoPor != Yii::$app->user->id
		) throw new ForbiddenHttpException('Usted no tiene permisos para alegar ésta desviación');
		
		
		$session = Yii::$app->session;
		if(!isset($session['url-back'])){
			$session['url-back'] = Yii::$app->request->referrer;
		}
		
        if ($model->load(Yii::$app->request->post()))
		{
			if ($model->alegar()) {
				if( isset($session['url-back'])){
					$url = $session['url-back'];
					$session->remove('url-back');
			    	return $this->redirect($url);
				}else{
				 	return $this->redirect(['view', 'id' => $model->id]);
				}
        	}
		}

		
        return $this->render('alegar', [
            'model' => $model,
            'hallazgos' => $desviacion->hallazgos,
        ]);
	}
	
	public function actionListarDesviaciones($origen, $layout = false)
	{
		$this->layout = $layout;
		
		echo Yii::$app->runAction('sisgesdev/desviacion/listar-desviaciones', ['origen' => $origen, 'layout' => false]);
		
	}

}
