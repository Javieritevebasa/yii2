<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "tipoDesviacion".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Desviacion[] $desviacions
 */
class TipoDesviacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoDesviacion';
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
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesviacions()
    {
        return $this->hasMany(Desviacion::className(), ['tipoDesviacion' => 'id']);
    }
}
