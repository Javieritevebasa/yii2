<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model backend\models\SeguimientoRiesgosImparcialidad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seguimiento-riesgos-imparcialidad-informe-control">

    <?php $form = ActiveForm::begin(); ?>

    
	<label for="plantillas-justificacion">Plantillas</label>
 	<?= Html::dropDownList('plantillas-justificacion', 
 			null, 
 		ArrayHelper::map($justificaciones, 'id', 'descripcion'),
 			['text' => 'Selecciona uno',  'class' => 'form-control', 'id'=> 'plantillas-justificacion', 'prompt' => 'Selecciona uno']);
		?>
	
    <?= $form->field($model, 'justificacion')->textArea() ?>

   	
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script=<<<EOT
	$('#plantillas-justificacion').on('change', function(){
		
		$('#seguimientoriesgosimparcialidad-justificacion').text($(this).find('option:selected').text());
	});
	
EOT;
$this->registerJs( $script, View::POS_READY ); 
?>