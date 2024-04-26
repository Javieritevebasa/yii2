<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Enviar certificado a la estación';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>
  	<?php $form = ActiveForm::begin(); ?>
    <?php $items = ArrayHelper::map(common\models\Estacion::find()->all(), 'codigo', 'nombre'); ?>
    <?= $form->field($model, 'codigo')->dropDownList($items, ['prompt' => 'Selecciona una estación']) ?>
 	
 	<div class="form-group">
        <?= Html::submitButton('Enviar', ['class' =>  'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
