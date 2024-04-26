<?php

namespace backend\modules\crmItevebasa\models;

use Yii;
use yii\base\Model;

class VencimientosForm extends  Model 
{
	
     public $fechaDesde;
	 public $fechaHasta;
	 public $estaciones =[] ;
	 public $estacion;
	 
	public function rules()
    {
        return [
            [['fechaDesde', 'fechaHasta','estaciones', 'estacion','estaciones'], 'safe'],
            
        ];
    }

   
    
}
