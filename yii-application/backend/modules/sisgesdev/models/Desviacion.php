<?php

namespace backend\modules\sisgesdev\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * This is the model class for table "desviacion".
 *
 * @property int $id
 * @property string $numero
 * @property string $fecha
 * @property int $departamento
 * @property int $tipoDesviacion
 * @property string $descripcion
 * @property int $origen
 * @property int $responsable
 * @property string $fechaCierre
 * @property int $validadoPor
 * @property string $fechaValidacion
 * @property string $fechaLimite
 *
 * @property Origen $origen0
 * @property User $responsable0
 * @property User $validadoPor0
 * @property Hallazgo[] $hallazgos
 */
class Desviacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'desviacion';
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
            [['fecha', 'fechaCierre', 'fechaValidacion', 'fechaLimite'], 'safe'],
            [['departamento', 'tipoDesviacion', 'descripcion', 'origen', 'responsable'], 'required'],
            [['departamento', 'tipoDesviacion', 'origen', 'responsable', 'validadoPor', 'orden'], 'integer'],
            [['descripcion'], 'string'],
            [['numero'], 'string', 'max' => 45],
            [['origen'], 'exist', 'skipOnError' => true, 'targetClass' => Origen::className(), 'targetAttribute' => ['origen' => 'id']],
            [['responsable'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['responsable' => 'id']],
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
            'numero' => 'Número',
            'fecha' => 'Fecha',
            'departamento' => 'Departamento',
            'tipoDesviacion' => 'Tipo Desviación',
            'descripcion' => 'Descripción',
            'origen' => 'Origen',
            'responsable' => 'Responsable',
            'fechaCierre' => 'Fecha Cierre',
            'validadoPor' => 'Validado Por',
            'fechaValidacion' => 'Fecha Validación',
            'fechaLimite' => 'Fecha Límite',
            'orden' => 'Orden',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigen0()
    {
        return $this->hasOne(Origen::className(), ['id' => 'origen']);
    }

 	/**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento0()
    {
        return $this->hasOne(Departamento::className(), ['id' => 'departamento']);
    }

	/**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoDesviacion0()
    {
        return $this->hasOne(TipoDesviacion::className(), ['id' => 'tipoDesviacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsable0()
    {
        return $this->hasOne(User::className(), ['id' => 'responsable']);
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
    public function getHallazgos()
    {
        return $this->hasMany(Hallazgo::className(), ['desviacionId' => 'id']);
    }
	
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getHallazgosTratados()
    {
        return $this->hasMany(Hallazgo::className(), ['desviacionId' => 'id'])->where(['is not','tratamientoId' , null]);
    }
	
	 public function getHallazgosAlegados()
    {
        return $this->hasMany(Hallazgo::className(), ['desviacionId' => 'id'])->where(['is not','alegacionId' , null]);
    }

	public function getTratamientos()
	{
		return $this->hasMany(Tratamiento::className(),['id' => 'tratamientoId'])->via('hallazgosTratados');
		
	}
	
	public function getAlegaciones()
	{
		return $this->hasMany(Alegacion::className(),['id' => 'alegacionId'])->via('hallazgosAlegados');
	}
/**
     * @return \yii\db\ActiveQuery
     */
    public function getHallazgosNoTratados()
    {
        return $this->hasMany(Hallazgo::className(), ['desviacionId' => 'id'])->where(['tratamientoId' => null])->andWhere(['alegacionId' => null]);
    }
	
	public function getAcciones()
	{
		return Accion::find()
			->innerJoin('tratamiento', 'tratamiento.id=accion.tratamientoId' )
			->innerJoin('hallazgo', 'hallazgo.desviacionId=tratamiento.id' )
			->where(['desviacionId' => $this->id ]);
	}

	public function getEvidencias()
	{
		return Evidencia::find()
			->innerJoin('accion', 'accion.id=evidencia.accionId' )
			->innerJoin('tratamiento', 'tratamiento.id=accion.tratamientoId' )
			->innerJoin('hallazgo', 'hallazgo.tratamientoId=tratamiento.id')
			->where(['desviacionId' => $this->id ]);
			
			
			
	}
}
