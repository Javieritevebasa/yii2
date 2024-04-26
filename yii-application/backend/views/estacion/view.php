<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Estacion */

$this->title = $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Estacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->codigo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'nombre',
            'idZona',
        ],
    ]) ?>

<label class="control-label" for="User[_usuarios][]">Usuarios:</label>
	
	<?= GridView::widget([	'dataProvider' => $dataProviderUsuarios,
							'summary' => "",
							'columns' => [
							'nombre',
							'apellidos'], 
							
							]);
	
	?>
</div>
