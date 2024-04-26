<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use backend\models\UserSearchConfiguracion;
use backend\models\Barcode;
use common\models\Grupo;
use common\models\Estacion;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;
use yii\helpers\ArrayHelper;
use backend\models\PDF;
use backend\models\PdfDocument;

use backend\models\IFO010203;
use common\models\APIAlfresco\APIAlfresco;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        	'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['probar-labcer', 'index', 'view', 'create', 'update', 'delete', 'validar', 'imprimir-codigo-barras', 'imprimir-codigo-barras-estacion', 'index-configuracion', 'impreso-ifo010203','enviar-certificado', 'enviar-certificado-estacion','obtener-formacion'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }



    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndexConfiguracion()
    {
        $searchModel = new UserSearchConfiguracion();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$grupos= [];
    	foreach (Yii::$app->user->identity->idGrupos as $key => $value) {
		 	array_push($grupos, $value->idGrupo);
		}
		
    	if (count(array_intersect([0, 11], $grupos)) == 0  )
		{
			   throw new ForbiddenHttpException('No tiene el rango suficiente para modificar éste usuario');
		}
			
        $model = new User();

        
        if($model->load(Yii::$app->request->post())){
        	
			
			
			$fichero =  UploadedFile::getInstance($model,'foto');
			if ($fichero != null){
					
				$model->foto = fopen($fichero->tempName, 'rb');
			}
			
			
			
			if ( $model->save()){
				/*				
				$model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
			
	      		$model->auth_key = Yii::$app->security->generateRandomString();
	        	$model->created_at = 1;
				$model->updated_at = 1;
				$model->status = 10;
		*/
		        return $this->redirect(['view', 'id' => $model->id]);
			}
			else {
				print_r($model->getErrors());
			}
	        
		} else {
        	
			$model->_grupos = [];
			foreach ($model->pertenecers as $item )
				array_push($model->_grupos,$item->idGrupo);
		
			//$destinatariosSeleccionados = $model->_destinatarios;
			$dataProvider = new ArrayDataProvider([ 'allModels' => Grupo::find()->all(), 'pagination' => ['pageSize' => -1, ]]);
			
			$model->_estaciones = [];
			foreach ($model->codigoEstacions as $item )
				array_push($model->_estaciones,$item->codigo);
		
			//$destinatariosSeleccionados = $model->_destinatarios;
			$dataProviderEstaciones = new ArrayDataProvider([ 'allModels' => Estacion::find()->all(), 'pagination' => ['pageSize' => -1, ],]);
			
			$predeterminada = $model->EstacionPredeterminada;
				
            return $this->render('create', [
                'model' => $model,
                'gruposSeleccionados'=>$model->_grupos, 
                'dataProvider'=> $dataProvider, 
                'estacionesSeleccionadas'=> $model->_estaciones,
                'dataProviderEstaciones'=> $dataProviderEstaciones,
                 'estacionPredeterminada' => $predeterminada,
                'errors' => $model->getErrors()
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	
		
		
        $model = $this->findModel($id);
		$foto = $model->foto;
		$certificado = $model->certificado;
		
		if($model->load(Yii::$app->request->post()))
		{
			
			
			if (Yii::$app->user->identity->pesoMaximo < $model->pesoMaximo)
			{
				   throw new ForbiddenHttpException('No tiene el rango suficiente para modificar éste usuario');
			}
			
			
				if (Yii::$app->user->identity->id == $model->id )
				{
					   throw new ForbiddenHttpException('No se puede modificar los datos usted mismo');
				}
		
		
			$fichero =  UploadedFile::getInstance($model,'foto');
			if ($fichero != null){
					
				$model->foto = fopen($fichero->tempName, 'rb');
				
				
			}
			else 
				$model->foto = $foto;
			//print_r($model->foto);die();
			
			
			$certificadotmp = UploadedFile::getInstance($model,'certificado');
			if ($certificadotmp != null){
				$certificado = fopen($certificadotmp->tempName, 'rb');
			}
			$model->certificado = 	$certificado;
			
			
			if($model->save()){
				/*if($model->password)
				{			
					$model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
	      			$model->auth_key = Yii::$app->security->generateRandomString();
				}
				$model->updated_at = 1;
				$model->status = 10;
				*/
		       
		        return $this->redirect(['view', 'id' => $model->id]);
		 	}
		} else {
        	
			$model->_grupos = [];
			foreach ($model->pertenecers as $item )
				array_push($model->_grupos,$item->idGrupo);
			$dataProvider = new ArrayDataProvider([ 'allModels' => Grupo::find()->all(), 'pagination' => ['pageSize' => -1, ]]);
				print_r($model->_estaciones );
			
			// die("");
			$model->_estaciones = [];
			foreach ($model->codigoEstacions as $item )
			{
				array_push($model->_estaciones,$item->codigo);
			}
			$dataProviderEstaciones = new ArrayDataProvider([ 'allModels' => Estacion::find()->all(), 'pagination' => ['pageSize' => -1, ]]);
			
			$predeterminada = $model->EstacionPredeterminada;
		
            return $this->render('update', [
                'model' => $model,
                'gruposSeleccionados'=>$model->_grupos, 
                'dataProvider'=> $dataProvider, 
                'estacionesSeleccionadas'=> $model->_estaciones,
                'dataProviderEstaciones'=> $dataProviderEstaciones,
                'estacionPredeterminada' => $predeterminada,
                'errors' => $model->getErrors()
            ]);
        }
    }


  	public function actionValidar()
    {
    	
        $usuarios = User::find()
		    ->where(['>=', 'id', 347])
		    ->all();
			
		print_r($usuarios);
		
		foreach ($usuarios as $usuario )
		{
			$usuario->password='itv';	
			$usuario->save2();
			
			print_r($usuario->getErrors());
		}	
		
    }
	
	public function actionImpresoIfo010203($id, $firmarDocumento = 1)
	{
		$inspector = User::findOne($id);
	
		if (Yii::$app->request->isPost)
		{
	
			$aux = new IFO010203();
			//java -jar PortableSigner.jar -n -t /var/www/tickadas/backend/plantillas/tmp.pdf -o ./tmpSigned.pdf -s ./3032.pfx -p itv3032
			
			$pathCertTemp = Yii::getAlias('@app').'/plantillas/tmp/'.$inspector->estacion->responsable0->id.'.pfx';
			$pathIfoTemp = Yii::getAlias('@app').'/plantillas/tmp/ifo010203_'.$inspector->id.'.pdf';
			$pathIfoSignedTemp = Yii::getAlias('@app').'/plantillas/tmp/ifo010203_'.$inspector->id.'_Signed.pdf';
			
			file_put_contents($pathCertTemp, $inspector->estacion->responsable0->certificado);
			$aux->getPdf($inspector, $pathIfoTemp);
			//die($pathIfoTemp);
			if ($firmarDocumento == 0)
			{
				$pathIfoSignedTemp = $pathIfoTemp;
			}
			else {
				//file_put_contents(Yii::getAlias('@app').'/plantillas/'.Yii::$app->user->identity->id.'.pfx', Yii::$app->user->identity->certificado);
				//file_put_contents(Yii::getAlias('@app').'/plantillas/ifo010203'.$inspector->id.'.pdf',$aux->getPdf($inspector));
				$cmd = 'java -jar '. Yii::getAlias('@vendor').'/portablesigner/PortableSigner.jar -n -t "'. $pathIfoTemp .'" -o '. $pathIfoSignedTemp .' -s '. $pathCertTemp .' -p '.Yii::$app->request->post()['User']["passwordCertificado"].'  ';
				$return = shell_exec( $cmd );
			}
			
			
			if (!file_exists($pathIfoSignedTemp)) {
				var_dump($return);
				echo $cmd;				
				
				die('Error al firmar el documento');
			}
			
		/*	Esta parte es para subir los ficheros a alfresco
			$urlRepository = 'http://difusion.itevebasa.com:8080/alfresco/cmisatom';
			$user = 'admin';
			$pass = 'adminItv';
			$folderId = 'workspace://SpacesStore/59b70478-fba9-4d8b-ae1d-06697b77df0b'; //Lo guarda dentro del sitio test en la carpeta masiva
			
			$conexion =  APIAlfresco::getInstance();             
			try {                                               
			    $conexion->connect($urlRepository,$user,$pass); 
				
				$conexion->setFolderById($folderId);
				
				$conexion->uploadFile($pathIfoSignedTemp);
			} catch (Exception $e) {                            
			    //do something                                  
			}*/
			
			//require_once Yii::getAlias('@common').'/models/APIAlfresco/APIAlfresco.php';
			//die('aki');
			
			$size = filesize($pathIfoSignedTemp);
			
			header("Content-type: application/pdf");
			header("Content-Disposition: attachment; filename=ifo010203_".$inspector->id."_Signed.pdf");
	        header("Content-Transfer-Encoding: binary");
	        header("Content-Length: " . $size);
			readfile($pathIfoSignedTemp);
			
			unlink($pathCertTemp);
			unlink($pathIfoSignedTemp);
			unlink($pathIfoTemp);
			return true;
		}
		
		if ($inspector->estacion->responsable0 == null)
		{
			 throw new NotFoundHttpException('No se ha establecido ningún responsable para la estación '.$inspector->estacion->codigo.'.');
		}
		 
		 return $this->render('formPasswordCertificado', [
                'model' => $inspector->estacion->responsable0,
                ]);
		
	}
	
	public function actionProbarLabcer()
	{
		
		$urlRepository = 'http://difusion.labcer.es:8080/alfresco/cmisatom';
			$user = 'jorge.sarabia';
			$pass = 'actaslabcer';
			$fileId = 'workspace://SpacesStore/2ed82bf7-179a-4b8c-91bf-da58a33461e6'; //Lo guarda dentro del sitio test en la carpeta masiva
			
			$conexion =  APIAlfresco::getInstance();             
			try {                                               
			    $conexion->connect($urlRepository,$user,$pass); 
				$fileId=$conexion->getObjectId('/company_home/sites/test/documentLibrary/Industrial');
				print_r($fileId);
				
				$conexion->setFolderById($fileId);
				
				//$conexion->uploadFile($pathIfoSignedTemp);
			} catch (\Exception $e) {                            
			    //do something       
			    print_r($e);
			                               
			}
			
	}
	
	public function actionEnviarCertificado($id)
	{
		$user = User::findOne($id);
		$model = new Estacion();
		if($model->load(Yii::$app->request->post())){
			
			$estacion = Estacion::findOne($model->codigo);
			
			$urlRepository = 'http://difusion.itevebasa.com:8080/alfresco/cmisatom';
			$alfrescoUser = 'admin';
			$alfrescoPass = '7CE66mQBa7RXGM2';
			$folderId = 'workspace://SpacesStore/59b70478-fba9-4d8b-ae1d-06697b77df0b'; //Lo guarda dentro del sitio test en la carpeta masiva
			
			$conexion =  APIAlfresco::getInstance();             
			try {                                               
			    $conexion->connect($urlRepository,$alfrescoUser,$alfrescoPass);
			    $path = '/sitios/certificados/documentLibrary/'.$user->codigoInspector.'.p12'; 
				$fileId=$conexion->getObjectId($path);
				
				$localPath = $conexion->getFile($fileId, '/var/www/tickadas/backend/web/uploads');
				
				//Conexion scp:
				$hostname = $estacion->servidor;
				
				
				$username = "root";
				$password = "itv".$estacion->codigo;
				$sourceFile = $localPath;
				$targetFile = '/ALFA/FIRMAS/'.$user->codigoInspector.'.p12';
				$connection = ssh2_connect($hostname, 22);
				ssh2_auth_password($connection, $username, $password);
				$sftp = ssh2_sftp($connection);
 
 				//Subimos el certificado:
				$sftpStream = fopen('ssh2.sftp://'.$sftp.$targetFile, 'w');
				try {
				    if (!$sftpStream) {
				        throw new Exception("Could not open remote file: $dstFile");
				    }
				    $data_to_send = file_get_contents($sourceFile);
				    if ($data_to_send === false) {
				        throw new Exception("Could not open local file: $srcFile.");
				    }
				    if (fwrite($sftpStream, $data_to_send) === false) {
				        throw new Exception("Could not open local file: $srcFile.");
				    }
					
				    fclose($sftpStream);
					unlink($sourceFile);
				} catch (Exception $e) {
				    fclose($sftpStream);
					$user->addError('certificado',$e->getMessage());
					//echo('Exception: ' . $e->getMessage());
					
				}
				
				
				//Generamos el fichero de firma en blanco
				$img = imagecreatetruecolor(1, 1);
				$bg = imagecolorallocate ( $img, 255, 255, 255 );
				imagefilledrectangle($img,0,0,120,20,$bg);
				 
				$sourceFile='/var/www/tickadas/backend/web/uploads/firma'.$user->codigoInspector.'.jpg';
				imagejpeg($img,$sourceFile,100);
				$targetFile = '/ALFA/FIRMAS/firma'.$user->codigoInspector.'.jpg';
				//Subimos la firma:
				$sftpStream = fopen('ssh2.sftp://'.$sftp.$targetFile, 'w');
				try {
				    if (!$sftpStream) {
				        throw new Exception("Could not open remote file: $dstFile");
				    }
				    $data_to_send = file_get_contents($sourceFile);
				    if ($data_to_send === false) {
				        throw new Exception("Could not open local file: $srcFile.");
				    }
				    if (fwrite($sftpStream, $data_to_send) === false) {
				    	throw new Exception("Could not upload local file: $srcFile.");
				    }
				    fclose($sftpStream);
				} catch (Exception $e) {
				    $user->addError('certificado',$e->getMessage());
					fclose($sftpStream);
				}
				//Submios el fichero codigoInspector.jpg
				$targetFile = '/ALFA/FIRMAS/'.$user->codigoInspector.'.jpg';
				
				$sftpStream = fopen('ssh2.sftp://'.$sftp.$targetFile, 'w');
				try {
				    if (!$sftpStream) {
				        throw new Exception("Could not open remote file: $dstFile");
				    }
				    $data_to_send = file_get_contents($sourceFile);
				    if ($data_to_send === false) {
				        throw new Exception("Could not open local file: $srcFile.");
				    }
				    if (fwrite($sftpStream, $data_to_send) === false) {
				    	throw new Exception("Could not upload local file: $srcFile.");
				    }
				    fclose($sftpStream);
				} catch (Exception $e) {
				    $user->addError('certificado',$e->getMessage());
					fclose($sftpStream);
				}
				unlink($sourceFile);   
			} catch (\Exception $e) {                            
			    $user->addError('certificado',$e->getMessage());
					//echo('Exception: ' . $e->getMessage());
				                           
			}
			
			
			return $this->render('confirmacionEnvioCertificado', [
                'user' => $user,
                'estacion'=> $estacion,
            ]);
			
		}
		
		 return $this->render('enviarCertificado', [
                'model' => $model,
                'estaciones'=> $user->codigoEstacions,
                
            ]);
		
	}
	
	
	public function actionEnviarCertificadoEstacion($id)
	{
		$user = User::findOne($id);
		$model = new Estacion();
		if($model->load(Yii::$app->request->post())){
			
			$estacion = Estacion::findOne($model->codigo);
			
			$urlRepository = 'http://difusion.itevebasa.com:8080/alfresco/cmisatom';
			$alfrescoUser = 'admin';
			$alfrescoPass = '7CE66mQBa7RXGM2';
			$folderId = 'workspace://SpacesStore/59b70478-fba9-4d8b-ae1d-06697b77df0b'; //Lo guarda dentro del sitio test en la carpeta masiva
			
			$conexion =  APIAlfresco::getInstance();             
			try {                                               
			    $conexion->connect($urlRepository,$alfrescoUser,$alfrescoPass);
			    $path = '/sitios/certificados/documentLibrary/'.$user->codigoInspector.'.p12'; 
				$fileId=$conexion->getObjectId($path);
				
				$localPath = $conexion->getFile($fileId, '/var/www/tickadas/backend/web/uploads');
				
				
				if ($almacén_cert = file_get_contents($localPath)) {
					if (openssl_pkcs12_read($almacén_cert, $info_cert, "microges")) {
						//Hay que cambiar la contraseña
						openssl_pkcs12_export_to_file ( $info_cert['cert'] , $localPath ,$info_cert['pkey'] , 'alfa' );	
						/*	
						$result = null;
						$worked = openssl_pkey_export($info_cert['pkey'], $result, 'alfa');
						if($worked) {
							openssl_pkcs12_export_to_file ( $info_cert['cert'] , $localPath ,$info_cert['pkey'] , 'alfa' );
						} else {
							throw new Exception(openssl_error_string(), 1);
						}*/
					} else {
						//Ya tiene la contraseña que toca:
						//throw new Exception("Error: No se puede leer el almacén de certificados.", 1);
					}
						
					
				}
				else {
					throw new Exception("No se pudo leer el certificado", 1);	
				}
				
				
				//Conexion scp:
				$hostname = $estacion->servidor;
				$username = "root";
				$password = "itv".$estacion->codigo;
				$sourceFile = $localPath;
				$targetFile = '/ALFA/FIRMAS/certificado.p12';
				$connection = ssh2_connect($hostname, 22);
				ssh2_auth_password($connection, $username, $password);
				$sftp = ssh2_sftp($connection);
 
 				//Subimos el certificado:
				$sftpStream = fopen('ssh2.sftp://'.$sftp.$targetFile, 'w');
				try {
				    if (!$sftpStream) {
				        throw new Exception("Could not open remote file: $dstFile");
				    }
				    $data_to_send = file_get_contents($sourceFile);
				    if ($data_to_send === false) {
				        throw new Exception("Could not open local file: $srcFile.");
				    }
				    if (fwrite($sftpStream, $data_to_send) === false) {
				        throw new Exception("Could not open local file: $srcFile.");
				    }
					
				    fclose($sftpStream);
					unlink($sourceFile);
				} catch (Exception $e) {
				    fclose($sftpStream);
					$user->addError('certificado',$e->getMessage());
					//echo('Exception: ' . $e->getMessage());
					
				}
				
				//Generamos el fichero de firma en blanco
				$img = imagecreatetruecolor(1, 1);
				$bg = imagecolorallocate ( $img, 255, 255, 255 );
				imagefilledrectangle($img,0,0,120,20,$bg);
				 
				$sourceFile='/var/www/tickadas/backend/web/uploads/firma'.$user->codigoInspector.'.jpg';
				imagejpeg($img,$sourceFile,100);
				$targetFile = '/ALFA/FIRMAS/firma.jpg';
				//Subimos la firma:
				$sftpStream = fopen('ssh2.sftp://'.$sftp.$targetFile, 'w');
				try {
				    if (!$sftpStream) {
				        throw new Exception("Could not open remote file: $dstFile");
				    }
				    $data_to_send = file_get_contents($sourceFile);
				    if ($data_to_send === false) {
				        throw new Exception("Could not open local file: $srcFile.");
				    }
				    if (fwrite($sftpStream, $data_to_send) === false) {
				    	throw new Exception("Could not upload local file: $srcFile.");
				    }
				    fclose($sftpStream);
				} catch (Exception $e) {
				    $user->addError('certificado',$e->getMessage());
					fclose($sftpStream);
				}
				unlink($sourceFile);
			} catch (\Exception $e) {                            
			    $user->addError('certificado',$e->getMessage());
					//echo('Exception: ' . $e->getMessage());
				                             
			}
			
			
			return $this->render('confirmacionEnvioCertificado', [
                'user' => $user,
                'estacion'=> $estacion,
            ]);
			
		}
		
		 return $this->render('enviarCertificado', [
                'model' => $model,
                'estaciones'=> $user->codigoEstacions,
                
            ]);
		
	}

	public function actionImprimirCodigoBarras($id)
	{
		try
		{
		$user = User::findOne($id);
		$generator = new barcode();
		//Generar y forzar descarga de la imagen generada;
		//header('Content-Disposition: Attachment;filename=image.png'); 
		//header('Content-type: image/png');
		$image = $generator->render_image('code-128', $user->codigoInspector, ['w' => 200]);
		$image= imagerotate($image,-90.0,0);
		imagepng($image,'barcode'.$id.'.png');
		
		$aux = PDF::GenerarPDFSalida($user, 'barcode'.$id.'.png','S');
		imagedestroy($image);
		
		header("Content-type: application/pdf");
		header("Content-Disposition: Attachment; filename=filename.pdf");
		echo $aux;
		
		
		}catch(\Exception $ex)
		{
			die( $ex->getMessage());
		}
	}
	
	
	public function actionImprimirCodigoBarrasEstacion($estacion)
	{
		try
		{
		$usuarios = User::find()->joinWith('codigoEstacions')->andWhere(['not', ['codigoInspector' => null]])->andWhere(['not', ['codigoInspector' => '']])->andWhere(['codigo' => $estacion])->orderBy('codigoInspector')->all();
		
		//$usuarios = ArrayHelper::map($usuarios, 'id', 'codigoInspector');
		//print_r($usuarios);die();
		$usuarios = ArrayHelper::getColumn($usuarios, 'codigoInspector');
		$aux = PDF::GenerarTarjetasEstacion($usuarios);
		
		
		header("Content-type: application/pdf");
		header("Content-Disposition: Attachment; filename=filename.pdf");
		echo $aux;
		
		
		}catch(\Exception $ex)
		{
			die( $ex->getMessage());
		}
	}
	
	/**
     * Lists all User models.
     * @return mixed
     */
    public function actionObtenerFormacion($id)
    {
        $usuario = User::findOne($id);

        print_r($usuario->formacion);
    }
	
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
