<?php

namespace backend\controllers;

use Yii;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

use backend\models\User;

class FichajeController extends \yii\web\Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','index-almuerzos', 'ajax-fichajes', 'ajax-almuerzos','ajax-grafica-trabajador','estadistica-trabajador','ajax-historico-trabajador','estadistica-trabajador-detalle-dia', 'resumen-trabajadores', 'resumen-trabajadores-estacion'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            
        ];
    }
	
    public function actionIndex($fecha = '')
    {
       	
        return $this->render('index', ['fecha' => $fecha]);
    }
	
	public function actionIndexAlmuerzos()
    {
    	
        return $this->render('indexAlmuerzos');
    }
	
	public function actionResumenTrabajadores($anyo=null, $mes=null, $estacion = null)
	{
		 try {
		 	;
			if ($anyo===null) $anyo = date('Y');
			
			if ($mes===null) $mes = date('m');
			if ($estacion == null )	$estacion = Yii::$app->user->identity->estacionPredeterminada->codigo;
		
            $sql =  'CALL resumen_tickadas_estacion (:anyo, :mes, :estacion)' ;

            $command = \Yii::$app->db->createCommand($sql);
            $command->bindParam(":anyo", $anyo, \PDO::PARAM_INT);
            $command->bindParam(":mes", $mes, \PDO::PARAM_INT);
			$command->bindParam(":estacion", $estacion, \PDO::PARAM_STR);
            $list = $command->queryAll();
         }catch (Exception $e) {
            throw new Exception("Error : ".$e);
         }
		 //print_r($list);
		 
		 $list = (ArrayHelper::index($list, null, 'idUser'));
		 return $this->render('resumenTrabajadores',[
        		'fichadas'=>$list,
        		'anyo' => $anyo,
        		'mes' => $mes,
        		'estacion' => $estacion
        		]);
	}
	
	
	public function actionResumenTrabajadoresEstacion($anyo, $mes, $estacion)
	{
		$this->layout='resumenTrabajadores';
		 try {
            $sql =  'CALL resumen_tickadas_estacion (:anyo, :mes, :estacion)' ;

            $command = \Yii::$app->db->createCommand($sql);
            $command->bindParam(":anyo", $anyo, \PDO::PARAM_INT);
            $command->bindParam(":mes", $mes, \PDO::PARAM_INT);
			$command->bindParam(":estacion", $estacion, \PDO::PARAM_STR);
            $list = $command->queryAll();
         }catch (Exception $e) {
            throw new Exception("Error : ".$e);
         }
		 //print_r($list);
		 
		 $list = (ArrayHelper::index($list, null, 'idUser'));
		 return $this->render('resumenTrabajadores',[
        		'fichadas'=>$list,
        		'anyo' => $anyo,
        		'mes' => $mes,
        		'estacion' => $estacion
        		]);
	}
	
	
	public function actionEstadisticaTrabajadorDetalleDia($usuario, $dia)
    {
    	if ($dia==='')
		{
			date_default_timezone_set ('Europe/Madrid');
			$dia = date('Y-m-d');
		}
		else {
			$dia = date('Y-m-d',strtotime($dia));
		}
		
    	$u = User::find()->where(['id'=>$usuario])->one();
		$sql = 'SELECT idUser, DATE_FORMAT(fechaHora,"%d-%m-%Y") dia, DATE_FORMAT(fechaHora,"%H:%i") hora, accion.nombre accion from fichajes inner join accion on fichajes.idAccion=accion.idAccion where date(fechaHora)="'.$dia.'" and idUser='.$usuario.' order by fechaHora';
        $fichadas = \Yii::$app->db->createCommand($sql)->queryAll();
		$provider = new ArrayDataProvider([
		    'allModels' => $fichadas,
		    'sort' => [
		        'attributes' => [ 'dia', 'hora', 'accion',],
		    ],
		    'pagination' => [
		        'pageSize' => 0,
		    ],
		]);
        return $this->render('estadisticaTabajadorDetalle',[
        		'usuario' => $u,
        		
        		'fichadas'=>$provider,
        		]);
		
    }
	
	public function actionEstadisticaTrabajador($usuario)
    {
    	
    	$u = User::find()->where(['id'=>$usuario])->one();
		//$sql = 'SELECT idUser, DATE_FORMAT(fechaHora,"%d-%m-%Y") dia, DATE_FORMAT(fechaHora,"%H:%i") hora, accion.nombre accion from fichajes inner join accion on fichajes.idAccion=accion.idAccion where year(fechaHora)='.date('Y').' and idUser='.$usuario.' order by fechaHora';
        $sql = 'SELECT idUser, dia, tiempoTrabajando, tiempoAlmuerzo, tiempoOperativo from tiempos_trabajador_por_dia where year(dia)='.date('Y').' and idUser='.$u->id.' order by dia';
        
        print_r($sql);
        $fichadas = \Yii::$app->db->createCommand($sql)->queryAll();
		$provider = new ArrayDataProvider([
		    'allModels' => $fichadas,
		    'sort' => [
		        'attributes' => [ 'dia', 'tiempoTrabajando', 'tiempoAlmuerzo', 'tiempoOperativo'],
		    ],
		    'pagination' => [
		        'pageSize' => 0,
		    ],
		]);
        return $this->render('estadisticaTabajador',[
        		'usuario' => $u,
        		
        		'fichadas'=>$provider,
        		]);
    }
	
	public function actionAjaxFichajes($dia)
	{
		if ($dia==='')
		{
			date_default_timezone_set ('Europe/Madrid');
			$dia = date('Y-m-d');
		}
		else {
			$dia = date('Y-m-d',strtotime($dia));
		}
		
		
		$estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->getCodigoEstacions()->asArray()->all(), 'codigo');
		$estaciones = implode('\',\'', $estaciones);
		$estaciones = '\'' . $estaciones . '\'';
		
		//$sql = "SELECT e.codigoEstacion, DATE_FORMAT(a.entrada,'%H:%i') entrada, DATE_FORMAT(a.salida,'%H:%i') salida,  sec_to_time(TIMESTAMPDIFF(minute, entrada, salida)*60) tiempo, u.id, u.nombre, u.apellidos FROM tickadas.listado_fichadas a inner join user u on a.idUser = u.id left join estaciones_predeterminada_por_usuario e on u.id = e.idUser where date(entrada)='".$dia."' order by e.codigoEstacion, entrada";
		
		//$sql = "SELECT e.codigoEstacion, DATE_FORMAT(a.entrada,'%H:%i') entrada, DATE_FORMAT(a.salida,'%H:%i') salida,  sec_to_time(TIMESTAMPDIFF(minute, entrada, salida)*60) tiempo, u.id, u.nombre, u.apellidos FROM tickadas.listado_fichadas a inner join user u on a.idUser = u.id left join estaciones_predeterminada_por_usuario e on u.id = e.idUser where date(entrada)='".$dia."' order by e.codigoEstacion, entrada";
        
        $sql = <<<EOT
        	select
        	e.codigoEstacion,
        	es.nombre as nombreEstacion, 
			drvEntrada.idUser, 
		    drvEntrada.idFichajes idEntrada,
		    drvSalida.idFichajes idSalida,
		    drvEntrada.fechaHora fechaHora,
		    drvEntradaAlmuerzo.idFichajes idEntradaAlmuerzo,
		    drvSalidaAlmuerzo.idFichajes idSalidaAlmuerzo,
		    drvEntradaFormacion.idFichajes idEntradaFormacion,
		    drvSalidaFormacion.idFichajes idSalidaFormacion,
		    date_format(drvEntrada.fechaHora, '%H:%i') entrada, 
		    /*drvEntrada.orden, */
		   /* drvSalida.idAccion accionSalida, */
		    date_format(drvSalida.fechaHora,'%H:%i') salida, 
		    date_format(drvEntradaAlmuerzo.fechaHora,'%H:%i') horaEntradaAlmuerzo,
		    date_format(drvSalidaAlmuerzo.fechaHora,'%H:%i') horaSalidaAlmuerzo,
		    date_format(drvEntradaFormacion.fechaHora,'%H:%i') horaEntradaFormacion,
		    date_format(drvSalidaFormacion.fechaHora,'%H:%i') horaSalidaFormacion,
		    vr3.diaEstudio,
			timediff(drvSalida.fechaHora, drvEntrada.fechaHora) as tiempo,
		    timediff(drvSalidaAlmuerzo.fechaHora, drvEntradaAlmuerzo.fechaHora) as tiempoAlmuerzo,
		    timediff(drvSalidaFormacion.fechaHora, drvEntradaFormacion.fechaHora) as tiempoFormacion,
		    case when (drvEntradaAlmuerzo.fechaHora is null or drvSalidaAlmuerzo.fechaHora is null) then timediff(drvSalida.fechaHora, drvEntrada.fechaHora) else timediff(timediff(drvSalida.fechaHora, drvEntrada.fechaHora), timediff(drvSalidaAlmuerzo.fechaHora, drvEntradaAlmuerzo.fechaHora)) end as tiempoEfectivo,
		    
		    u.id, 
		    u.nombre, 
		    u.apellidos
		from
		(
			select  @diaEstudio := date('$dia') as diaEstudio
		) vr3
		join 
		( 
			select @cnt:= case when @user <> idUser or @dia<>date(fechaHora)  then 1 else @cnt + 1 end as orden, @user := idUSer,fichajes.idUser, @dia:=date(fechaHora), fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes 
		    from fichajes 
		    join ( select @cnt := 0, @user := 0, @dia := date('1970-01-01') ) vr1
		    where fichajes.idAccion = 1 and date(fichajes.fechaHora) = @diaEstudio
		    order by idUser, fichajes.fechaHora 
		    
		) drvEntrada
		on date(drvEntrada.fechaHora) = vr3.diaEstudio
		left join 
		( 
			select @cnt2:= case when @user2 <> idUser or @dia2<>date(fechaHora)  then 1 else @cnt2 + 1 end as orden, @user2 := idUSer, @dia2:=date(fechaHora), fichajes.idUser, fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes
		    from fichajes 
		    join ( select @cnt2 := 0, @user2 := 0, @dia2 := date('1970-01-01') ) vr2
		    where fichajes.idAccion = 2   and date(fichajes.fechaHora) = @diaEstudio
		    order by idUser,fichajes.fechaHora
		    
		) drvSalida 
		on 
			drvEntrada.idUser = drvSalida.idUser 
		    and date(drvEntrada.fechaHora) = date(drvSalida.fechaHora) 
		    and drvEntrada.orden=drvSalida.orden 
		    and date(drvEntrada.fechaHora)=vr3.diaEstudio
		left join 
		( 
			select @cnt:= case when @user <> idUser or @dia<>date(fechaHora)  then 1 else @cnt + 1 end as orden, @user := idUSer,fichajes.idUser, @dia:=date(fechaHora), fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes
			from fichajes 
			join ( select @cnt := 0, @user := 0, @dia := date('1970-01-01') ) vr1
			where fichajes.idAccion = 3  and date(fichajes.fechaHora) = @diaEstudio
			order by idUser, fichajes.fechaHora 
		     
		) drvEntradaAlmuerzo
		on 
			drvEntrada.idUser = drvEntradaAlmuerzo.idUser 
		    and date(drvEntrada.fechaHora) = date(drvEntradaAlmuerzo.fechaHora) 
		    and drvEntrada.orden=drvEntradaAlmuerzo.orden 
		    and date(drvEntradaAlmuerzo.fechaHora)=vr3.diaEstudio
		left join 
		( 
			select @cnt2:= case when @user2 <> idUser or @dia2<>date(fechaHora)  then 1 else @cnt2 + 1 end as orden, @user2 := idUSer, @dia2:=date(fechaHora), fichajes.idUser, fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes
		    from fichajes 
		    join ( select @cnt2 := 0, @user2 := 0, @dia2 := date('1970-01-01') ) vr2
		    where fichajes.idAccion = 4   and date(fichajes.fechaHora) = @diaEstudio
		    order by idUser,fichajes.fechaHora
		  
		) drvSalidaAlmuerzo 
		on 
			drvEntrada.idUser = drvSalidaAlmuerzo.idUser 
		    and date(drvEntrada.fechaHora) = date(drvSalidaAlmuerzo.fechaHora) 
		    and drvEntrada.orden=drvSalidaAlmuerzo.orden 
		    and date(drvSalidaAlmuerzo.fechaHora)=vr3.diaEstudio
		left join 
		( 
			select @cnt:= case when @user <> idUser or @dia<>date(fechaHora)  then 1 else @cnt + 1 end as orden, @user := idUSer,fichajes.idUser, @dia:=date(fechaHora), fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes 
			from fichajes 
			join ( select @cnt := 0, @user := 0, @dia := date('1970-01-01') ) vr1
			where fichajes.idAccion = 6  and date(fichajes.fechaHora) = @diaEstudio
			order by idUser, fichajes.fechaHora 
		     
		) drvEntradaFormacion
		on 
			drvEntrada.idUser = drvEntradaFormacion.idUser 
		    and date(drvEntrada.fechaHora) = date(drvEntradaFormacion.fechaHora) 
		    and drvEntrada.orden=drvEntradaFormacion.orden 
		    and date(drvEntradaFormacion.fechaHora)=vr3.diaEstudio
		left join 
		( 
			select @cnt2:= case when @user2 <> idUser or @dia2<>date(fechaHora)  then 1 else @cnt2 + 1 end as orden, @user2 := idUSer, @dia2:=date(fechaHora), fichajes.idUser, fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes 
		    from fichajes 
		    join ( select @cnt2 := 0, @user2 := 0, @dia2 := date('1970-01-01') ) vr2
		    where fichajes.idAccion = 5   and date(fichajes.fechaHora) = @diaEstudio
		    order by idUser,fichajes.fechaHora
		  
		) drvSalidaFormacion 
		on 
			drvEntrada.idUser = drvSalidaFormacion.idUser 
		    and date(drvEntrada.fechaHora) = date(drvSalidaFormacion.fechaHora) 
		    and drvEntrada.orden=drvSalidaFormacion.orden 
		    and date(drvSalidaFormacion.fechaHora)=vr3.diaEstudio
		
		
		left join estaciones_predeterminada_por_usuario e on drvEntrada.idUser = e.idUser 
		left join estacion es on es.codigo=e.codigoEstacion
		left join user u on u.id=drvEntrada.idUser
		where
		 	es.codigo in ($estaciones) 
			and date(drvEntrada.fechaHora) = vr3.diaEstudio
		order by es.codigo, u.nombre, u.apellidos, drvEntrada.fechaHora
