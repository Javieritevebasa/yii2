<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use backend\models\Riego;

/* @var $this yii\web\View */
/* @var $model backend\models\SeguimientoRiesgosImparcialidad */
/* @var $form yii\widgets\ActiveForm */
$user = ArrayHelper::map(User::find()->where(['status' => 10])->andWhere(['not', ['codigoInspector' => '']])->orderby('codigoInspector')->all(),'id',function($model) {
        return $model['codigoInspector'];
    });
?>


<div class="seguimiento-riesgos-imparcialidad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuarioId')->dropDownList($user, ['prompt'=>'', 'options'=>[]]); ?>
    
   	<?= $form->field($model, 'estacion')->textInput(['maxlength' => true]) ?><br />
   
   *Formato AAAA-MM-dd hh:mm:ss
    <?= $form->field($model, 'fecha')->textInput(['prompt'=>'', 'options'=>[]]) ?>

    <?= $form->field($model, 'servicio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'riesgoId')->textInput() ?>

    <?= $form->field($model, 'nivelRiesgoId')->textInput() ?>

 	<?= $form->field($model, 'validado')->radioList([ '1' => 'Sí', '0' => 'No' ]) ?>
 
 	<?= $form->field($model, 'comentario')->textInput(['maxlength' => true]) ?>
 	
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
