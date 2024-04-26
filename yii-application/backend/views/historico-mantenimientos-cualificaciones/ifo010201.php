<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HistoricoMantenimientosCualificacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listado de personal cualificado';
$this->params['breadcrumbs'][] = $this->title;

$formatter = \Yii::$app->formatter;
?>
<style>
	.caducado {background-color: #383838; color: #FFFFFF !important; }
	.proximoCaducar {background-color: #FFCC00; }
	.correcto {background-color: #165A1B; color: #83C999 !important;}
	.table-condensed{ font-size: 0.8em; }
	.table-condensed td{ white-space: nowrap;  overflow: hidden; text-overflow: ellipsis; white-space: nowrap;}
  	.idGrupo2, .idGrupo3{ color: #333333;}
  	.idGrupo4 { color: #333333;}
	table.table-fixedHeader tbody { display:block; max-height:450px; overflow-y:scroll; }
	table.table-fixedHeader thead, table tbody tr { display:table;  width: 100%; table-layout:fixed; }
	table.table-fixedHeader td {white-space: normal !important; text-align: center;}
	table.table-fixedHeader thead { width: calc(100% - 16px) !important;}
</style>

<div class="historico-mantenimientos-cualificaciones-index container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <table class="table table-condensed table-bordered table-fixedHeader" >
    	<thead>
	    	<tr>
	    		<th colspan="4"></th>
	    		<th colspan="<?=count($cualificaciones)?>" class="text-center">LISTADO DE PERSONAL CUALIFICADO<span class="pull-right">Impreso IFO-01-02-01 Ed.2</span></th>
	    	</tr>
	    	<tr>
	    		<th colspan="4"></th>
	    		<th colspan="<?=count($cualificaciones)?>" class="text-center">CUALIFICACIONES POR CAMPOS DE ACTUACIÓN Y/O ESPECIALIDADES</th>
	    	</tr>
	    	<tr>
	    		<th colspan="4"></th>
	    		<th colspan="5" class="text-center">INSPECCIONES TÉCNICAS PERIÓDICAS</th>
	    		<th colspan="6" class="text-center">INSPECCIONES TÉCNICAS NO PERIÓDICAS</th>
	    		<th colspan="<?=count($cualificaciones)-11?>" class="text-center">OTRAS ACTUACIONES</th>
	    	</tr>
	
	    	<tr>
	    		<th width='0.5em'>Estación<input type="text" class="form-control input-sm inputSearch"></th>
    			<th width='3%'>Apellidos, nombre<input type="text" class="form-control input-sm inputSearch"></th>
    			<th width='2%'>Cód. Insp.<input type="text" class="form-control input-sm inputSearch"></th>
    			<th width='2%'>Puestos<input type="text" class="form-control input-sm inputSearch"></th>
	    		<?php foreach ($cualificaciones as $key => $cualificacion) : ?>
					<th><?= $cualificacion->nombre; ?></th>
				<?php endforeach ?>
	    	</tr>
    	</thead>
    	<tbody>
	<?php foreach ($usuarios as $key => $usuario) : ?>
		<tr>
			<td><?= $usuario->estacion->nombre?></td>
			<td><?= Html::a($usuario->apellidos .', '.$usuario->nombre, ['user/view', 'id' => $usuario->id], ['class' => ''])?></td>
			<td><?= $usuario->codigoInspector?></td>
			
			<td>
				<ul class="list-group">
				<?php foreach ($usuario->idGrupos as $key => $grupo) : ?>
					<?php if ($grupo->idGrupo == 2) :?>
							<li><?= $grupo->nombre?></li>
					<?php endif; ?>
				<?php endforeach ?>
				</ul>
			</td>
			<?php
				$userCualificaciones = [];
				if (count($usuario->estarCualificado) > 0){
					
					$userCualificaciones = ArrayHelper::index($usuario->estarCualificado, 'idGrupoCategorias');
					
					if (count($usuario->estarEspecializado)>0)
					{
						 
						 	
						$userCualificaciones= ArrayHelper::merge($userCualificaciones, ArrayHelper::index($usuario->estarEspecializado, 'idEspecialidad'));
						//print_r(ArrayHelper::index($usuario->estarEspecializado,'apto')[1]);
						//$userCualificaciones= ArrayHelper::merge($userCualificaciones, ArrayHelper::index(ArrayHelper::index($usuario->estarEspecializado,'apto')[1], 'idEspecialidad'));
					}
				}
			?>
			<?php foreach ($cualificaciones as $key => $cualificacion) : ?>
				
					<?php if (key_exists($cualificacion->id , $userCualificaciones) ) : ?>
						<?php 
						$hoy = new \DateTime();
						$fecha = \DateTime::createFromFormat("Y-m-d", $userCualificaciones[$cualificacion->id]->fechaPrimeraCualificacion);
						?>
						<?php if (!$userCualificaciones[$cualificacion->id]->apto): ?>
							<td  class="text-center"><span class="glyphicon glyphicon-thumbs-down"></span></td> 
						
							<?php else: ?>
								<?php
								
								?>
							<td class="text-center">
							<?= $formatter->asDate($userCualificaciones[$cualificacion->id]->fechaPrimeraCualificacion, 'dd-MM-yyyy'); ?>
							</td> 
						<?php endif; ?>
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
				<p>M2/M3:  Incluido transporte escolar y de menores en inspecciones periódicas. La escolar de M1 la hará un inspector cualificado para escolar M2/M3.</p>
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
