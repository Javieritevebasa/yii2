<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "tratamiento".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $analisisExtensionId
 * @property int $responsable
 * @property string $fechaCierre
 * @property string $fechaValidacion
 *
 * @property Hallazgo[] $hallazgos
 * @property User $responsable0
 * @property AnalisisExtension $analisisExtension
 */
class Tratamiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tratamiento';
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
            [['analisisExtensionId','responsable','validadoPor'], 'integer'],
            [['fechaCierre', 'fechaValidacion'], 'safe'],
            [['descripcion'], 'string', 'max' => 255],
            [['responsable'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['responsable' => 'id']],
            [['analisisExtensionId'], 'exist', 'skipOnError' => true, 'targetClass' => AnalisisExtension::className(), 'targetAttribute' => ['analisisExtensionId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripción',
            'analisisExtension' => 'Análisis Extensión',
            'responsable' => 'Responsable',
            'fechaCierre' => 'Fecha Cierre',
            'fechaValidacion' => 'Fecha Validación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHallazgos()
    {
        return $this->hasMany(Hallazgo::className(), ['tratamientoId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsable0()
    {
        return $this->hasOne(User::className(), ['id' => 'responsable']);
    }
	
	 public function getValidadoPor0()
    {
        return $this->hasOne(User::className(), ['id' => 'validadoPor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnalisisExtension()
    {
        return $this->hasOne(AnalisisExtension::className(), ['tratamientoId' => 'id']);
    }

	public function getAnalisisCausas()
	{
		 return $this->hasMany(AnalisisCausa::className(), ['tratamientoId' => 'id']);
	}
	
	public function getAcciones()
	{
		 return $this->hasMany(Accion::className(), ['tratamientoId' => 'id']);
	}
	
	public function getDesviacion()
	{
		///$hallazgos = ArrayHelper::getColumn($this->getHallazgos()->asArray()->all(), 'desviacionId');
		if (count($this->hallazgos)==0) return null;
		
		return Desviacion::find()->where(['in','id',$this->hallazgos[0]->desviacionId ])->one();
	}
	
	
	
}
