<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "hallazgo".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $tratamientoId
 * @property int $desviacionId
 *
 * @property Desviacion $desviacion
 * @property Tratamiento $tratamiento
 */
class Hallazgo extends \yii\db\ActiveRecord
{
	
	//Usado para saber si el usuario a seleccionado este hallazgo para incluirlo en un nuevo tramite
	public $checked;
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hallazgo';
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
            [['descripcion', 'desviacionId'], 'required'],
            [['descripcion'], 'string'],
            [['tratamientoId', 'desviacionId'], 'integer'],
            [['desviacionId'], 'exist', 'skipOnError' => true, 'targetClass' => Desviacion::className(), 'targetAttribute' => ['desviacionId' => 'id']],
            [['tratamientoId'], 'exist', 'skipOnError' => true, 'targetClass' => Tratamiento::className(), 'targetAttribute' => ['tratamientoId' => 'id']],
            [['alegacionId'], 'exist', 'skipOnError' => true, 'targetClass' => Alegacion::className(), 'targetAttribute' => ['alegacionId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'tratamientoId' => 'Tratamiento ID',
            'desviacionId' => 'Desviacion ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesviacion()
    {
        return $this->hasOne(Desviacion::className(), ['id' => 'desviacionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamiento()
    {
        return $this->hasOne(Tratamiento::className(), ['id' => 'tratamientoId']);
    }

	public function getOrigen()
	{
		
		return $this->hasOne(Origen::className(),['id' =>'origen'])->via('desviacion');
	}
}
