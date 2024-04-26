<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Zona */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $responsablesZona = User::find()->joinWith('pertenecers')->where(['idGrupo' => 6 ])->all(); ?>
<div class="zona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idZona')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'idResponsableZona') ->dropDownList(
             ArrayHelper::map($responsablesZona, 'id', function( $item ) { return $item['nombre']. ' ' . $item['apellidos'];}),
             	// Flat array ('id'=>'label')
            	['prompt'=>'']    // options
        );
	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
