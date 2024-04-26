<?php

use yii\helpers\Html;
use yii\grid\GridView;

echo 'llega';
?>

	
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}",
        'emptyText'=> false,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [
            'FechaProximaInspeccion',
            'UltimaInspeccion',
            'Estacion',
            'Matricula',
            'FaseInspeccion',
            'Categoria',
            'TipoVehiculo',
            'Marca',
            'Propietario',
            'Municipio',
            'Telefono1',
            'Telefono2',
            [
            	'label' => 'CITA',
            	'value' => null
            ],
            [
            	'label' => 'Vendra',
            	
            ],
            [
            	'label' => 'Baja/Vendido',
            	'value' => ''
            ],
            [
            	'label' => 'Pasado',
            	'value' => ''
            ],
            [
            	'label' => 'Error',
            	'value' => ''
            ],
            [
            	'label' => 'Sin teléfono',
            	'value' => ''
            ],
            [
            	'label' => 'Observaciones',
            	'value' => ''
            ]
        ],
    ]); ?>