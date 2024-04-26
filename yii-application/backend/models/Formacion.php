<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "formacion".
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property int $horas
 * @property string|null $fechaCreacion
 * @property string|null $fechaInicio
 * @property string|null $fechaFin
 *
 * @property DirigidoA[] $dirigidoAs
 * @property Grupo[] $idGrupos
 * @property Formado[] $formados
 * @property User[] $idUsuarios
 */
class Formacion extends \yii\db\ActiveRecord
{
	
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'formacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'horas','dirigidoA','responsable'], 'required'],
            [['horas'], 'integer'],
            [['fechaCreacion', 'fechaInicio', 'fechaFin'], 'safe'],
            [['codigo'], 'string', 'max' => 45],
            [['nombre'], 'string', 'max' => 500],
            [['codigo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'horas' => 'Horas',
            'fechaCreacion' => 'Fecha Creacion',
            'fechaInicio' => 'Fecha Inicio',
            'fechaFin' => 'Fecha Fin',
            'responsable' => 'Responsable',
        ];
    }

	private $_dirigidoA;
	public function getDirigidoA()
	{
		if ($this->_dirigidoA === null) {
			$this->_dirigidoA=  $this->isNewRecord ? [] : yii\helpers\ArrayHelper::getColumn($this->dirigidoAs,'idGrupo');
		}
		return $this->_dirigidoA;
		
	}
	
	public function setDirigidoA($grupos)
	{
		$this->_dirigidoA = $grupos;
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirigidoAs()
    {
        return $this->hasMany(DirigidoA::className(), ['idFormacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGrupos()
    {
        return $this->hasMany(Grupo::className(), ['idGrupo' => 'idGrupo'])->viaTable('dirigidoA', ['idFormacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormados()
    {
        return $this->hasMany(Formado::className(), ['idFormacion' => 'id']);
    }
	
	public function getResponsable0()
	{
		 return $this->hasOne(User::className(), ['id' => 'responsable']);
	}
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(User::className(), ['id' => 'idUsuario'])->viaTable('formado', ['idFormacion' => 'id']);
    }
	
	private $transaction;
	public function save ($runValidation = true, $attributeNames = null)
	{
		$retorno = true;
		$this->transaction = Yii::$app->db->beginTransaction();
        try
        {
        	if( !parent::save($runValidation,$attributeNames) ) 
			{
				throw new \Exception("No se almacenó correcamente la formación");
			}
		
			if ($this->dirigidoA)
			{
				foreach ($this->dirigidoA as $grupo) {
					 $dirigidoA = DirigidoA::findOne(['idFormacion' => $this->id, 'idGrupo' => $grupo]);
					 if($dirigidoA===null) 
					 {
					 	$dirigidoA = new DirigidoA();
						$dirigidoA->idFormacion = $this->id;
						$dirigidoA->idGrupo = $grupo;
						
					 }
					
					 if (!$dirigidoA->save()) {
					 	$this->addError('dirigidoA', $dirigidoA->getErrors());
		            	throw new \Exception("No se almacenó correcamente la formación");
		            }
		            $keep[] = $dirigidoA->idGrupo;        		
		        }

		        $query = DirigidoA::find()->andWhere(['idFormacion' => $this->id]);
//				print_r($this->dirigidoA);
		        if ($keep) {
		            $query->andWhere(['not in', 'idGrupo', $keep]);
		        }
		        foreach ($query->all() as $gruposAEliminar) {
		       
		            $gruposAEliminar->delete();
		        }   
				
			}
			else {
				
				throw new \Exception("No se almacenó correcamente la formación");
			}
			
			
			$this->transaction->commit();
			
	    }
		catch (Exception $ex)
		{
			$this->transaction->rollBack();
			echo 'Exception1';
			var_dump($this->errors);
			$retorno = false;
		}
        catch (\Exception $ex)
		{
			$this->transaction->rollBack();
			echo 'Exception2 '.$ex->getMessage();
			var_dump($this->errors);
			$retorno = false;
		}
		
		
		return $retorno;
	}
}
