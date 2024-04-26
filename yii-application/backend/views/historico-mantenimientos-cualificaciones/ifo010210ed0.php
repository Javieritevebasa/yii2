<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $searchModel common\models\HistoricoMantenimientosCualificacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plan Supervisiones in situ Responsables Técnicos';
$this->params['breadcrumbs'][] = $this->title;

$formatter = \Yii::$app->formatter;
?>
<style>
	.caducado {background-color: #383838; color: #FFFFFF !important;}
	.proximoCaducar {background-color: #FFCC00; }
	.correcto {background-color: #165A1B; color: #83C999 !important;}
	.table-condensed{ font-size: 0.8em; }
	.table-condensed td{ white-space: nowrap;  overflow: hidden; text-overflow: ellipsis; white-space: nowrap;}
  	.idGrupo2, .idGrupo3{ color: #333333;}
  	.idGrupo4 { color: #333333;}
	table.table-fixedHeader tbody { display:block; max-height:450px; overflow-y:scroll; }
	table.table-fixedHeader thead, table tbody tr { display:table; width:100%; table-layout:fixed; }
	table.table-fixedHeader td {white-space: normal !important; text-align: center;}
	table.table-fixedHeader thead { width: calc(100% - 16px) !important;}
</style>

<div class="historico-mantenimientos-cualificaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <table class="table  table-bordered table-condensed table-fixedHeader" >
    	<thead>
		<tr>
			<th colspan="2"></th>
    		<th colspan="<?=count($cualificaciones)?>" class="text-center">PLAN DE SUPERVISIONES IN SITU A RESPONSABLES TÉCNICOS<span class="pull-right">Impreso IFO-01-02-10 Ed.0</span></th>
    	</tr>
    	<tr>
    		<th colspan="2"></th>
    		<th colspan="<?=count($cualificaciones)?>" class="text-center">CUALIFICACIONES POR CAMPOS DE ACTUACIÓN Y/O ESPECIALIDADES</th>
    	</tr>
    	<tr>
    		<th colspan="2"></th>
    		<th colspan="5" class="text-center">INSPECCIONES TÉCNICAS NO PERIÓDICAS</th>
    		<th  class="text-center">OTRAS ACTUACIONES</th>
    	</tr>    		
    	<tr>
    		<th width='0.5em'>Estación<input type="text" class="form-control input-sm inputSearch"></th>
    		<th width='3%'>Apellidos, nombre<input type="text" class="form-control input-sm inputSearch"></th>
    		<?php foreach ($cualificaciones as $key => $cualificacion) : ?>
				<th width='<?= 85/count($cualificaciones)?>%' style='vertical-align: middle; text-align: center !important'><?= ($cualificacion->id == 6 ? 'Reformas' : $cualificacion->nombre); ?></th>
				
			<?php endforeach ?>
    	</tr>
    	</thead>
    	<tbody>
	<?php foreach ($usuarios as $key => $usuario) : ?>
		<tr>
			<td><?= $usuario->estacion->nombre?></td>
			<td><?= Html::a($usuario->apellidos .', '.$usuario->nombre, ['user/view', 'id' => $usuario->id], ['class' => ''])?></td>
			
			
			<!--td>
				<ul class="list-group">
				<?php foreach ($usuario->idGrupos as $key => $grupo) : ?>
					<?php //if ($grupo->idGrupo == 2 || $grupo->idGrupo == 3 ||  $grupo->idGrupo == 4) :
						//Este if es si queremos que se muestren los supervisores y los responsables técnicos
						?>
					<?php if ($grupo->idGrupo == 2 ) :?>
							<li class="idGrupo<?= $grupo->idGrupo?>"><?= $grupo->nombre?></li>
					<?php endif; ?>
				<?php endforeach ?>
				</ul>
			</td-->
			<?php
				$userCualificaciones = [];
				
				if (count($usuario->estarEspecializado)>0)
					$userCualificaciones= ArrayHelper::merge($userCualificaciones, ArrayHelper::index($usuario->estarEspecializado, 'idEspecialidad'));
				
			?>
	
			<?php foreach ($cualificaciones as $key => $cualificacion) : ?>
			
					<?php 
						if (key_exists($cualificacion->id , $userCualificaciones)  ) : ?>
						<?php 
						$hoy = new \DateTime();
						$fecha = \DateTime::createFromFormat("Y-m-d", $userCualificaciones[$cualificacion->id]->fechaVencimiento);
						$dias = $hoy->diff($fecha, false);
						$dias = ($dias->invert == 1 ? -1 : 1) * $dias->days;
						$class = 'idGrupo'. $userCualificaciones[$cualificacion->id]->cualificadoComo.' ';
						
						if ($dias < 0 ) 		$class.='caducado';
						elseif ($dias <= 30) 	$class.='proximoCaducar';
						elseif ($dias > 30) 	$class.='correcto';	
						
						
						?>
						
						<td class="<?= $class ?>">
						<?= $formatter->asDate($userCualificaciones[$cualificacion->id]->fechaVencimiento, 'dd-MM-yyyy'); ?>
						</td> 
					<?php else :?>
						<td></td>
					<?php endif ?>
	
				
				
			<?php endforeach ?>
			
			
			
		</tr>
		
	<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="17" style="text-align:left !important;">
				<p>Distintivo Años desde última supervisión:</p>
				<ul>
					<li><span style= "width:30px; height:15px; display: inline-block" class="caducado"></span>&nbsp;> 1 año</li>
					<li><span style= "width:30px; height:15px; display: inline-block" class="proximoCaducar"></span>&nbsp;< 1 mes</li>
					<li><span style= "width:30px; height:15px; display: inline-block" class="correcto"></span>&nbsp;>1 mes <= 1 año</li>
				</ul>
								
			</td>
		</tr>
	</tfoot>
    </table>


</div>
<?php
$script = <<< JS
$(".inputSearch").keyup(function () {
    //split the current value of searchInput
    var pos = $(this).parent('th').index();
    
    var data = this.value;//.split(" ");
    //create a jquery object of the rows
    var jo = $("table tbody").find("tr");
    if (this.value == "") {
        jo.show();
        return;
    }
    //hide all the rows
    jo.hide();

    //Recusively filter the jquery object to get results.
    jo.filter(function (i, v) {
        var t = $(this);
        if (t.find("td:eq("+pos+")").is(":contains('" + data + "')")) {
                return true;
            }
        /*for (var d = 0; d < data.length; ++d) {
            if (t.find("td:eq("+pos+")").is(":contains('" + data[d] + "')")) {
                return true;
            }
        }*/
        return false;
    })
    //show the rows that match.
    .show();
}).focus(function () {
    this.value = "";
    $(this).css({
        "color": "black"
    });
    $(this).unbind('focus');
}).css({
    "color": "#C0C0C0"
});
JS;

$this->registerJs($script, View::POS_END);

?>
