<?php

namespace backend\models;

use Yii;
use common\models\Grupo;
/**
 * This is the model class for table "dirigidoA".
 *
 * @property int $idGrupo
 * @property int $idFormacion
 *
 * @property Grupo $idGrupo0
 * @property Formacion $idFormacion0
 */
class DirigidoA extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dirigidoA';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idGrupo', 'idFormacion'], 'required'],
            [['idGrupo', 'idFormacion'], 'integer'],
            [['idGrupo', 'idFormacion'], 'unique', 'targetAttribute' => ['idGrupo', 'idFormacion']],
            [['idGrupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['idGrupo' => 'idGrupo']],
            [['idFormacion'], 'exist', 'skipOnError' => true, 'targetClass' => Formacion::className(), 'targetAttribute' => ['idFormacion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idGrupo' => 'Id Grupo',
            'idFormacion' => 'Id Formacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGrupo0()
    {
        return $this->hasOne(Grupo::className(), ['idGrupo' => 'idGrupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFormacion0()
    {
        return $this->hasOne(Formacion::className(), ['id' => 'idFormacion']);
    }
}
