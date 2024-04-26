<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\ArrayHelper;

use backend\assets\JqWidgetsAsset;
JqWidgetsAsset::register($this);

$this->title = 'Gran Ojo';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
	.hidden
	{
		display: hidden;
	}
	#main {
		min-height: 100% !important;
    	height: auto !important;
	}
	.jqx-pivotgrid-item
	{
		height:20px !important;
		
	} 
	.jqx-pivotgrid-expand-button
	{
		padding-right:17px !important;
	}
	.jqx-pivotgrid-collapse-button
	{
		padding-right:17px !important;
	}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-2">
			<label for="fechaDesde">Fecha desde<input type="date" class="form-control input-sm" id="fechaDesde" name="fechaDesde" value='2019-01-01'/></label>
		</div>
		<div class="col-xs-2">
			<label for="fechaHasta">Fecha hasta<input type="date" class="form-control input-sm" id="fechaHasta" name="fechaHasta"  value='2019-01-31'/></label>
		</div>
		<div class="col-xs-2">
			<label for="estacionesITV">Estación
			<?= Html::dropDownList('estacionesITV[]',null, ArrayHelper::map($estaciones,'codigo','nombre'), ['class' => 'form-control input-sm', ]); ?>
			</label>
		</div>
		<div class="col-xs-2">
			<button name="cargarDatos" class="btn btn-default">Cargar</button>
		</div>
		
	</div>
	<hr>
	
	<div class="row" style="">          
		 <div id="PivotGrid"  style="height: 400px; width: 100%; background-color: white;"></div>
	</div>
</div>




<?php


$todasEstaciones = json_encode($todasEstaciones);


