<?php

namespace backend\modules\sisgesdev\models;

use Yii;
use Yii\base\Model;



/**
 * This is the model class for table "evidencia".
 *
 * @property int $id
 * @property string $codigoEvidencia
 * @property string $ruta
 */
class Sisgesdev extends Model
{
	
	
	public $hallazgosAAlegar = [];
    public $alegacionDescripcion;
	 /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alegacionDescripcion','hallazgosAAlegar'], 'required'],
            [['hallazgosAAlegar'], 'safe'],
            [['alegacionDescripcion'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hallazgosAAlegar' => 'Hallazgos para alegar',
            'alegacionDescripcion' => 'Alegación',
        ];
    }
	
	
	function alegar()
	{
		$alegacion = new Alegacion();
		$transaccion = $alegacion->db->beginTransaction();
		try{
			
			
			$alegacion->descripcion = $this->alegacionDescripcion;
			
			if ($alegacion->save())
			{
				foreach ($this->hallazgosAAlegar as $key => $value) {
					$hallazgo = Hallazgo::findOne($value);
					if ($hallazgo === null) throw new \Exception('No existe el hallazgo no se puede alegar', 1);
					if ($hallazgo->tratamientoId != null) throw new \Exception('El hallazgo '.$hallazgo->descripcion.' ya se encuentra en tratamiento, no se puede alegar', 1);
					$hallazgo->alegacionId = $alegacion->id;
					if(!$hallazgo->save()) throw new \Exception('Error al alegar el hallazgo '.$hallazgo->descripcion.' ', 1);
				}
			}
			$transaccion->commit();
		}catch(\Exception $ex)
		{
			$transaccion->rollBack();
			$this->addError('hallazgosAAlegar', $ex->getMessage());
			return false;
		}
		
		return true;
		die('alegando');
	}
	
}
