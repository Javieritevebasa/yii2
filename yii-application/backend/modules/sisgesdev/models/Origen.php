<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "origen".
 *
 * @property int $id
 * @property string $numeroExpediente
 * @property int $tipoOrigen
 * @property string $fecha
 * @property string $fechaLimite
 * @property string $descripcion
 * @property int $creadoPor
 * @property int $validadoPor
 * @property string $fechaValidacion
 *
 * @property Desviacion[] $desviacions
 * @property TipoOrigen $tipoOrigen0
 * @property User $creadoPor0
 */
class Origen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'origen';
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
            [['tipoOrigen', 'creadoPor', 'validadoPor'], 'integer'],
            [['fecha', 'creadoPor'], 'required'],
            [['fecha', 'fechaLimite', 'fechaValidacion'], 'safe'],
            [['numeroExpediente'], 'string', 'max' => 45],
            [['descripcion'], 'string', ],
            [['tipoOrigen'], 'exist', 'skipOnError' => true, 'targetClass' => TipoOrigen::className(), 'targetAttribute' => ['tipoOrigen' => 'id']],
            [['creadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creadoPor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numeroExpediente' => 'Número Expediente',
            'tipoOrigen' => 'Tipo Origen',
            'fecha' => 'Fecha',
            'fechaLimite' => 'Fecha Limite',
            'descripcion' => 'Descripción',
            'creadoPor' => 'Creado Por',
            'validadoPor' => 'Validado Por',
            'fechaValidacion' => 'Fecha Validación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesviacions()
    {
        return $this->hasMany(Desviacion::className(), ['origen' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoOrigen0()
    {
        return $this->hasOne(TipoOrigen::className(), ['id' => 'tipoOrigen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreadoPor0()
    {
        return $this->hasOne(User::className(), ['id' => 'creadoPor']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getValidadoPor0()
    {
        return $this->hasOne(User::className(), ['id' => 'validadoPor']);
    }
}
