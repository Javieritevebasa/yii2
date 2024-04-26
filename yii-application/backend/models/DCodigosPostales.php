<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "d_codigosPostales".
 *
 * @property string|null $codigoPais
 * @property string|null $codigoPostal
 * @property string|null $poblacion
 * @property string|null $nombreComunidad
 * @property string|null $codigoComunidad
 * @property string|null $nombreProvincia
 * @property string|null $codigoProvincia
 * @property string|null $nombreMunicipio
 * @property string|null $codigoMunicipio
 * @property float|null $latitud
 * @property float|null $longitud
 * @property int|null $accuracy
 */
class DCodigosPostales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'd_codigosPostales';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbPentaho');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitud', 'longitud'], 'number'],
            [['accuracy'], 'integer'],
            [['codigoPais', 'poblacion', 'nombreComunidad', 'codigoComunidad', 'nombreProvincia', 'codigoProvincia', 'nombreMunicipio', 'codigoMunicipio'], 'string', 'max' => 255],
            [['codigoPostal'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigoPais' => 'Codigo Pais',
            'codigoPostal' => 'Codigo Postal',
            'poblacion' => 'Poblacion',
            'nombreComunidad' => 'Nombre Comunidad',
            'codigoComunidad' => 'Codigo Comunidad',
            'nombreProvincia' => 'Nombre Provincia',
            'codigoProvincia' => 'Codigo Provincia',
            'nombreMunicipio' => 'Nombre Municipio',
            'codigoMunicipio' => 'Codigo Municipio',
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
            'accuracy' => 'Accuracy',
        ];
    }
}
