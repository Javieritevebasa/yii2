<?php

namespace backend\modules\crmItevebasa\controllers;

use yii\web\Controller;

use backend\modules\crmItevebasa\models\Inspecciones;

/**
 * Default controller for the `crmItevebasa` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	
		$inspecciones = Inspecciones::find()->where(['estacion' => '0302', 'anyo' => 2020])->all();
        return $this->render('index');
    }
}