EOT;
        


        $fichadas = \Yii::$app->db->createCommand($sql)->queryAll();
		
		return json_encode($fichadas);	
		
	}

	public function actionAjaxFichajesOld($dia)
	{
		if ($dia==='')
		{
			date_default_timezone_set ('Europe/Madrid');
			$dia = date('Y-m-d');
		}
		else {
			$dia = date('Y-m-d',strtotime($dia));
		}
		
		
		$estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->getCodigoEstacions()->asArray()->all(), 'codigo');
		$estaciones = implode('\',\'', $estaciones);
		$estaciones = '\'' . $estaciones . '\'';
		
		//$sql = "SELECT e.codigoEstacion, DATE_FORMAT(a.entrada,'%H:%i') entrada, DATE_FORMAT(a.salida,'%H:%i') salida,  sec_to_time(TIMESTAMPDIFF(minute, entrada, salida)*60) tiempo, u.id, u.nombre, u.apellidos FROM tickadas.listado_fichadas a inner join user u on a.idUser = u.id left join estaciones_predeterminada_por_usuario e on u.id = e.idUser where date(entrada)='".$dia."' order by e.codigoEstacion, entrada";
		
		//$sql = "SELECT e.codigoEstacion, DATE_FORMAT(a.entrada,'%H:%i') entrada, DATE_FORMAT(a.salida,'%H:%i') salida,  sec_to_time(TIMESTAMPDIFF(minute, entrada, salida)*60) tiempo, u.id, u.nombre, u.apellidos FROM tickadas.listado_fichadas a inner join user u on a.idUser = u.id left join estaciones_predeterminada_por_usuario e on u.id = e.idUser where date(entrada)='".$dia."' order by e.codigoEstacion, entrada";
        
        $sql ="SELECT e.codigoEstacion, es.nombre as nombreEstacion, DATE_FORMAT(a.entrada,'%H:%i') entrada, DATE_FORMAT(a.salida,'%H:%i') salida,  sec_to_time(TIMESTAMPDIFF(minute, entrada, salida)*60) tiempo, u.id, u.nombre, u.apellidos FROM user u left join estaciones_predeterminada_por_usuario e on u.id = e.idUser left join tickadas.listado_fichadas a on a.idUser = u.id left join estacion es on es.codigo=e.codigoEstacion where es.codigo in (".$estaciones.") and (date(entrada)='".$dia."' or entrada is null) and status = 10 order by e.codigoEstacion, entrada, u.apellidos";
        $fichadas = \Yii::$app->db->createCommand($sql)->queryAll();
		
		echo json_encode($fichadas);	
	}
	
	public function actionAjaxAlmuerzos($dia)
	{
		if ($dia==='')
		{
			date_default_timezone_set ('Europe/Madrid');
			$dia = date('Y-m-d');
		}
		else {
			$dia = date('Y-m-d',strtotime($dia));
		}
		
		$estaciones = ArrayHelper::getColumn(Yii::$app->user->identity->getCodigoEstacions()->asArray()->all(), 'codigo');
		$estaciones = implode('\',\'', $estaciones);
		$estaciones = '\'' . $estaciones . '\'';
		
		//$sql = "SELECT e.codigoEstacion, es.nombre as nombreEstacion, DATE_FORMAT(a.entrada,'%H:%i') entrada, DATE_FORMAT(a.salida,'%H:%i') salida,  sec_to_time(TIMESTAMPDIFF(minute, entrada, salida)*60) tiempo, u.id, u.nombre, u.apellidos FROM tickadas.listado_almuerzos a inner join user u on a.idUser = u.id left join estaciones_predeterminada_por_usuario e on u.id = e.idUser left join estacion es on es.codigo=e.codigoEstacion where  es.codigo in (".$estaciones.") and date(entrada)='".$dia."' order by e.codigoEstacion, entrada";
       $sql = <<<EOT
        	select
        	
        	e.codigoEstacion,
        	es.nombre as nombreEstacion, 
            date_format(drvEntradaAlmuerzo.fechaHora,'%H:%i') entrada,
             date_format(drvSalidaAlmuerzo.fechaHora,'%H:%i') salida,
             sec_to_time(TIMESTAMPDIFF(minute, drvEntradaAlmuerzo.fechaHora, drvSalidaAlmuerzo.fechaHora )*60) tiempo,
             u.id, 
		    u.nombre, 
		    u.apellidos
		from
		(
			select  @diaEstudio := date('$dia') as diaEstudio
		) vr3
		join 
		( 
			select @cnt:= case when @user <> idUser or @dia<>date(fechaHora)  then 1 else @cnt + 1 end as orden, @user := idUSer,fichajes.idUser, @dia:=date(fechaHora), fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes 
		    from fichajes 
		    join ( select @cnt := 0, @user := 0, @dia := date('1970-01-01') ) vr1
		    where fichajes.idAccion = 1 and date(fichajes.fechaHora) = @diaEstudio
		    order by idUser, fichajes.fechaHora 
		    
		) drvEntrada
		on date(drvEntrada.fechaHora) = vr3.diaEstudio
		left join 
		( 
			select @cnt2:= case when @user2 <> idUser or @dia2<>date(fechaHora)  then 1 else @cnt2 + 1 end as orden, @user2 := idUSer, @dia2:=date(fechaHora), fichajes.idUser, fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes
		    from fichajes 
		    join ( select @cnt2 := 0, @user2 := 0, @dia2 := date('1970-01-01') ) vr2
		    where fichajes.idAccion = 2   and date(fichajes.fechaHora) = @diaEstudio
		    order by idUser,fichajes.fechaHora
		    
		) drvSalida 
		on 
			drvEntrada.idUser = drvSalida.idUser 
		    and date(drvEntrada.fechaHora) = date(drvSalida.fechaHora) 
		    and drvEntrada.orden=drvSalida.orden 
		    and date(drvEntrada.fechaHora)=vr3.diaEstudio
		left join 
		( 
			select @cnt:= case when @user <> idUser or @dia<>date(fechaHora)  then 1 else @cnt + 1 end as orden, @user := idUSer,fichajes.idUser, @dia:=date(fechaHora), fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes
			from fichajes 
			join ( select @cnt := 0, @user := 0, @dia := date('1970-01-01') ) vr1
			where fichajes.idAccion = 3  and date(fichajes.fechaHora) = @diaEstudio
			order by idUser, fichajes.fechaHora 
		     
		) drvEntradaAlmuerzo
		on 
			drvEntrada.idUser = drvEntradaAlmuerzo.idUser 
		    and date(drvEntrada.fechaHora) = date(drvEntradaAlmuerzo.fechaHora) 
		    and drvEntrada.orden=drvEntradaAlmuerzo.orden 
		    and date(drvEntradaAlmuerzo.fechaHora)=vr3.diaEstudio
		left join 
		( 
			select @cnt2:= case when @user2 <> idUser or @dia2<>date(fechaHora)  then 1 else @cnt2 + 1 end as orden, @user2 := idUSer, @dia2:=date(fechaHora), fichajes.idUser, fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes
		    from fichajes 
		    join ( select @cnt2 := 0, @user2 := 0, @dia2 := date('1970-01-01') ) vr2
		    where fichajes.idAccion = 4   and date(fichajes.fechaHora) = @diaEstudio
		    order by idUser,fichajes.fechaHora
		  
		) drvSalidaAlmuerzo 
		on 
			drvEntrada.idUser = drvSalidaAlmuerzo.idUser 
		    and date(drvEntrada.fechaHora) = date(drvSalidaAlmuerzo.fechaHora) 
		    and drvEntrada.orden=drvSalidaAlmuerzo.orden 
		    and date(drvSalidaAlmuerzo.fechaHora)=vr3.diaEstudio
		left join 
		( 
			select @cnt:= case when @user <> idUser or @dia<>date(fechaHora)  then 1 else @cnt + 1 end as orden, @user := idUSer,fichajes.idUser, @dia:=date(fechaHora), fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes 
			from fichajes 
			join ( select @cnt := 0, @user := 0, @dia := date('1970-01-01') ) vr1
			where fichajes.idAccion = 6  and date(fichajes.fechaHora) = @diaEstudio
			order by idUser, fichajes.fechaHora 
		     
		) drvEntradaFormacion
		on 
			drvEntrada.idUser = drvEntradaFormacion.idUser 
		    and date(drvEntrada.fechaHora) = date(drvEntradaFormacion.fechaHora) 
		    and drvEntrada.orden=drvEntradaFormacion.orden 
		    and date(drvEntradaFormacion.fechaHora)=vr3.diaEstudio
		left join 
		( 
			select @cnt2:= case when @user2 <> idUser or @dia2<>date(fechaHora)  then 1 else @cnt2 + 1 end as orden, @user2 := idUSer, @dia2:=date(fechaHora), fichajes.idUser, fichajes.idAccion, fichajes.fechaHora, fichajes.idFichajes 
		    from fichajes 
		    join ( select @cnt2 := 0, @user2 := 0, @dia2 := date('1970-01-01') ) vr2
		    where fichajes.idAccion = 5   and date(fichajes.fechaHora) = @diaEstudio
		    order by idUser,fichajes.fechaHora
		  
		) drvSalidaFormacion 
		on 
			drvEntrada.idUser = drvSalidaFormacion.idUser 
		    and date(drvEntrada.fechaHora) = date(drvSalidaFormacion.fechaHora) 
		    and drvEntrada.orden=drvSalidaFormacion.orden 
		    and date(drvSalidaFormacion.fechaHora)=vr3.diaEstudio
		
		
		left join estaciones_predeterminada_por_usuario e on drvEntrada.idUser = e.idUser 
		left join estacion es on es.codigo=e.codigoEstacion
		left join user u on u.id=drvEntrada.idUser
		where
		 	es.codigo in ($estaciones) 
			and date(drvEntrada.fechaHora) = vr3.diaEstudio
			 and (drvEntradaAlmuerzo.fechaHora is not null and drvSalidaAlmuerzo.fechaHora is not null)
		order by es.codigo, u.nombre, u.apellidos, drvEntrada.fechaHora
EOT;
	    
	    $fichadas = \Yii::$app->db->createCommand($sql)->queryAll();
		
		 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		 return $fichadas;
		//Fichadas:
		//SELECT a.*,  sec_to_time(TIMESTAMPDIFF(minute, entrada, salida)*60) tiempo, u.nombre, u.apellidos FROM tickadas.listado_fichadas a inner join user u on a.idUser = u.id;
		
		//Almuerzos:
		//SELECT a.*,  TIMESTAMPDIFF(minute, entrada, salida) tiempoAlmuerzo, u.nombre, u.apellidos FROM tickadas.listado_almuerzos a inner join user u on a.idUser = u.id;
	}
	
	
	public function actionAjaxGraficaTrabajador($idUser, $anyo)
	{
		
		$tiempos = [];
		$sql = 'SELECT idUser, dia, tiempoTrabajando, tiempoAlmuerzo, tiempoOperativo from tiempos_trabajador_por_dia where year(dia)='.$anyo.' and idUser='.$idUser.' order by dia';
        $fichadas = \Yii::$app->db->createCommand($sql)->queryAll();
		foreach ($fichadas as $key => $value) {
			$dia = \DateTime::createFromFormat('Y-m-d',  $value['dia'])->format('Y-m-d 12:00 A');
			$tiempo = intval($value['tiempoOperativo']);
			array_push($tiempos, [$dia, $tiempo] );
		}
		echo json_encode([$tiempos]);	
	}
	
	public function actionAjaxHistoricoTrabajador($idUser, $anyo)
	{

		$sql = 'SELECT idUser, DATE_FORMAT(fechaHora,"%d-%M-%Y"), DATE_FORMAT(fechaHora,"%H:%i") from fichajes where year(fechaHora)='.$anyo.' and idUser='.$idUser.' order by dia';
        $fichadas = \Yii::$app->db->createCommand($sql)->queryAll();
		echo json_encode($fichadas);	
	}
}
