<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "formado".
 *
 * @property int $idUsuario
 * @property int $idFormacion
 * @property bool|null $aprobado Null -> No ha realizado la formación 1 -> aprobado 0 -> suspenso
 * @property float|null $nota
 * @property string|null $fechaInicio
 * @property string|null $fechaFin
 *
 * @property Formacion $idFormacion0
 * @property User $idUsuario0
 */
class Formado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'formado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario', 'idFormacion'], 'required'],
            [['idUsuario', 'idFormacion'], 'integer'],
            [['aprobado'], 'boolean'],
            [['nota'], 'number'],
            [['fechaInicio', 'fechaFin'], 'safe'],
            [['idUsuario', 'idFormacion'], 'unique', 'targetAttribute' => ['idUsuario', 'idFormacion']],
            [['idFormacion'], 'exist', 'skipOnError' => true, 'targetClass' => Formacion::className(), 'targetAttribute' => ['idFormacion' => 'id']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUsuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'idFormacion' => 'Id Formacion',
            'aprobado' => 'Aprobado',
            'nota' => 'Nota',
            'fechaInicio' => 'Fecha Inicio',
            'fechaFin' => 'Fecha Fin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFormacion0()
    {
        return $this->hasOne(Formacion::className(), ['id' => 'idFormacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(User::className(), ['id' => 'idUsuario']);
    }
}