$script=<<<EOT
	var todasEstaciones = $todasEstaciones;
	
	$(document).on('click','button[name="cargarDatos"]', function(){
		var estaciones = $('select[name="estacionesITV[]"]').val();
		cargarDatos('#PivotGrid');
		
	});
	
	$(document).ready(function(){
		$('#PivotGrid').css("height", $('.wrap').prop('scrollHeight')-$('#PivotGrid').offset().top - 44);
	});
	
	function cargarDatos(selector)
	{

		
		var sql = `SELECT 	count(inspecciones.InformeMecanica) as Total	
				,sum(CASE		WHEN inspecciones.ResultadoInspeccion in (1,2) THEN 1		WHEN inspecciones.ResultadoInspeccion in (3,4) THEN 0		ELSE 0		END) as Favorables	
				,sum(CASE	    WHEN inspecciones.ResultadoInspeccion in (1,2) THEN 0	    WHEN inspecciones.ResultadoInspeccion in (3,4) THEN 1	    ELSE 0		END) as Desfavorables	
				,inspecciones.TipoInspeccion	
				,d_estaciones.codigo estacion
				,d_estaciones.comunidad
				,d_categorias.codigo
				,d_categorias.subcategoria
				,d_categorias.categoria
				,sum(drtTblDefectos._0101) cu0101,sum(drtTblDefectos._0102) cu0102,sum(drtTblDefectos._0103) cu0103,sum(drtTblDefectos._0181) cu0181
				,sum(drtTblDefectos._0201) _0201,sum(drtTblDefectos._0202) _0202,sum(drtTblDefectos._0203) _0203,sum(drtTblDefectos._0204) _0204,sum(drtTblDefectos._0205) _0205,sum(drtTblDefectos._0206) _0206,sum(drtTblDefectos._0207) _0207,sum(drtTblDefectos._0208) _0208,sum(drtTblDefectos._0209) _0209,sum(drtTblDefectos._0210) _0210,sum(drtTblDefectos._0211) _0211,sum(drtTblDefectos._0212) _0212,sum(drtTblDefectos._0213) _0213
				,sum(drtTblDefectos._0301) _0301,sum(drtTblDefectos._0302) _0302,sum(drtTblDefectos._0303) _0303,sum(drtTblDefectos._0304) _0304,sum(drtTblDefectos._0305) _0305,sum(drtTblDefectos._0306) _0306,sum(drtTblDefectos._0307) _0307,sum(drtTblDefectos._0308) _0308,sum(drtTblDefectos._0309) _0309,sum(drtTblDefectos._0310) _0310,sum(drtTblDefectos._0311) _0311
				,sum(drtTblDefectos._0401) _0401,sum(drtTblDefectos._0402) _0402,sum(drtTblDefectos._0403) _0403,sum(drtTblDefectos._0404) _0404,sum(drtTblDefectos._0405) _0405,sum(drtTblDefectos._0406) _0406,sum(drtTblDefectos._0407) _0407,sum(drtTblDefectos._0408) _0408,sum(drtTblDefectos._0409) _0409,sum(drtTblDefectos._0410) _0410,sum(drtTblDefectos._0411) _0411,sum(drtTblDefectos._0412) _0412,sum(drtTblDefectos._0413) _0413,sum(drtTblDefectos._0414) _0414,sum(drtTblDefectos._0415) _0415,sum(drtTblDefectos._0416) _0416
				,sum(drtTblDefectos._0501) _0501,sum(drtTblDefectos._0502) _0502,sum(drtTblDefectos._0503) _0503
				,sum(drtTblDefectos._0601) _0601,sum(drtTblDefectos._0602) _0602,sum(drtTblDefectos._0603) _0603,sum(drtTblDefectos._0604) _0604,sum(drtTblDefectos._0605) _0605,sum(drtTblDefectos._0606) _0606,sum(drtTblDefectos._0607) _0607,sum(drtTblDefectos._0608) _0608,sum(drtTblDefectos._0609) _0609,sum(drtTblDefectos._0610) _0610,sum(drtTblDefectos._0611) _0611,sum(drtTblDefectos._0612) _0612,sum(drtTblDefectos._0613) _0613,sum(drtTblDefectos._0614) _0614,sum(drtTblDefectos._0615) _0615,sum(drtTblDefectos._0616) _0616,sum(drtTblDefectos._0617) _0617,sum(drtTblDefectos._0618) _0618,sum(drtTblDefectos._0619) _0619,sum(drtTblDefectos._0620) _0620,sum(drtTblDefectos._0621) _0621,sum(drtTblDefectos._0622) _0622
				,sum(drtTblDefectos._0701) _0701,sum(drtTblDefectos._0702) _0702,sum(drtTblDefectos._0703) _0703,sum(drtTblDefectos._0704) _0704,sum(drtTblDefectos._0705) _0705
				,sum(drtTblDefectos._0801) _0801,sum(drtTblDefectos._0802) _0802,sum(drtTblDefectos._0803) _0803,sum(drtTblDefectos._0804) _0804
				,sum(drtTblDefectos._0901) _0901,sum(drtTblDefectos._0902) _0902,sum(drtTblDefectos._0903) _0903,sum(drtTblDefectos._0904) _0904,sum(drtTblDefectos._0905) _0905
				,sum(drtTblDefectos._1001) _1001,sum(drtTblDefectos._1002) _1002,sum(drtTblDefectos._1003) _1003,sum(drtTblDefectos._1004) _1004,sum(drtTblDefectos._1005) _1005,sum(drtTblDefectos._1006) _1006,sum(drtTblDefectos._1082) _1082
				,sum(drtTblDefectos._1101) _1101
				from inspecciones 
				left join d_estaciones on d_estaciones.codigo=inspecciones.Estacion   
				left join 
				(
					select 
				  Anyo
				, Estacion
				, informeMecanica
					,sum(CASE  WHEN defectos.Capitulo='01' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0101',sum(CASE  WHEN defectos.Capitulo='01' and defectos.Unidad = '02' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0102',sum(CASE  WHEN defectos.Capitulo='01' and defectos.Unidad = '03' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0103',sum(CASE  WHEN defectos.Capitulo='01' and defectos.Unidad = '81' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0181'
					,sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0201',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '02' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0202',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '03' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0203',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '04' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0204',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '05' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0205',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '06' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0206',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '07' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0207',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '08' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0208',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '09' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0209',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '10' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0210',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '11' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0211',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '12' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0212',sum(CASE  WHEN defectos.Capitulo='02' and defectos.Unidad = '13' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0213'
					,sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0301',sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '02' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0302',sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '03' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0303',sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '04' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0304',sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '05' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0305',sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '06' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0306',sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '07' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0307',sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '08' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0308',sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '09' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0309',sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '10' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0310',sum(CASE  WHEN defectos.Capitulo='03' and defectos.Unidad = '11' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0311'
					,sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0401',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '02' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0402',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '03' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0403',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '04' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0404',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '05' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0405',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '06' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0406',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '07' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0407',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '08' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0408',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '09' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0409',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '10' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0410',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '11' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0411',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '12' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0412',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '13' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0413',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '14' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0414',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '15' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0415',sum(CASE  WHEN defectos.Capitulo='04' and defectos.Unidad = '16' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0416'
					,sum(CASE  WHEN defectos.Capitulo='05' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0501',sum(CASE  WHEN defectos.Capitulo='05' and defectos.Unidad = '02' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0502',sum(CASE  WHEN defectos.Capitulo='05' and defectos.Unidad = '03' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0503'
					,sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0601',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '02' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0602',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '03' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0603',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '04' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0604',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '05' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0605',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '06' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0606',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '07' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0607',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '08' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0608',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '09' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0609',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '10' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0610',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '11' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0611',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '12' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0612',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '13' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0613',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '14' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0614',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '15' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0615',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '16' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0616',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '17' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0617',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '18' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0618',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '19' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0619',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '20' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0620',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '21' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0621',sum(CASE  WHEN defectos.Capitulo='06' and defectos.Unidad = '22' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0622'
					,sum(CASE  WHEN defectos.Capitulo='07' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0701',sum(CASE  WHEN defectos.Capitulo='07' and defectos.Unidad = '02' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0702',sum(CASE  WHEN defectos.Capitulo='07' and defectos.Unidad = '03' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0703',sum(CASE  WHEN defectos.Capitulo='07' and defectos.Unidad = '04' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0704',sum(CASE  WHEN defectos.Capitulo='07' and defectos.Unidad = '05' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0705'
					,sum(CASE  WHEN defectos.Capitulo='08' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0801',sum(CASE  WHEN defectos.Capitulo='08' and defectos.Unidad = '02' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0802',sum(CASE  WHEN defectos.Capitulo='08' and defectos.Unidad = '03' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0803',sum(CASE  WHEN defectos.Capitulo='08' and defectos.Unidad = '04' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0804'
					,sum(CASE  WHEN defectos.Capitulo='09' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0901',sum(CASE  WHEN defectos.Capitulo='09' and defectos.Unidad = '02' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0902',sum(CASE  WHEN defectos.Capitulo='09' and defectos.Unidad = '03' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0903',sum(CASE  WHEN defectos.Capitulo='09' and defectos.Unidad = '04' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0904',sum(CASE  WHEN defectos.Capitulo='09' and defectos.Unidad = '05' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_0905'
					,sum(CASE  WHEN defectos.Capitulo='10' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_1001',sum(CASE  WHEN defectos.Capitulo='10' and defectos.Unidad = '02' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_1002',sum(CASE  WHEN defectos.Capitulo='10' and defectos.Unidad = '03' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_1003',sum(CASE  WHEN defectos.Capitulo='10' and defectos.Unidad = '04' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_1004',sum(CASE  WHEN defectos.Capitulo='10' and defectos.Unidad = '05' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_1005',sum(CASE  WHEN defectos.Capitulo='10' and defectos.Unidad = '06' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_1006',sum(CASE  WHEN defectos.Capitulo='10' and defectos.Unidad = '82' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_1082'
					,sum(CASE  WHEN defectos.Capitulo='11' and defectos.Unidad = '01' and defectos.Gravedad in ('G') THEN 1 ELSE 0  END) as '_1101'
				from defectos 
				
				where  (anyo = :anyoDesde or anyo = :anyoHasta)     
				group by Anyo, Estacion, informeMecanica
				) 
				drtTblDefectos on inspecciones.Anyo = drtTblDefectos.Anyo and inspecciones.Estacion = drtTblDefectos.Estacion and inspecciones.InformeMecanica = drtTblDefectos.InformeMecanica
				left join d_categorias on inspecciones.Categoria = d_categorias.codigo
				where
				         (inspecciones.anyo = :anyoDesde or inspecciones.anyo = :anyoHasta)         
				         and inspecciones.faseInspeccion = :faseInspeccion    	
				         and STR_TO_DATE(inspecciones.FechaInspeccion, '%d%m%Y') between :fechaDesde AND :fechaHasta 		
				         and inspecciones.tipoInspeccion = :tipoInspeccion
				group by        
						 inspecciones.TipoInspeccion
				         ,d_estaciones.codigo 
				         ,d_estaciones.comunidad
				         ,d_categorias.codigo
						,d_categorias.subcategoria
						,d_categorias.categoria
				         
				order by Total desc`;
		
		
		var parametros = {
				':anyoDesde' :  (new Date($('input[name="fechaDesde"]').val())).getFullYear(),
				':anyoHasta' : (new Date($('input[name="fechaHasta"]').val())).getFullYear(),
				':fechaDesde' : $('input[name="fechaDesde"]').val(),
				':fechaHasta' : $('input[name="fechaHasta"]').val(),
				
				':faseInspeccion': '1',
				':tipoInspeccion' : '001',
		};
		$.ajax({
				url: 'index.php?r=gran-ojo/json-sql-post',
				type: 'post',
				data: {
					 'sql' : sql
					 ,'parametros' : JSON.stringify( parametros )
					 //,'debug' : true  
					},
					
				success: function (data) {
					
					datos = $.parseJSON(data) ;
					cargarGrid(selector, datos);
					
				},
				error:function (data) {
					console.log('Incio errores');
					console.log(data);
					console.log('Fin errores');
					return false;
				}	
			});		
	}
	
	
	function cargarGrid(selector, datos){
		/*TotalInspeccionesComputadas = 0;
		TotalFavorablesComputadas = 0;
		TotalDesfavorablesComputadas = 0;
		
		datosPonderados = [];
		$.each(datos, function(index, item){
			item['root'] = 'Todos los servicios';
			item['ponderado'] = 0;
			TotalInspeccionesComputadas += parseInt(item['Total']);
			TotalFavorablesComputadas += parseInt(item['Favorables']);
			TotalDesfavorablesComputadas += parseInt(item['Desfavorables']);
			
			$.each(serviciosPonderados, function(index, s) {
				if (s['nombre'] == item['nombre'] //cualificacion
					&& s['codigoServicioUnificado'] == item['servicioUnificado']
					&& s['faseInspeccion'] == item['faseInspeccion']
					)
					{
						item['ponderado'] = parseInt(item['Total']) * parseFloat(s['ponderacion']);	
						item['servicio'] = s['descripcionServicioUnificado'] ;	
						return false;							}
					});
						
				if (item['servicio'] == undefined)
					console.log (item);
						
				item['inspectorNombre'] = inspectores[item['CodigoInspector']];
				item['rechazo'] = parseInt(item['Desfavorables']) * 100 / parseInt(item['Total']);
				datosPonderados.push(item);
			});
			
			
			$('#rechazoEstacion').text( ((TotalDesfavorablesComputadas/TotalInspeccionesComputadas) * 100).toFixed(2) );
			*/
			
			
			var source =
			{
			   localdata: datos,
			   datatype: "array",
			   datafields:
			   [
			   	  { name: 'root', type: 'string' },
			      { name: 'Total', type: 'number' },			//Cantidad total de inspecciones en el perioodo dado
			      { name: 'Favorables', type: 'number' },		//Cantidad de inspecciones favorables en el periódo dado
			      { name: 'Desfavorables', type: 'number' },	//Cantidad de inspecciones desfavorables en el periodo dado
			      { name: 'estacion', type: 'string' },			//Código estación
			      { name: 'comunidad', type: 'string' },		//Comunidad autónoma de la estación
			      { name: 'codigo', type: 'string' }, 			//Categoría del vehículo
			      { name: 'subcategoria', type: 'string' },		//Nivel 2 de agrupamiento de la categoría
			      { name: 'categoria', type: 'string' },		//Nivel 3 de agrupamiento de la categoría
			      { name: 'cu0101', type: 'number' },			//Número de defectos en el Capítulo-apartado
			      { name: 'cu0102', type: 'number' },			//Número de defectos en el Capítulo-apartado
			      { name: 'cu0103', type: 'number' },			//Número de defectos en el Capítulo-apartado
			      { name: 'cu0181', type: 'number' },			//Número de defectos en el Capítulo-apartado
			      //{ name: 'valorEconomico', type: 'number' },
			   ]
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			dataAdapter.dataBind();
				
			var pivotDataSource = new $.jqx.pivot(
			   dataAdapter,
			   {
			   	 customAggregationFunctions: {
			   	 	'indiceRechazo' : function (values) {
                           return 0;
                        }
			   	 },
				 pivotValuesOnRows: false,
				 totals: {rows: {subtotals: true, grandtotals: true}, columns: {subtotals: false, grandtotals: true}},
                    
				 columns: [{ dataField: 'comunidad'}, { dataField: 'estacion'}, ],
				 rows: [ { dataField: 'categoria'},{ dataField: 'subcategoria'}, { dataField: 'codigo'}, ],
					    
					     values: [
					       { dataField: 'Total', 'function' : 'sum', text: 'Inspecciones'},
					       { dataField: 'Favorables', 'function' : 'sum', text: 'Favorables' },
						   { dataField: 'Desfavorables', 'function' : 'sum', text: 'Desfavorables' },
						   
					     ]
					   }
					);
	  
	  				$(selector).jqxPivotGrid(
					   {
					   	  
					      source: pivotDataSource,
					      treeStyleRows: false,
					      multipleSelectionEnabled: true,
					      
					   }
					);
		
		
	}
	
	
	
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>