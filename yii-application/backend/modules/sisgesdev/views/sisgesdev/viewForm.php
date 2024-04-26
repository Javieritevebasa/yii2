<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $origen backend\modules\sisgesdev\models\Origen */

$this->title = 'Expediente '.$origen->numeroExpediente;
$this->params['breadcrumbs'][] = ['label' => 'Origens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['origen/update', 'id' => $origen->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['origen/delete', 'id' => $origen->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        
       
    </p>

    <?= DetailView::widget([
        'model' => $origen,
         'formatter' => [
            'class' => '\yii\i18n\Formatter',
            'dateFormat' => 'dd/MM/yyyy',
            'datetimeFormat' => 'dd/MM/yyyy HH:mm::ss',
        ],
        'attributes' => [
            'id',
            'numeroExpediente',
            [
            	'attribute' => 'tipoOrigen',
            	'value' =>  $origen->tipoOrigen0->nombre,
            ],
            [
            	'attribute' => 'fecha',
            	'format' => 'date',
            ],
            [
            	'attribute' => 'fechaLimite',
            	'format' => 'date',
            ],
            
            [
            	'attribute' => 'descripcion',
            	'format' => 'html', 
            ],
            [
            	'attribute' => 'creadoPor',
            	'value' => $origen->creadoPor0->nombre. ' '. $origen->creadoPor0->apellidos
            ],
             [
            	'attribute' => 'validadoPor',
            	'value' => $origen->validadoPor0->nombre. ' '. $origen->validadoPor0->apellidos
            ],
          /*  [
            	'attribute' => 'fechaValidacion',
            	'format' => 'date',
            ],*/
        ],
    ]) ?>
   
    <?php try{ ?>
    <?= Yii::$app->runAction('sisgesdev/sisgesdev/listar-desviaciones', ['origen' => $origen->id, 'layout' => false]); ?>
    <?php }catch(\Exception $ex) { echo $ex->getMessage(). $ex->getTraceAsString ( ) ;
	} ?>

</div>
