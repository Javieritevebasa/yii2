<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    	'js/views/dashboard/charDatosEconomicos.js',
    	'js/views/dashboard/charDatosEconomicosEstacion.js',
    	'js/views/dashboard/charInspectoresActivos.js',
    	'js/svgPanZoom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
