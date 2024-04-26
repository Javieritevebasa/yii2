<?php
namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use aki\telegram;

use common\models\User;
use common\models\Fichajes;
	
class TelegramController extends ActiveController
{
	private $ret;
	
	public $modelClass = 'app\models\Telegram';
	public function behaviors()
    {
        return [
        	'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'test' => ['POST'],
                ],
            ],
        ];
    }
	
	
	public function actionPreguntarFichar()
	{
		
		$users = User::find()->where(['not',['telegramChatId'=> null]])->all();
		
		foreach ($users as $key => $user) {
			$this->ret = Yii::$app->telegram->sendMessage([
			'chat_id' => $user->telegramChatId  ,
			'text' => 'Quieres fichar?',
			'parse_mode' => 'html',
			'reply_markup' => json_encode(['inline_keyboard'=>[[
					['text'=>"Entrar", 'callback_data'=> json_encode(['Accion' => '1', 'Hora' => time(), 'idUser' => $user->id]) ],
					['text'=>"Salir",'callback_data'=> json_encode(['Accion' => '2', 'Hora' => time(), 'idUser' => $user->id])]
					]]
					])
		]);
		echo getcwd() . "\n";
		file_put_contents( $user->telegramChatId.'.txt', $this->ret->result->message_id );
		}
		
		print_r($this->ret->result->message_id);
		die();
	   Yii::$app->telegram->answerCallbackQuery([
           'callback_query_id' => $ret->result->message_id, //require
           'text' => 'que pasa', //Optional
           //'show_alert' => 'my alert',  //Optional
           //'url' => 'http://sample.com', //Optional
           //'cache_time' => 123231,  //Optional
       ]);
	}



	public function actionFichar()
	{
		Yii::$app->telegram->sendMessage([
			'chat_id' => 36540936  ,
			'text' => date('H:i'),
			'parse_mode' => 'html',
		]);
	}
	
	public function actionFicharEkon()
	{
		try
		{
			$connection = new \PDO('odbc:Driver=FreeTDS; Server=192.168.23.26; Port=1433; Database=akeitv_data;'. ' UID='.'sa'.'; PWD='.'ccsccs'.';');
			$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $exception)
		{
			  throw $exception;
		}
			//select xpersona_id from imp.pc_personas where ak_idold='7'
			
			
		$query = "INSERT into akeitv_data.imp.ga_cp_marcacol"  
				 ."(xbasedatos_id, xcolaborador_id, xempresa_id, xenvmenpro, xestado_foto, xfecha_id,     xfecha_jornada," 
				 ."xmaquina_id,   xmodificado,     xnco_id,     xnocturno,  xpeticion,    xsentidodeduc, xentrada," 
				 ."xinipausa,     xmarca_id,       xfechahora,  xordenmin,  xtipo,        xuserott,      xreal)"
				 ."values ("
				 ."'TEST', 	'0000',	'TEST',	0,	0,	cast(:checkTime as date),	cast(:checkTime as date)," 
				 ."'192.168.23.26', 0, 7, 0,0, 0, -1," 
				 ."0, 0, :checkTime, 10, 1, 'WEB', getdate())";
				 			
			//$query ='select * from akeitv_data.imp.ga_cp_marcacol';
			//Luego hay que cambiar el 30000101 por 19000101:
			$statement = $connection->prepare($query);
			
			
			date_default_timezone_set('Europe/Madrid');
			$hoy = new \DateTime();
			echo $hoy->format('Y-m-d H:i:s');
			$statement->bindParam(':checkTime', ($hoy->format('Ymd h:i:s')), \PDO::PARAM_STR); 
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
	
	public function actionRefresh()
	{
		
		$updates = Yii::$app->telegram->getUpdates();
		//print_r($updates['result']); die();

		foreach ($updates['result'] as $key => $value) {
			$updateTelegram =  json_decode(json_encode($value), true);
			$keys= array_keys($updateTelegram);
			
			print_r( $updateTelegram); //continue;
			$fichero = './'.$updateTelegram[$keys[1]]['from']['id'] .'.txt';
			
			if (file_exists($fichero))
			{
				$lastQuestion = file_get_contents( $fichero);
				
				if (key_exists('callback_query', $updateTelegram))
				{
					echo $updateTelegram[$keys[1]]['message']['message_id'];
					if ($lastQuestion ==  $updateTelegram[$keys[1]]['message']['message_id'])
					{
						
						$data = json_decode($updateTelegram[$keys[1]]['data']);
						
						date_default_timezone_set('Europe/Madrid');
						$fecha = new \DateTime( date('Y-m-d H:i:s', $data->Hora), new \DateTimeZone('Europe/Madrid'));
						//$fecha->setTimezone(new  \DateTimeZone('Europe/Madrid'));
						echo 'Fichamos con la hora de '. $data->Accion.' a las '. $fecha->format('Y-m-d H:i:s');
						
						$fichada = new Fichajes();
						$fichada->idAccion = $data->Accion;
						$fichada->fechaHora = $fecha->format('Y-m-d H:i:s');
						$fichada->idUser=$data->idUser;
						
						if ($fichada->saveTelegram())
						{
							
							//Fichar contra EKON:
							// Recuperamos la ip del server de ekon
							
							echo $fichada->idFichajes0->nombre;
							Yii::$app->telegram->sendMessage([
									'chat_id' => $updateTelegram[$keys[1]]['from']['id']  ,
									'text' => 'Fichada ' . $fichada->idFichajes0->nombre. ' realizada con éxito',
									'parse_mode' => 'html',
								]);
							unlink($fichero);
						}
						else 
						{
							
							Yii::$app->telegram->sendMessage([
									'chat_id' => $updateTelegram[$keys[1]]['from']['id']  ,
									'text' => 'No se ha podido fichar '.$fichada->getFirstError('idAccion'),
									'parse_mode' => 'html',
								]);
						}
					}
					else {
						echo 'Ha contestado a una respuesta caducada';
					}
				}
				else {
					echo 'Es un mensaje '. $updateTelegram[$keys[1]]['text'];
				}
				//echo $lastQuestion;
				
			}
			
			
				
			echo '<hr>'. PHP_EOL;
		}
		die();
		
	}
	
	private function Telegram($mensaje)
	{
		$user = Yii::$app->telegram->getMe();
		
		
		$updates = Yii::$app->telegram->getUpdates();
		/*print_r($updates->result);
		
		foreach ($updates->result as $key => $value) {
			print_r($value);
			echo '<hr>'. PHP_EOL;
		}
		die();
		*/
		
		
		Yii::$app->telegram->sendMessage([
			'chat_id' => -36540936  ,
			'text' => $mensaje,
			'parse_mode' => 'html',
		]);
		
		return;
		Yii::$app->telegram->sendMessage([
			'chat_id' => $chat_id,
			'text' => 'test',
		]); 
	}	
}