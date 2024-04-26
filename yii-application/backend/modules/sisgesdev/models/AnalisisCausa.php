<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "analisisCausa".
 *
 * @property int $id
 * @property string $descripcion
 */
class AnalisisCausa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'analisisCausa';
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
            [['descripcion'], 'string'],
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
        ];
    }
	
	public function getTratamiento()
	{
		return $this->hasOne(Tratamiento::className(), ['id' => 'tratamientoId']);
	}
}
