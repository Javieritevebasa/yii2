<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "control_documental".
 *
 * @property string $FICHATECNICA_MATRICULA
 * @property string $FICHATECNICA_NUMEROCERTIFICADO
 * @property string $FICHATECNICA_VIN
 * @property string $ESTADO_NOMBRE
 * @property string $INGENIERO_NOMBRE
 * @property string $FICHATECNICA_FECHAEMISION
 * @property string $SERVICIO_NOMBRE
 * @property string $FICHATECNICA_MARCA
 */
class ControlDocumentalFichasTecnicas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_documental';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbMinotauro');
    }
	
	/**
     * @inheritdoc$primaryKey
     */
    public static function primaryKey()
    {
        return ["FICHATECNICA_NUMEROCERTIFICADO"];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FICHATECNICA_NUMEROCERTIFICADO', 'FICHATECNICA_VIN', 'INGENIERO_NOMBRE', 'FICHATECNICA_FECHAEMISION', 'SERVICIO_NOMBRE'], 'required'],
            [['FICHATECNICA_FECHAEMISION','FICHATECNICA_INICIO'], 'safe'],
            [['FICHATECNICA_MATRICULA'], 'string', 'max' => 10],
            [['ESTACIONITV_CODIGO'], 'string', 'max' => 4],
            [['FICHATECNICA_NUMEROCERTIFICADO', 'ESTADO_NOMBRE', 'INGENIERO_NOMBRE', 'SERVICIO_NOMBRE'], 'string', 'max' => 45],
            [['FICHATECNICA_VIN'], 'string', 'max' => 18],
            [['FICHATECNICA_MARCA'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FICHATECNICA_MATRICULA' => 'Matrícula',
            'FICHATECNICA_NUMEROCERTIFICADO' => 'Número certificado',
            'FICHATECNICA_VIN' => 'VIN',
            'ESTADO_NOMBRE' => 'Estado',
            'INGENIERO_NOMBRE' => 'Ingeniero',
            'FICHATECNICA_FECHAEMISION' => 'Fecha emisión',
            'FICHATECNICA_INICIO' => 'Fecha inicio',
            'SERVICIO_NOMBRE' => 'Servicio',
            'FICHATECNICA_MARCA' => 'Marca',
            'ESTACIONITV_CODIGO' => 'ITV',
        ];
    }
}
