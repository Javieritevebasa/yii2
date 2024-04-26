<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "accion".
 *
 * @property int $id
 * @property int $tipoAccionId
 * @property string $descripcion
 * @property string $fecha
 * @property string $fechaLimite
 * @property string $fechaCierre
 * @property int $validadoPor
 * @property string $fechaValidacion
 * @property int $tratamientoId
 *
 * @property TipoAccion $tipoAccion
 * @property Tratamiento $tratamiento
 * @property User $validadoPor0
 * @property Evidencia[] $evidencias
 */
class Accion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accion';
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
            [['tipoAccionId', 'descripcion', 'fecha', 'validadoPor'], 'required'],
            [['tipoAccionId', 'validadoPor', 'tratamientoId'], 'integer'],
            [['descripcion'], 'string'],
            [['fecha', 'fechaLimite', 'fechaCierre', 'fechaValidacion'], 'safe'],
            [['tipoAccionId'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAccion::className(), 'targetAttribute' => ['tipoAccionId' => 'id']],
            [['tratamientoId'], 'exist', 'skipOnError' => true, 'targetClass' => Tratamiento::className(), 'targetAttribute' => ['tratamientoId' => 'id']],
            [['validadoPor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['validadoPor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipoAccionId' => 'Tipo Accion ID',
            'descripcion' => 'Descripcion',
            'fecha' => 'Fecha creación',
            'fechaLimite' => 'Fecha Limite',
            'fechaCierre' => 'Fecha Cierre',
            'validadoPor' => 'Validado Por',
            'fechaValidacion' => 'Fecha Validacion',
            'tratamientoId' => 'Tratamiento ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAccion()
    {
        return $this->hasOne(TipoAccion::className(), ['id' => 'tipoAccionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamiento()
    {
        return $this->hasOne(Tratamiento::className(), ['id' => 'tratamientoId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValidadoPor0()
    {
        return $this->hasOne(User::className(), ['id' => 'validadoPor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvidencias()
    {
        return $this->hasMany(Evidencia::className(), ['accionId' => 'id']);
    }
	
	public function getDesviacion()
	{
		$hallazgo = $this->tratamiento->hallazgos[0];
		
		return $hallazgo->desviacion;
	}
}
