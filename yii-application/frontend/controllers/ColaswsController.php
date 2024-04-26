<?php
namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;

class ColaswsController extends ActiveController
{
	
 	public $modelClass = 'frontend\models\Colas';
	
	public function behaviors()
    {
        return [
        	'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'avisar' => ['POST'],
                ],
            ],
        ];
    }
	
	public function index()
	{}
	
	public function actionVehiculosEnCola($estacion)
	{
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
       $sql = <<<EOT
        	select * from tiempos where estacion = $estacion and horaRegistro between curdate() and now() and horaFinInspeccion is null and enLinea=1 order by horaRegistro;
EOT;
     
	 
		
		$enCola = \Yii::$app->tiemposEspera->createCommand($sql)->queryAll();

       $sql = <<<EOT
        	select
        	case when inspectoresOciosos.estacion is null then e.codigoEstacion else inspectoresOciosos.estacion end Estacion,
        	linea,
        	servicio,
        	drvEntrada.idUser,
        	concat(u.nombre, ' ', u.apellidos) nombre,
		    u.codigoInspector,
		    inspectoresOcupados.IniciadaInspeccion,
            inspectoresOciosos.UltimaInspeccion as OciosoDesde,
            case when inspectoresOcupados.IniciadaInspeccion is null then  timediff(current_time(), time(inspectoresOciosos.UltimaInspeccion)) else '00:00:00' end 'TiempoParado'
            #case when inspectoresOcupados.IniciadaInspeccion is not null then  timediff( time(inspectoresOcupados.IniciadaInspeccion), time(inspectoresOciosos.UltimaInspeccion)) else '00:00:00' end
		from
		(
			select  @diaEstudio := curdate() as diaEstudio
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
        inner join (select idUser, idGrupo from pertenecer where idGrupo=2 and idUser not in (select idUser from pertenecer where idGrupo in (4,5)) ) p on p.idUser = u.id
        left  join (select max(horaInicioInspeccion) IniciadaInspeccion, codigoInspector, estacion, linea, servicio from tiemposEspera.tiempos where horaRegistro between curdate() and now() and horaInicioInspeccion is not null and horaFinInspeccion is null group by codigoInspector) inspectoresOcupados on u.codigoInspector = inspectoresOcupados.codigoInspector
        left  join (select max(horaFinInspeccion) UltimaInspeccion, codigoInspector, estacion from tiemposEspera.tiempos where horaRegistro between curdate() and now() and horaInicioInspeccion is not null and horaFinInspeccion is not null group by codigoInspector) inspectoresOciosos on u.codigoInspector = inspectoresOciosos.codigoInspector
		where
			 date(drvEntrada.fechaHora) = vr3.diaEstudio
             and time(drvSalida.fechaHora) is null
             and ((drvEntradaAlmuerzo.fechaHora is not null and drvSalidaAlmuerzo.fechaHora is not null) or ((drvEntradaAlmuerzo.fechaHora is null and drvSalidaAlmuerzo.fechaHora is  null)))
             and idGrupo = 2 
             and (inspectoresOciosos.estacion = '$estacion')
		order by 
			case 
				when inspectoresOciosos.estacion is null then e.codigoEstacion 
				else inspectoresOciosos.estacion end,
                u.nombre, u.apellidos, drvEntrada.fechaHora
EOT;
		
		$inspectoresEstacion = \Yii::$app->db->createCommand($sql)->queryAll();
		
		$colas = ['enCola' => $enCola, 'inspectoresEstacion' => $inspectoresEstacion];
		return $this->asJson($colas);
	}
}