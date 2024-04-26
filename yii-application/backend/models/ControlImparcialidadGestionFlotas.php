<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "controlImparcialidadGestionFlotas".
 *
 * @property int $id
 * @property string $cif
 * @property string $nombre
 */
class ControlImparcialidadGestionFlotas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'controlImparcialidadGestionFlotas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cif', 'nombre'], 'required'],
            [['cif'], 'string', 'max' => 45],
            [['nombre'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cif' => 'Cif',
            'nombre' => 'Nombre',
        ];
    }
}
