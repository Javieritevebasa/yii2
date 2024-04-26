<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Servicios;
use common\models\Especialidad;
/* @var $this yii\web\View */
/* @var $model common\models\EstarAsociado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estar-asociado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEspecialidad')->dropDownList(ArrayHelper::map(Especialidad::find()->all(), 'id', 'nombre'), ['prompt' => 'Seleccione Uno' ] ) ?>

    <?= $form->field($model, 'idServicio')->dropDownList(ArrayHelper::map(Servicios::find()->all(), 'id', 'nombre'), ['prompt' => 'Seleccione Uno' ] ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
