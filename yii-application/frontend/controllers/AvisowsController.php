<?php
namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use common\models\Avisows;

class AvisowsController extends ActiveController
{
	
    public $modelClass = 'common\models\Avisows';

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
	
	public function actionAvisar()
	{
		$aviso = new Avisows();
		
		if ($aviso->load(Yii::$app->request->post()) && $aviso->save()) {
			
			
		}
		else {
			print_r($aviso->errors);
			return 'error';
		}
		
		return $aviso->idAviso;
	}	
}