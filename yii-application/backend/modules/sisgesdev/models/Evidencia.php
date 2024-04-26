<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "evidencia".
 *
 * @property int $id
 * @property string $codigoEvidencia
 * @property string $ruta
 */
class Evidencia extends \yii\db\ActiveRecord
{
	
	
	   /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evidencia';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbSisgesdev');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigoEvidencia', 'ruta'], 'required'],
            [['codigoEvidencia'], 'string', 'max' => 45],
            [['ruta','descripcion'], 'string', 'max' => 255],
            [['codigoEvidencia'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigoEvidencia' => 'Código evidencia',
            'descripcion' => 'Descripción',
            'ruta' => 'Ruta',
        ];
    }
	
	public function getAccion()
	{
		return $this->hasOne(Accion::className(),['id', 'accionId']);
	}
	
	
}
