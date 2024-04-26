<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\crmItevebasa\models\Inspecciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inspecciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Estacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Anyo')->textInput() ?>

    <?= $form->field($model, 'InformeMecanica')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FechaInspeccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Matricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Bastidor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FechaMatriculacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Marca')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TipoVehiculo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CodigoConstruccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CodigoUtilizacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ContrasenyaHomologacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FechaProximaInspeccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FechaUltimaDesfavorable')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FechaPrimeraMatriculacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CodigoPropietario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Reforma1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Reforma2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Reforma3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Reforma4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Reforma5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DNI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Domicilio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Municipio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CodigoPostal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TipoMatricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TipoInspeccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FaseInspeccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AntiguedadVehiculo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Tarifa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ConceptoSigno1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ConceptoImporte1')->textInput() ?>

    <?= $form->field($model, 'ConceptoIVA1')->textInput() ?>

    <?= $form->field($model, 'ConceptoSigno2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ConceptoImporte2')->textInput() ?>

    <?= $form->field($model, 'ConceptoIVA2')->textInput() ?>

    <?= $form->field($model, 'ConceptoSigno3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ConceptoImporte3')->textInput() ?>

    <?= $form->field($model, 'ConceptoIVA3')->textInput() ?>

    <?= $form->field($model, 'ConceptoSigno4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ConceptoImporte4')->textInput() ?>

    <?= $form->field($model, 'ConceptoIVA4')->textInput() ?>

    <?= $form->field($model, 'ConceptoSigno5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ConceptoImporte5')->textInput() ?>

    <?= $form->field($model, 'ConceptoIVA5')->textInput() ?>

    <?= $form->field($model, 'ConceptoSigno6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ConceptoImporte6')->textInput() ?>

    <?= $form->field($model, 'ConceptoIVA6')->textInput() ?>

    <?= $form->field($model, 'TipoCombustible')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ResultadoInspeccion')->textInput() ?>

    <?= $form->field($model, 'NumeroFactura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FechaPagoTasas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo12')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad12')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto12')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto12')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad12')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo13')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad13')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto13')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto13')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad13')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo14')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad14')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto14')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto14')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad14')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo15')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad15')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto15')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto15')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad15')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo16')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad16')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto16')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto16')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad16')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo17')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad17')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto17')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto17')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad17')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo18')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad18')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto18')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto18')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad18')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo19')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad19')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto19')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto19')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad19')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo20')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad20')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto20')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto20')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad20')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo21')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad21')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto21')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto21')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad21')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo22')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad22')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto22')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto22')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad22')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo23')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad23')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto23')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto23')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad23')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo24')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad24')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto24')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto24')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad24')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo25')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad25')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto25')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto25')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad25')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capitulo26')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Unidad26')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Defecto26')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Subdefecto26')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Gravedad26')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FrenoServicioFIE1')->textInput() ?>

    <?= $form->field($model, 'FrenoServicioFDE1')->textInput() ?>

    <?= $form->field($model, 'FrenoServicioFIE2')->textInput() ?>

    <?= $form->field($model, 'FrenoServicioFDE2')->textInput() ?>

    <?= $form->field($model, 'FrenoServicioFIE3')->textInput() ?>

    <?= $form->field($model, 'FrenoServicioFDE3')->textInput() ?>

    <?= $form->field($model, 'FrenoServicioFIE4')->textInput() ?>

    <?= $form->field($model, 'FrenoServicioFDE4')->textInput() ?>

    <?= $form->field($model, 'FrenoSocorroFIE1')->textInput() ?>

    <?= $form->field($model, 'FrenoSocorroFDE1')->textInput() ?>

    <?= $form->field($model, 'FrenoSocorroFIE2')->textInput() ?>

    <?= $form->field($model, 'FrenoSocorroFDE2')->textInput() ?>

    <?= $form->field($model, 'FrenoSocorroFIE3')->textInput() ?>

    <?= $form->field($model, 'FrenoSocorroFDE3')->textInput() ?>

    <?= $form->field($model, 'FrenoSocorroFIE4')->textInput() ?>

    <?= $form->field($model, 'FrenoSocorroFDE4')->textInput() ?>

    <?= $form->field($model, 'FrenoEstacionamientoFIE1')->textInput() ?>

    <?= $form->field($model, 'FrenoEstacionamientoFDE1')->textInput() ?>

    <?= $form->field($model, 'FrenoEstacionamientoFIE2')->textInput() ?>

    <?= $form->field($model, 'FrenoEstacionamientoFDE2')->textInput() ?>

    <?= $form->field($model, 'FrenoEstacionamientoFIE3')->textInput() ?>

    <?= $form->field($model, 'FrenoEstacionamientoFDE3')->textInput() ?>

    <?= $form->field($model, 'FrenoEstacionamientoFIE4')->textInput() ?>

    <?= $form->field($model, 'FrenoEstacionamientoFDE4')->textInput() ?>

    <?= $form->field($model, 'EficaciaServicio')->textInput() ?>

    <?= $form->field($model, 'EficaciaEstacionamiento')->textInput() ?>

    <?= $form->field($model, 'EficaciaSocorro')->textInput() ?>

    <?= $form->field($model, 'EmisionesOpacidad')->textInput() ?>

    <?= $form->field($model, 'EmisionesCORalenti')->textInput() ?>

    <?= $form->field($model, 'EmisionesCOAcelerado')->textInput() ?>

    <?= $form->field($model, 'EmisionesLambda')->textInput() ?>

    <?= $form->field($model, 'SingoAlinenacionE1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AlinenacionE1')->textInput() ?>

    <?= $form->field($model, 'SingoAlinenacionE2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AlinenacionE2')->textInput() ?>

    <?= $form->field($model, 'Decelerometro')->textInput() ?>

    <?= $form->field($model, 'VelocidadLimitador')->textInput() ?>

    <?= $form->field($model, 'Tara')->textInput() ?>

    <?= $form->field($model, 'MMA')->textInput() ?>

    <?= $form->field($model, 'MMARemolque')->textInput() ?>

    <?= $form->field($model, 'EmailPropietario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Categoria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kilometros')->textInput() ?>

    <?= $form->field($model, 'Euro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Trazabilidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NumeroSerieFrenometro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NumeroSerieEquipoHumos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NumeroSerieAlineadora')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NumeroSerieVelocimetro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NumeroSerieDecelerometro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NumeroSerieTacometro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NumeroSerieSonometro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NumeroSerieDinamometro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NumeroSerieBascula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Seccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd_diaInspeccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HoraFactura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HoraInicio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HoraImpresionInforme')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hora1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hora2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hora3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hora4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hora5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hora6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hora7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hora8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hora9')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
