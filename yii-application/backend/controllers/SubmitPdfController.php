<?php

namespace backend\controllers;

class SubmitPdfController extends \yii\web\Controller
{
	public $enableCsrfValidation = false;
	
    public function actionSupervisioninsitu()
    {
    	$target_dir = "uploads/";  
		$target_file = $target_dir . "upload.pdf";
		copy('php://input', $target_file);  
		//file_put_contents($target_file, file_get_contents('php://input'));
		//file_put_contents($target_file, 'hola mundo');
		echo "Datos recibidos";
    }
	
	
}
