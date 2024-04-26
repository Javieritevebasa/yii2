<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "controlImparcialidadEmpresas".
 *
 * @property string $matricula
 * @property string $empresa
 * @property int $nivel
 */
class ControlImparcialidadEmpresas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'controlImparcialidadEmpresas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matricula', 'empresa'], 'required'],
            [['nivel'], 'integer'],
            [['matricula', 'empresa'], 'string', 'max' => 45],
            [['matricula'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'matricula' => 'Matricula',
            'empresa' => 'Empresa',
            'nivel' => 'Nivel',
        ];
    }
}
