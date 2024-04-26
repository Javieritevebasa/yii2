<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\Status;
use common\models\Pertenecer;
use common\models\Grupo;
use common\models\Estacion;
use common\models\Asignar;
use common\models\Notificar;
use common\models\registroException;
use common\models\GrupoCategorias;
use common\models\EstarCualificado;
use common\models\EstarEspecializado;
use common\models\Especialidad;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $nombre
 * @property string $apellidos
 * @property integer $movil
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Asignar[] $asignars
 * @property Estacion[] $codigoEstacions
 * @property Pertenecer[] $pertenecers
 * @property Grupo[] $idGrupos
 * @property Pertenecer $id0
 */
class User extends \yii\db\ActiveRecord
{
	public $password;
	
	public $_grupos;
	public $_estaciones;
	public $_estacionPredeterminada;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

	
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'nombre', 'apellidos', 'created_at', 'updated_at'], 'required'],
            [['movil','movilPersonal', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'nombre', 'apellidos', 'emailCorporativo'], 'string', 'max' => 255],
            [['dni', ], 'string', 'max' => 45],
            [['foto'], 'file',  'extensions' => 'png', 'maxSize' => 1024*1024, 'tooBig' => 'Limit is 1MB'],
            [['codigoInspector'], 'string', 'max' => 5],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Pertenecer::className(), 'targetAttribute' => ['id' => 'idUser']],
            [['_grupos'],'safe'],
            [['_estaciones','_estacionPredeterminada'],'safe'],
            [['password',],'safe'],
            [['certificado'],'file', 'extensions'=>'pfx'],
            
        ];
    }

    /**
     * @inheritdoc
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
            'emailCorporativo',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'movil' => 'Móvil',
            'movilPersonal' => 'Móvil personal',
            'status' => 'Estado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'dni' => 'D.N.I.',
		
        ];
    }
	
	

	public function getEstacion()
	{
		return $this->hasOne(Estacion::className(), ['codigo' => 'codigoEstacion'])->via('asignars', function($query){ return $query->where(['predeterminada' => true]);});
	}

	public function getEstacionPredeterminada()
	{
		   
		
		return Asignar::find()->where(['predeterminada'=> true, 'idUser' =>$this->id])->one();
		
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
    public function getPertenecers()
    {
        return $this->hasMany(Pertenecer::className(), ['idUser' => 'id']);
    }
	
	// FK Usuario->Grupos
	
	 /**
     * @return \yii\db\ActiveQuery
     */
    public function getCualificaciones()
	{
		return $this->hasMany(GrupoCategorias::className(), ['id' => 'idGrupoCategorias'])->viaTable('estarCualificado', ['idUser' => 'id']);
	}
	
	public function getEstarCualificado()
	{
		return $this->hasMany(EstarCualificado::className(), ['idUser' => 'id']);
	}
	
	public function getCualificacionesEnVigor()
	{
		$hoy = new \DateTime();
		
		//print_r($hoy);
		return $this->hasMany(EstarCualificado::className(), ['idUser' => 'id'])->andOnCondition(['>','fechaVencimiento' , $hoy->format('Y-m-d')]);
	
	}
	
	
		
	 /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidades()
	{
		return $this->hasMany(Especialidad::className(), ['id' => 'idEspecialidad'])->viaTable('estarEspecializado', ['idUser' => 'id']);
	}
	
	public function getEstarEspecializado()
	{
		return $this->hasMany(EstarEspecializado::className(), ['idUser' => 'id']);
	}
	
	public function getEspecialidadesEnVigor()
	{
		$hoy = new \DateTime('NOW');
		return $this->hasMany(EstarEspecializado::className(), ['idUser' => 'id'])->andOnCondition(['=','cualificadoComo' , 2])->andOnCondition(['>=','fechaVencimiento' , $hoy->format('Y-m-d')])->andOnCondition(['=','apto' , 1]);
	
	}


 	/**
     * @return \yii\db\ActiveQuery
     */
    public function getFormacion()
	{
		return $this->hasMany(Formacion::className(), ['id' => 'idFormacion'])->viaTable('formado', ['idUsuario' => 'id']);
	}
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleFormacion()
	{
		return $this->hasMany(Formado::className(), ['idUsuario' => 'id']);
	}
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGrupos()
    {
        return $this->hasMany(Grupo::className(), ['idGrupo' => 'idGrupo'])->viaTable('pertenecer', ['idUser' => 'id']);
    }

	/**
     * @return \yii\db\ActiveQuery
     */
    public function getPesoMaximo()
    {
    	return Grupo::find()->max('peso');
    }

 	/**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificar::className(), ['idUser' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Pertenecer::className(), ['idUser' => 'id']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Status::className(), ['idStatus' => 'status']);
    }
	
	private $transaction;
	public function save ($runValidation = true, $attributeNames = null)
	{
		
		
			
		$retorno = true;
		$this->transaction = Yii::$app->db->beginTransaction();
        try
        {
        	
			
			
        	if($this->password)
			{	
				$this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
				$this->auth_key = Yii::$app->security->generateRandomString();
			}
        	$this->created_at = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));;
			$this->updated_at = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));;
			
			
			if( !parent::save($runValidation,$attributeNames) ) 
			{
				
				throw new registroException('User',"No se almacenó correcamente al usuario");
				
			}
			
			if ($this->_grupos)
			{
				if(!$this->getIsNewRecord())
					Pertenecer::deleteAll('idUser='.$this->id);
				foreach ($this->_grupos as $key) {
					$item = Grupo::findOne($key);
					$this->link('idGrupos',$item);
				}
			}
			else {
				throw new registroException('_grupos',"Tiene que elegir un grupo al menos");
			}
			
			
			//print_r($this->_estaciones);
			//die("");
			if ($this->_estaciones)
			{
				if(!$this->getIsNewRecord())
					Asignar::deleteAll('idUser='.$this->id);
				foreach ($this->_estaciones as $key) {
					$item = Estacion::findOne($key);
					$this->link('codigoEstacions',$item);
				}
				
				$a = Asignar::find()->where(['codigoEstacion'=> $this->_estacionPredeterminada, 'idUser' =>$this->id])->one();
				$a->predeterminada = true;
				$a->save();
			}
			else {
				throw new registroException('_estaciones',"Tiene que elegir una estación al menos");
			}
			
			
			$this->transaction->commit();
			
	    }
        catch (registroException $ex)
		{
			$this->transaction->rollBack();
			
			$this->addError($ex->getAtributo(),$ex->getMessage()." en la línea ".$ex->getLine()." [ ".$ex->getFile()." ]");
			
			$retorno = false;
		}
		
		
		return $retorno;
	}

public function save2 ($runValidation = true, $attributeNames = null)
	{
		
		
			
		$retorno = true;
		$this->transaction = Yii::$app->db->beginTransaction();
        try
        {
        	
			
			
        	if($this->password)
			{	
				$this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
				$this->auth_key = Yii::$app->security->generateRandomString();
			}
        	$this->created_at = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));;
			$this->updated_at = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));;
			$this->status = 10;
			
			if( !parent::save(false,$attributeNames) ) 
			{
				
				throw new registroException('User',"No se almacenó correcamente al usuario");
				
			}
			$this->transaction->commit();
			
	    }
        catch (registroException $ex)
		{
			$this->transaction->rollBack();
			
			$this->addError($ex->getAtributo(),$ex->getMessage()." en la línea ".$ex->getLine()." [ ".$ex->getFile()." ]");
			
			$retorno = false;
		}
		
		die("prueba".$this->id);
		return $retorno;
	}
	
	public function findIdentity($id)
    {
        return User::findOne(['id' => $id, 'status' => 10]);
    }
		
}
