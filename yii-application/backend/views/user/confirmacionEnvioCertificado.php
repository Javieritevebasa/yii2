<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

  	<div class="row">
	 	<div class="col-lg-*">
	 		<?= $form->errorSummary($user); ?>
	 	</div>
	</div>

   	<?php if (!$user->hasErrors())
   		echo "<h2>Enhorabuena el certificado ha sido enviado correctamente a la estación ".$estacion->codigo."</h2>";
   	?>
    <?php ActiveForm::end(); ?>

</div>
