<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "alegacion".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property Hallazgo $id0
 * @property Hallazgo[] $hallazgos
 */
class Alegacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alegacion';
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
            [['descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Hallazgo::className(), 'targetAttribute' => ['id' => 'alegacionId']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Hallazgo::className(), ['alegacionId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHallazgos()
    {
        return $this->hasMany(Hallazgo::className(), ['alegacionId' => 'id']);
    }
	
	public function getDesviacion()
	{
		///$hallazgos = ArrayHelper::getColumn($this->getHallazgos()->asArray()->all(), 'desviacionId');
		return Desviacion::find()->where(['in','id',$this->hallazgos[0]->desviacionId ])->one();
	}
}
