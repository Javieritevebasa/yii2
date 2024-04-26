<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\DEstaciones;
use common\models\CategoriaVehiculo;
use backend\models\DMunicipios;
/**
 * This is the model class for table "accion".
 *
 * @property integer $idAccion
 * @property string $nombre
 *
 * @property Fichajes $fichajes
 */
class GranOjo 
{
   
	public function getEstaciones()
    {
        return Yii::$app->user->identity->codigoEstacions;
    }
	
	public function getCodigoEstaciones()
	{
		$_estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->codigoEstacions,'codigo'); 
		return $_estaciones;
	}
	
	public function getCategoriasVehiculos()
	{
		return CategoriaVehiculo::find()->asArray()->all();
	}
	
	public function getAllEstaciones()
	{
		return DEstaciones::find()->asArray()->all();
	}
	
	public function getMunicipios()
	{
		return DMunicipios::find()->orderBy('nombreMunicipio')->asArray()->all();
	}
	
}
