<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class JqWidgetsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/jqwidgets/styles/jqx.base.css',
       'js/jqwidgets/styles/jqx.light.css',
    ];
    public $js = [
    	'js/jqwidgets/jqxcore.js',
		'js/jqwidgets/jqxdata.js',
		'js/jqwidgets/jqxdata.export.js',
		
		'js/jqwidgets/jqxscrollbar.js',
		'js/jqwidgets/jqxmenu.js',
		
		
		'js/jqwidgets/jqxeditor.js',
		'js/jqwidgets/jqxbuttons.js',
		'js/jqwidgets/jqxlistbox.js',
		'js/jqwidgets/jqxdropdownlist.js',
		'js/jqwidgets/jqxdropdownbutton.js',
		'js/jqwidgets/jqxcolorpicker.js',
		'js/jqwidgets/jqxwindow.js',
		'js/jqwidgets/jqxtooltip.js',
		'js/jqwidgets/jqxcheckbox.js',
		
		'js/jqwidgets/jqxgauge.js',
		
		'js/jqwidgets/jqxpivot.js',
		'js/jqwidgets/jqxpivotgrid.js',
		
		'js/jqwidgets/jqxdraw.js',
		'js/jqwidgets/jqxchart.core.js',
		 
		 'js/jqwidgets/jqxgrid.js',
		 'js/jqwidgets/jqxgrid.selection.js',
		 'js/jqwidgets/jqxgrid.pager.js',
		 'js/jqwidgets/jqxgrid.edit.js',
		 'js/jqwidgets/jqxlistbox.js',
		 'js/jqwidgets/jqxdropdownlist.js',
		 'js/jqwidgets/jqxgrid.columnsresize.js',
		 'js/jqwidgets/jqxgrid.export.js',
		 'js/jqwidgets/jqxexport.js', 
		 'js/jqwidgets/jqxgrid.sort.js', 
		 
 
		 'js/jqwidgets/jqxbargauge.js',
		 'js/jqwidgets/jqxbulletchart.js',
		 'js/jqwidgets/jqxtooltip.js',
		 
		 
		 
		 'js/papaparse.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
       
    ];
}
