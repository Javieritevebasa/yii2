<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Accion;


/* @var $this yii\web\View */

$this->title = 'Control de personal';
?>


<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <b>Por favor rellena los siguientes campos para fichar. Recuerda que debes salir después de verificar tus avisos pendientes. Gracias.</b>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput()?>
				
				<?= $form->field($model, 'idAccion')->dropDownList(
							             ArrayHelper::map(Accion::find()->all(), 'idAccion', 'nombre'),           // Flat array ('id'=>'label')
			            ['prompt'=>'']    // options
			        )->label('Seleccione una acción');?>
                
                <div class="form-group">
                    <?= Html::submitButton('Fichar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>





