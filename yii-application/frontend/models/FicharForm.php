<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\LoginForm;
use common\models\User;
use common\models\Fichajes;
use common\models\AccionEkon;
/**
 * ContactForm is the model behind the contact form.
 */
class FicharForm extends Model
{
    public $username;
    public $password;
    public $idAccion;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['username', 'password', 'idAccion'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'idAccion' => 'Acción'
        ];
    }
	
	public function validate ()
	{
		if(parent::validate())
		{
			//Aquí hay que validar que la clave de usuario sea correcta.
			$user = User::findByUsername($this->username);
			
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Usuario o nombre incorrecto.');
				return false;
            }
			else {
				return true;
			}
		}	
		
		return false;	
	}
    
	
	public function Fichar()
	{
		$fichada = new Fichajes();
		$fichada->idAccion = $this->idAccion;
		
		if ($fichada->save())
		{
			
			//Probamos a fichar en EKON:
			try{
				if ($this->username == 'miguel.fonseca')
				{
					die("Fichar Ekon");
				$this->FicharEkon();
				}
			}
			catch (\Exception $ex)
			{
				if ($this->username == 'miguel.fonseca')
				{
					print_r($ex);
					die();
				}
			}
			return true;
		}
		else {
			return false;
		}
		
	}
	
	
	public function FicharEkon()
	{
		$user = User::findByUsername($this->username);
			
		$idAccion = $this->idAccion;
		$estacion = $user->estacionPredeterminada;
		try
		{
			$connection = new \PDO('odbc:Driver=FreeTDS; Server=192.168.23.26; Port=1433; Database=akeitv_data;'. ' UID='.'sa'.'; PWD='.'ccsccs'.';');
			$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $exception)
		{
			  throw new registroException('codigoInterno','No se ha podido conectar con EKON');
		}
			//select xpersona_id from imp.pc_personas where ak_idold='7'
		$hoy = new \DateTime(null, new \DateTimeZone('Europe/Madrid'));			
	

		$query= "
			insert into akeitv_data.imp.ga_cp_marcacol ( 
			xbasedatos_id, xcolaborador_id, xempresa_id, xenvmenpro, xestado_foto, xfecha_id,
			xfecha_jornada,  xmaquina_id,   xmodificado,     xnco_id,     xnocturno,  xpeticion,    xsentidodeduc, 
			xentrada,  xinipausa, xinitarea, xtarea_id, xmarca_id,  xfechahora,  xordenmin,  xtipo,  xuserott,  xreal) 
			
			select 
			'TEST'
			, xpersona_id
			,'TEST'
			,0
			,0
			,CONVERT(DATETIME, '".$hoy->format('Y-m-d H:i:s')."', 102)
			,CONVERT(DATETIME, '".$hoy->format('Y-m-d H:i:s')."', 102)
			,'".$estacion->maquinaTiempoEkon."'
			,0
			,count(0)
			,0
			,0
			,0
			,". AccionEkon::getAccion($idAccion)['xentrada']."
			,". AccionEkon::getAccion($idAccion)['xinipausa']."
			,". AccionEkon::getAccion($idAccion)['xinitarea']."
			,". AccionEkon::getAccion($idAccion)['xtarea_id']."
			,". AccionEkon::getAccion($idAccion)['xmarca_id']."
			,CONVERT(DATETIME, '".$hoy->format('Y-m-d H:i:s')."', 102)
			,10
			,". AccionEkon::getAccion($idAccion)['xtipo']."
			,'WEB'
			,getdate()
			from akeitv_data.imp.pc_personas p left join 
                        (
						select CONVERT(DATETIME, getdate(), 102) xfecha_id, xpersona_id xcolaborador_id  from akeitv_data.imp.pc_personas  where ak_idold = ". $user->id ." union
                        select xfechahora xfecha_id, xcolaborador_id from [akeitv_data].[imp].[ga_cp_marcacol] m left join akeitv_data.imp.pc_personas on pc_personas.xpersona_id=m.xcolaborador_id  where ak_idold = ". $user->id ." and convert(date,xfecha_Id,102)=CONVERT(date, getdate(), 102)
						) f
                        on p.xpersona_id=f.xcolaborador_id
                        where
                        ak_idold = ". $user->id ." and (convert(varchar,xfecha_id, 1) = convert(varchar,getdate(), 1))
                        group by xpersona_id, convert(varchar,xfecha_id, 1)
			";
	
			$statement = $connection->prepare($query);
			
			//$statement->bindParam(':idUser', '7', \PDO::PARAM_STR); 
		//	$statement->bindParam(':checkTime', ($hoy->format('Y-m-d H:i:s')), \PDO::PARAM_STR); 
			
			print_r($statement);
			if (!$statement->execute())
			{
				echo "Error";
				print_r($statement->errorInfo());
			}
			
			
			if (!$statement->rowCount()) 
			{
				echo "No existe ";
			}
			else {
				echo "Actualizado";
			}
		
	}
	
}
