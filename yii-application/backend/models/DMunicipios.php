<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "d_municipios".
 *
 * @property string|null $codigoMunicipio
 * @property string|null $nombreMunicipio
 * @property string|null $CodigosPostales
 */
class DMunicipios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'd_municipios';
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
            [['CodigosPostales'], 'string'],
            [['codigoMunicipio', 'nombreMunicipio'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigoMunicipio' => 'Codigo Municipio',
            'nombreMunicipio' => 'Nombre Municipio',
            'CodigosPostales' => 'Codigos Postales',
        ];
    }
}
