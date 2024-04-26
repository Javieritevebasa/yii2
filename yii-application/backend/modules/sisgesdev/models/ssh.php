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
class ssh extends Model
{
	
	
	public $usuario = 'admin';
	public $password = 'LaPeraLimonera';
	public $ip = '192.168.23.243';
	public $pathServidorRoot = '/volume1/sisgesdev/evidencias/';
	public $pathTmp = '/var/www/tickadas/backend/web/uploads/';
	
    
	
	function subirFichero($nombreFicheroLocal, $pathServer, $nombreFicheroServer)
	{
		
		try {
			//$pathServer = '/1000/';
			$connection = ssh2_connect($this->ip, 22);
			ssh2_auth_password($connection, $this->usuario, $this->password);
			
			ssh2_exec($connection, 'mkdir -p "'.$this->pathServidorRoot.$pathServer.'"');
			if (ssh2_scp_send($connection, $this->pathTmp.'/'.$nombreFicheroLocal, $this->pathServidorRoot.$pathServer.'/'.$nombreFicheroServer, 0644))
			{
				if (file_exists($this->pathTmp.'/'.$nombreFicheroLocal)) 
					unlink($this->pathTmp.'/'.$nombreFicheroLocal);
			}
			else
				throw new \Exception('No se pudo guardar el archivo '.$this->pathServidorRoot.$pathServer.'/'.$nombreFicheroServer );
		} 
		catch (\Exception $e) {
		    $this->addError('error', $e->getMessage());
		 	if ($nombreFicheroLocal!= '' && file_exists($this->pathTmp.'/'.$nombreFicheroLocal)) unlink($this->pathTmp.'/'.$nombreFicheroLocal);
			return false;
		}
		
		return true;
	}
	
	function eliminarFichero($pathServer, $nombreFicheroServer)
	{
		
		try {
			$connection = ssh2_connect($this->ip, 22);
			ssh2_auth_password($connection, $this->usuario, $this->password);
			
			ssh2_exec($connection, 'rm '.escapeshellarg($this->pathServidorRoot.$pathServer.'/'.$nombreFicheroServer).'*');
		} 
		catch (\Exception $e) {
		    error_log('Exception: ' . $e->getMessage());
		    $this->addError('ip', $e->getMessage());
			return false;
		}
		
		return true;
	}
}
