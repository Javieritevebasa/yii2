<?php

namespace backend\modules\sisgesdev\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $nombre
 * @property string $apellidos
 * @property int $movil
 * @property int $status -1 -> Despedido 10 -> Activo 20 -> Baja laboral 30 -> Vacaciones 
 * @property int $created_at
 * @property int $updated_at
 * @property int $movilPersonal
 * @property string $codigoInspector
 *
 * @property Asignar[] $asignars
 * @property Estacion[] $codigoEstacions
 * @property Aviso[] $avisos
 * @property Fichajes[] $fichajes
 * @property Notificar[] $notificars
 * @property Aviso[] $avisos0
 * @property Pertenecer[] $pertenecers
 * @property Grupo[] $grupos
 * @property Status $status0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'nombre', 'apellidos', 'created_at', 'updated_at'], 'required'],
            [['movil', 'status', 'created_at', 'updated_at', 'movilPersonal'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'nombre', 'apellidos'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['codigoInspector'], 'string', 'max' => 5],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status' => 'idStatus']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'movil' => 'Movil',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'movilPersonal' => 'Movil Personal',
            'codigoInspector' => 'Codigo Inspector',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignars()
    {
        return $this->hasMany(Asignar::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoEstacions()
    {
        return $this->hasMany(Estacion::className(), ['codigo' => 'codigoEstacion'])->viaTable('asignar', ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvisos()
    {
        return $this->hasMany(Aviso::className(), ['creadoPor' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichajes()
    {
        return $this->hasMany(Fichajes::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificars()
    {
        return $this->hasMany(Notificar::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvisos0()
    {
        return $this->hasMany(Aviso::className(), ['idAviso' => 'idAviso'])->viaTable('notificar', ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPertenecers()
    {
        return $this->hasMany(Pertenecer::className(), ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::className(), ['idGrupo' => 'idGrupo'])->viaTable('pertenecer', ['idUser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Status::className(), ['idStatus' => 'status']);
    }
}
