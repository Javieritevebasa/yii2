<?php
namespace app\models;

use Yii;
use setasing\fdpi;
use common\models\APIAlfresco\APIAlfresco;

class ImpresoPDG0305  extends \FPDI
{
	
	public $FilePath = '';
	
	function __construct()
	{
		parent::__construct();
		
		$this->SetMargins(0, 0, 0);


		$this->SetAutoPageBreak(true, 00);
		
		$this->AddPage();
		$pageCount = $this->setSourceFile(Yii::getAlias('@app').'/plantillas/PDG0305.pdf');
		$tplIdx = $this->importPage(1);
		$size = $this->getTemplateSize($tplIdx);

		$this->useTemplate( $tplIdx, 0, 0, $size['w']); 
		
	}
	
	public function generarInforme($seguimientoRiesgo, $filePath = '')
	{
		
		
		$border = 0;
		
		if ($filePath === '')
			return $this->Output('PDG0305','S');	
		else {
			//
			$this->FilePath = $filePath;
			$this->Output($this->FilePath,'F');	
		}
		
	}

	function subirAAlfresco ()
	{
		
		//Esta parte es para subir los ficheros a alfresco
		$urlRepository = 'http://difusion.itevebasa.com:8080/alfresco/cmisatom';
		$user = 'admin';
		$pass = 'adminItv';
		$folderId = 'workspace://SpacesStore/59b70478-fba9-4d8b-ae1d-06697b77df0b'; //Lo guarda dentro del sitio test en la carpeta masiva
		
		$conexion =  APIAlfresco::getInstance();             
		try {                                               
		    $conexion->connect($urlRepository,$user,$pass); 
			
			$conexion->setFolderById($folderId);
			
			$conexion->uploadFile($this->FilePath);
		} catch (Exception $e) {                            
		    //do something
		    die($e);                                  
		}
			
		
	}

	function firmarDocumento($certificatePassword)
	{
		//https://tcpdf.org/examples/example_052/
		/// Comando para optener el certificado y la key desde un pfx
		/// openssl pkcs12 -in certificado.pfx -nokeys -out certificado.pem
		/// openssl pkcs12 -in certificado.pfx -nocerts -nodes -out certificado_key.pem
		
		/*$certificate = 'file://'.realpath('e:/www/labcerTermografos/web/certificados/cert.pem');
		$key = 'file://'.realpath('e:/www/labcerTermografos/web/certificados/key.pem');
			
		// set certificate file'e:\www\labcerTermografos\web\certificados\test.pdf'
		// set additional information
		$info = array(
		    'Name' => 'Miguel Fonseca Castresana',
		   // 'Location' => $inspeccion->equipo->emplazamiento,
		    'Reason' => 'Emisión certificado Verificación Registrador de Temperatura/Termómetro',
		    'ContactInfo' => 'http://cvc.labcer.es',
		    );

		// set document signature
		$this->setSignature($certificate, $key, $certificatePassword, '', 2, $info);
		
		// create content for signature (image and/or text)
		$this->Image(realpath('e:/www/labcerTermografos/web/certificados/firma.png'), 180, 60, 15, 15, 'PNG');
		
		// define active area for signature appearance
		$this->setSignatureAppearance(180, 60, 15, 15);*/

		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		
		// *** set an empty signature appearance ***
		//Esto es si queremos que el documento quede preparado para firmar.
		$this->addEmptySignatureAppearance(180, 80, 15, 15);
		
		
	}

}
