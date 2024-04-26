<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
    
    <style>
    body {font-size: 0.9em !important;}
    h3 {font-size:1.3em !important;}
    h2 {font-size: 1.4em !important;}
	@page
	{
		size: A4;
 		margin: 10mm;
 		
	}

	@media print
	{ 
		html, body
		{
			_idth: 210mm;
			_eight: 297mm;
			
		}
		
		.no-print, .no-print *
	    {
	        display: none !important;
	    }
		
	}
	</style>

</head>
<body onload="window.print()">
<?php $this->beginBody() ?>

 <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>