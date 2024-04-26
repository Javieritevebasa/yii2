<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Zona;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\Estacion */
/* @var $form yii\widgets\ActiveForm */


$user = ArrayHelper::map(User::find()->joinWith('pertenecers')->where(['status' => 10,  ])->andWhere(['in', 'idGrupo', [5]])->orderby('nombre', 'apellidos')->all(),'id',function($model) {
        return $model['nombre'].' '.$model['apellidos'];
    });
?>

<div class="estacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    

 <?= $form->field($model, 'idZona')
        ->dropDownList(
             ArrayHelper::map(Zona::find()->all(), 'idZona', 'nombre'),           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        );
		?>

<?= $form->field($model, 'responsable')
        ->dropDownList(
             $user,           // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        );
		?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
