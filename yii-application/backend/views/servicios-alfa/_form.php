<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Zona;
use common\models\Servicios;

/* @var $this yii\web\View */
/* @var $model common\models\ServiciosAlfa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicios-alfa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idZona')->dropDownList(ArrayHelper::map(Zona::find()->all(), 'idZona', 'nombre'), ['prompt' => 'Seleccione Uno' ] ) ?>

    <?= $form->field($model, 'idServicio')->dropDownList(ArrayHelper::map(Servicios::find()->all(), 'id', 'nombre'), ['prompt' => 'Seleccione Uno' ] ) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigoComunidad')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
