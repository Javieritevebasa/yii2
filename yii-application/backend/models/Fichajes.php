<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fichajes".
 *
 * @property integer $idFichajes
 * @property string $fechaHora
 * @property integer $idAccion
 * @property string $comentario
 *
 * @property Accion $idFichajes0
 */
class Fichajes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fichajes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechaHora', 'idAccion','idUser'], 'required'],
            [['fechaHora',], 'safe'],
            [['fecha',], 'date', 'format'=>'yyyy-M-d'],
            [['hora',], 'time','format'=>'H:m'],
            [['idAccion','idUser'], 'integer'],
            [['comentario'], 'string', 'max' => 255],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFichajes' => 'Id Fichajes',
            'fechaHora' => 'Fecha Hora',
            'idAccion' => 'Id Accion',
            'comentario' => 'Comentario',
            'idUser' => 'Id User'
        ];
    }
	
	public function getFecha()
	{
		$fecha =  (is_object($this->fechaHora)? $this->fechaHora : \DateTime::createFromFormat ( 'Y-m-d H:i:s',  $this->fechaHora ));
		if ($fecha !== FALSE) $this->_fecha = $fecha->format('Y-m-d');
		else $this->_fecha= '';

		return  $this->_fecha;
	}
	
	private $_fecha;
	public function setFecha($value)
	{
		$this->_fecha = $value;
		if ($fecha =  \DateTime::createFromFormat ( 'Y-m-d H:i',  $this->_fecha.' '.$this->_hora ))
		{
			$this->fechaHora = $fecha->format('Y-m-d H:i:s');
			
		}
	}
	
	
	public function getHora()
	{
		
		$fecha =  (is_object($this->fechaHora)? $this->fechaHora : \DateTime::createFromFormat ( 'Y-m-d H:i:s',  $this->fechaHora ));
		
		if ($fecha !== FALSE) $this->_hora = $fecha->format('H:i');
		else $this->_hora= '';
		
		return  $this->_hora;
	}
	
	private $_hora;
	public function setHora($value)
	{
		$this->_hora = $value;
		if ($fecha =  \DateTime::createFromFormat ( 'Y-m-d H:i',  $this->_fecha.' '.$this->_hora ))
		{
			$this->fechaHora = $fecha->format('Y-m-d H:i:s');
		}
	
		
	}
	

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFichajes0()
    {
        return $this->hasOne(Accion::className(), ['idAccion' => 'idFichajes']);
    }
	
	}
