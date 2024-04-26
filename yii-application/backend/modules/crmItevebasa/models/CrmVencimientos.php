<?php

namespace backend\modules\crmItevebasa\models;

use Yii;

/**
 * This is the model class for table "crm_vencimientos".
 *
 * @property string $matricula
 * @property int|null $informeMecanica
 * @property string|null $fechaProximaInspeccion
 */
class CrmVencimientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'crm_vencimientos';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbPentaho');
    }


	public static function primaryKey()
    {
          return ["matricula"];
    }
	  
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matricula'], 'required'],
            [['informeMecanica'], 'integer'],
            [['fechaProximaInspeccion'], 'safe'],
            [['matricula'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'matricula' => 'Matricula',
            'informeMecanica' => 'Informe Mecanica',
            'fechaProximaInspeccion' => 'Fecha Proxima Inspeccion',
        ];
    }
	
	public function getInspecciones()
    {
        return $this->hasOne(Inspecciones::className(), ['InformeMecanica' => 'informeMecanica', 'matricula' => 'matricula']);
    }
	
	
}
