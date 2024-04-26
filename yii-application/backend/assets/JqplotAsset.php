<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
 
namespace app\assets;
 
use yii\web\AssetBundle;
 
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class JqplotAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [	'css/jquery.jqplot.min.css',
    ];
    public $js = [
        'js/excanvas.js',
        'js/jquery.jqplot.min.js',
        'js/jqplot.pieRenderer.js',
        'js/jqplot.barRenderer.js',
        'js/jqplot.categoryAxisRenderer.js',
        'js/jqplot.pointLabels.js',
        'js/jqplot.dateAxisRenderer.js',

    ];
    public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];
}