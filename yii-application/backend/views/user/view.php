<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Tarjeta', ['imprimir-codigo-barras', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php 
        	$grupos= [];
    	foreach ($model->idGrupos as $key => $value) {
		 	array_push($grupos, $value->idGrupo);
		}
		
        	if (count(array_intersect([2, 3], $grupos))>0) : ?>
       			<?= Html::a('IFO 01-02-03', ['impreso-ifo010203', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        	<?php endif; ?>
        <?= Html::a('Formación', ['obtener-formacion', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Control Tiempos', ['fichaje/estadistica-trabajador', 'usuario' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Enviar certificado', ['enviar-certificado', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Establecer certificado de estación', ['enviar-certificado-estacion', 'id' => $model->id], 
        		['class' => 'btn btn-primary',
        		'data' => [
                'confirm' => '¿Está seguro que quiere establecer éste certificado como el de firma de informes en una estación?',
                //'method' => 'get',
            ],
        ]) ?>
        
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        	[
        		'attribute' => 'foto',
        		'value' => 'data:image/png;base64,'.base64_encode(  $model->foto ),
        		'format' => ['image',['width'=>'100',]],
        		
        	],
            'id',
            'codigoInspector',
            'username',
            //'auth_key',
            //'password_hash',
            'dni',
            'email:email',
            'nombre',
            'apellidos',
            'movil',
            'movilPersonal',
            ['attribute' => 'status0.descripcion', 'label'=>'Estado'],
     
        ],
    ]) ?>
    
    <h3>Categorías
    <div class="btn-toolbar pull-right">
    <?= Html::a('Nuevo seguimiento cualificación periódicas', ['historico-mantenimientos-cualificaciones/create', 'idUser' => $model->id], ['class' => 'btn btn-primary btn-xs']) ?>
    </div>
    </h3>  
    <table class="table">
    	<tr>
    	<th></th>
    	<th width="30%">Especialidad</th>
    	<th width="20%">Como</th>
    	<th width="20%">Cualificado desde</th>
    	<th width="20%">Última evaluación mantenimiento</th>
    	<th width="20%">Evaluación válida hasta</th>
    	<th width="10%">Apto</th>
    	</tr>
    <?php 
    $dataProvider = new ActiveDataProvider([ 'query' => $model->getEstarCualificado(), ]);
    echo  ListView::widget([
	    'dataProvider' => $dataProvider,
	    'itemView' => '_viewCualificaciones',
	    'summary'=>'',
		]); 
    ?>
    </table>
    
    <h3>Especilidades
    	<div class="btn-toolbar pull-right">
    	<?= Html::a('Nuevo seguimiento cualificación no periódicas', ['historico-mantenimientos-cualificaciones/create', 'idUser' => $model->id, 'especialidad' => 1], ['class' => 'btn btn-primary btn-xs']) ?>
    	</div>
    </h3> 
    <table class="table">
    	<tr>
    	<th></th>
    	<th width="30%">Especialidad</th>
    	<th width="20%">Como</th>
    	<th width="20%">Cualificado desde</th>
    	<th width="20%">Última evaluación mantenimiento</th>
    	<th width="20%">Evaluación válida hasta</th>
    	<th width="10%">Apto</th>
    	</tr>
    <?php 
    $dataProvider = new ActiveDataProvider([ 'query' => $model->getEstarEspecializado()->innerJoin('cualificaciones c','c.id=idEspecialidad')/*->where('c.activo=true')*/, ]);
    echo  ListView::widget([
	    'dataProvider' => $dataProvider,
	    'itemView' => '_viewEspecialidades',
	    'summary'=>'',
		]); 
    ?>
    </table>

</div>
