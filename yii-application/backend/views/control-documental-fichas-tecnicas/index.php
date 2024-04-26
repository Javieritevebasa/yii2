<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ControlDocumentalFichasTecnicasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Control Documental Fichas Técnicas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="control-documental-fichas-tecnicas-index">

    <h1><?= Html::encode($this->title) ?></h1>

   <p><br></p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'FICHATECNICA_MATRICULA',
            'FICHATECNICA_NUMEROCERTIFICADO',
            'FICHATECNICA_VIN',
            'ESTADO_NOMBRE',
            'INGENIERO_NOMBRE',
            'FICHATECNICA_FECHAEMISION',
            'SERVICIO_NOMBRE',
            'FICHATECNICA_MARCA',

          
        ],
    ]); ?>


</div>
