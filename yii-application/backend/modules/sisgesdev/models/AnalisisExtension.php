<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "analisisExtension".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $tratamientoId
 *
 * @property Tratamiento $tratamiento
 */
class AnalisisExtension extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'analisisExtension';
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
            [['descripcion', 'tratamientoId'], 'required'],
            [['descripcion'], 'string'],
            [['tratamientoId'], 'integer'],
            [['tratamientoId'], 'unique'],
            [['tratamientoId'], 'exist', 'skipOnError' => true, 'targetClass' => Tratamiento::className(), 'targetAttribute' => ['tratamientoId' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamiento()
    {
        return $this->hasOne(Tratamiento::className(), ['id' => 'tratamientoId']);
    }
}
