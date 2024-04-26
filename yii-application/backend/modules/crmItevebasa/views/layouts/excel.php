<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		
		<?php 
		header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
		header('Content-Disposition: attachment; filename=nombre_archivo.xls');
		?>
	</head>
	<body>
		<?php $this->beginPage() ?>
			<?= $content ?>
		<?php $this->endPage() ?>
	
	</body>
</html>
<?php $this->endPage() ?>