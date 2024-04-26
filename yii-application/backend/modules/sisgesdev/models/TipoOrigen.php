<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "tipoOrigen".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Origen[] $origens
 */
class TipoOrigen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoOrigen';
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
            [['nombre'], 'required'],
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
    public function getOrigens()
    {
        return $this->hasMany(Origen::className(), ['tipoOrigen' => 'id']);
    }
}
