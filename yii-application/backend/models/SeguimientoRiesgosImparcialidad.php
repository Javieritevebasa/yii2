<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "seguimientoRiesgosImparcialidad".
 *
 * @property int $id
 * @property string $matricula
 * @property int $usuarioId
 * @property string|null $fecha
 * @property string $servicio
 * @property int $riesgoId
 * @property int $nivelRiesgoId
 *
 * @property NivelRiesgo $nivelRiesgo
 * @property Riesgo $riesgo
 * @property User $usuario
 */
class SeguimientoRiesgosImparcialidad extends \yii\db\ActiveRecord
{
	public $usuarioNombre;
	public $nivelRiesgoDescripcion;
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguimientoRiesgosImparcialidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matricula', 'usuarioId', 'servicio', 'riesgoId', 'nivelRiesgoId'], 'required'],
            [['usuarioId', 'riesgoId', 'nivelRiesgoId'], 'integer'],
            [['validado'], 'boolean'],
            [['comentario','justificacion','propietarioNombre'], 'string', 'max'=>500],
            [['fecha'], 'safe'],
            [['estacion',], 'string', 'max' => 5],
            [['matricula', 'servicio'], 'string', 'max' => 45],
            [['nivelRiesgoId'], 'exist', 'skipOnError' => true, 'targetClass' => NivelRiesgo::className(), 'targetAttribute' => ['nivelRiesgoId' => 'id']],
            [['riesgoId'], 'exist', 'skipOnError' => true, 'targetClass' => Riesgo::className(), 'targetAttribute' => ['riesgoId' => 'id']],
            [['usuarioId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuarioId' => 'id']],
            [['usuarioNombre','nivelRiesgoDescripcion'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'matricula' => 'Matrícula',
            'usuarioId' => 'Inpsector',
            'fecha' => 'Fecha',
            'servicio' => 'Servicio',
            'riesgoId' => 'Riesgo',
            'nivelRiesgoId' => 'Nivel Riesgo',
            'usuarioNombre' => 'Inspector',
            'validado' => 'Validado',
            'comentario' => 'Comentario',
            'justificacion' => 'Justificación',
            'propietarioNombre' => 'Propietario'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivelRiesgo()
    {
        return $this->hasOne(NivelRiesgo::className(), ['id' => 'nivelRiesgoId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRiesgo()
    {
        return $this->hasOne(Riesgo::className(), ['id' => 'riesgoId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuarioId']);
    }

	public function getPropietario()
	{
		
		
		 $q = $this->hasOne(User::className(), ['id' => 'user'])->viaTable('controlImparcialidad', ['matricula' => 'matricula']);
		 return $q ;
	}
}
