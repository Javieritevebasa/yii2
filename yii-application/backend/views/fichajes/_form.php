<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

use common\models\Accion;

/* @var $this yii\web\View */
/* @var $model common\models\Fichajes */
/* @var $form yii\widgets\ActiveForm */

$acciones = ArrayHelper::map(Accion::find()->all(), 'idAccion','nombre');
?>

<div class="fichajes-form">

    <?php $form = ActiveForm::begin(); ?>

 	<?= $form->field($model, 'fecha')->input('date') ?>
<?= $form->field($model, 'hora')->input('time') ?>
    <?= $form->field($model, 'idAccion')->dropDownList($acciones,[]) ?>

    <?= $form->field($model, 'comentario')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'idFichajes')->hiddenInput()->label(''); ?>
 	<?= $form->field($model, 'idUser')->textInput()->label(''); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
