<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Aviso */

$this->title = 'Update Aviso: ' . $model->idAviso;
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAviso, 'url' => ['view', 'id' => $model->idAviso]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aviso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'dataProviderUsers'=>$dataProviderUsers,
                'usuariosNotificados'=>$model->_usuariosNotificados,
                
    ]) ?>

</div>
