<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title ="Descarga del certificado de competencia";


	
?>
    <h1><?= Html::encode($this->title) ?></h1>
<div class="user-create">   
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

  	<div class="row">
	<div class="form-group">
		<?= $form->field($model, 'passwordCertificado')->passwordInput() ?>
	</div>
    <div class="form-group">
        <?= Html::submitButton('Descargar', ['class' =>'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
</div>
