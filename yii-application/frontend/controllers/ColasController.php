<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

use frontend\models\Colas;

class ColasController extends Controller
{
	
	public function behaviors()
    {
        return [
        	'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'avisar' => ['POST'],
                ],
            ],
        ];
    }
	
	public function actionIndex($estacion)
	{
		 $this->layout = 'colas';
		 
		 $model = new Colas();
		 $model->codigoEstacion = $estacion;
		 
		  return $this->render('index', [
		        'model' =>$model,
		    ]);
	}	
}