<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Grupo */

$this->title = $model->idGrupo;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idGrupo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idGrupo], [
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
            'idGrupo',
            'nombre',
            'peso',
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
