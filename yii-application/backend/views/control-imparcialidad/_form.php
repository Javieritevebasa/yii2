<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\ControlImparcialidad */
/* @var $form yii\widgets\ActiveForm */

$user = ArrayHelper::map(User::find()->where(['status' => 10])->orderby('nombre', 'apellidos')->all(),'id',function($model) {
        return $model['nombre'].' '.$model['apellidos'];
    });
?>

<div class="control-imparcialidad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user')->dropDownList($user, ['prompt'=>'', 'options'=>[]]); ?>
    
    <?= $form->field($model, 'baja')->dropDownList([1=> 'Sí', null => 'No'], ['prompt'=>'', 'options'=>[]]); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
