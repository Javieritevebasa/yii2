<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\crmItevebasa\models\InspeccionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inspecciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Estacion') ?>

    <?= $form->field($model, 'Anyo') ?>

    <?= $form->field($model, 'InformeMecanica') ?>

    <?= $form->field($model, 'FechaInspeccion') ?>

    <?= $form->field($model, 'Matricula') ?>

    <?php // echo $form->field($model, 'Bastidor') ?>

    <?php // echo $form->field($model, 'FechaMatriculacion') ?>

    <?php // echo $form->field($model, 'Marca') ?>

    <?php // echo $form->field($model, 'TipoVehiculo') ?>

    <?php // echo $form->field($model, 'CodigoConstruccion') ?>

    <?php // echo $form->field($model, 'CodigoUtilizacion') ?>

    <?php // echo $form->field($model, 'ContrasenyaHomologacion') ?>

    <?php // echo $form->field($model, 'FechaProximaInspeccion') ?>

    <?php // echo $form->field($model, 'FechaUltimaDesfavorable') ?>

    <?php // echo $form->field($model, 'FechaPrimeraMatriculacion') ?>

    <?php // echo $form->field($model, 'CodigoPropietario') ?>

    <?php // echo $form->field($model, 'Reforma1') ?>

    <?php // echo $form->field($model, 'Reforma2') ?>

    <?php // echo $form->field($model, 'Reforma3') ?>

    <?php // echo $form->field($model, 'Reforma4') ?>

    <?php // echo $form->field($model, 'Reforma5') ?>

    <?php // echo $form->field($model, 'DNI') ?>

    <?php // echo $form->field($model, 'Nombre') ?>

    <?php // echo $form->field($model, 'Domicilio') ?>

    <?php // echo $form->field($model, 'Municipio') ?>

    <?php // echo $form->field($model, 'CodigoPostal') ?>

    <?php // echo $form->field($model, 'Telefono1') ?>

    <?php // echo $form->field($model, 'Telefono2') ?>

    <?php // echo $form->field($model, 'TipoMatricula') ?>

    <?php // echo $form->field($model, 'TipoInspeccion') ?>

    <?php // echo $form->field($model, 'FaseInspeccion') ?>

    <?php // echo $form->field($model, 'AntiguedadVehiculo') ?>

    <?php // echo $form->field($model, 'Tarifa') ?>

    <?php // echo $form->field($model, 'ConceptoSigno1') ?>

    <?php // echo $form->field($model, 'ConceptoImporte1') ?>

    <?php // echo $form->field($model, 'ConceptoIVA1') ?>

    <?php // echo $form->field($model, 'ConceptoSigno2') ?>

    <?php // echo $form->field($model, 'ConceptoImporte2') ?>

    <?php // echo $form->field($model, 'ConceptoIVA2') ?>

    <?php // echo $form->field($model, 'ConceptoSigno3') ?>

    <?php // echo $form->field($model, 'ConceptoImporte3') ?>

    <?php // echo $form->field($model, 'ConceptoIVA3') ?>

    <?php // echo $form->field($model, 'ConceptoSigno4') ?>

    <?php // echo $form->field($model, 'ConceptoImporte4') ?>

    <?php // echo $form->field($model, 'ConceptoIVA4') ?>

    <?php // echo $form->field($model, 'ConceptoSigno5') ?>

    <?php // echo $form->field($model, 'ConceptoImporte5') ?>

    <?php // echo $form->field($model, 'ConceptoIVA5') ?>

    <?php // echo $form->field($model, 'ConceptoSigno6') ?>

    <?php // echo $form->field($model, 'ConceptoImporte6') ?>

    <?php // echo $form->field($model, 'ConceptoIVA6') ?>

    <?php // echo $form->field($model, 'TipoCombustible') ?>

    <?php // echo $form->field($model, 'ResultadoInspeccion') ?>

    <?php // echo $form->field($model, 'NumeroFactura') ?>

    <?php // echo $form->field($model, 'FechaPagoTasas') ?>

    <?php // echo $form->field($model, 'Capitulo1') ?>

    <?php // echo $form->field($model, 'Unidad1') ?>

    <?php // echo $form->field($model, 'Defecto1') ?>

    <?php // echo $form->field($model, 'Subdefecto1') ?>

    <?php // echo $form->field($model, 'Gravedad1') ?>

    <?php // echo $form->field($model, 'Capitulo2') ?>

    <?php // echo $form->field($model, 'Unidad2') ?>

    <?php // echo $form->field($model, 'Defecto2') ?>

    <?php // echo $form->field($model, 'Subdefecto2') ?>

    <?php // echo $form->field($model, 'Gravedad2') ?>

    <?php // echo $form->field($model, 'Capitulo3') ?>

    <?php // echo $form->field($model, 'Unidad3') ?>

    <?php // echo $form->field($model, 'Defecto3') ?>

    <?php // echo $form->field($model, 'Subdefecto3') ?>

    <?php // echo $form->field($model, 'Gravedad3') ?>

    <?php // echo $form->field($model, 'Capitulo4') ?>

    <?php // echo $form->field($model, 'Unidad4') ?>

    <?php // echo $form->field($model, 'Defecto4') ?>

    <?php // echo $form->field($model, 'Subdefecto4') ?>

    <?php // echo $form->field($model, 'Gravedad4') ?>

    <?php // echo $form->field($model, 'Capitulo5') ?>

    <?php // echo $form->field($model, 'Unidad5') ?>

    <?php // echo $form->field($model, 'Defecto5') ?>

    <?php // echo $form->field($model, 'Subdefecto5') ?>

    <?php // echo $form->field($model, 'Gravedad5') ?>

    <?php // echo $form->field($model, 'Capitulo6') ?>

    <?php // echo $form->field($model, 'Unidad6') ?>

    <?php // echo $form->field($model, 'Defecto6') ?>

    <?php // echo $form->field($model, 'Subdefecto6') ?>

    <?php // echo $form->field($model, 'Gravedad6') ?>

    <?php // echo $form->field($model, 'Capitulo7') ?>

    <?php // echo $form->field($model, 'Unidad7') ?>

    <?php // echo $form->field($model, 'Defecto7') ?>

    <?php // echo $form->field($model, 'Subdefecto7') ?>

    <?php // echo $form->field($model, 'Gravedad7') ?>

    <?php // echo $form->field($model, 'Capitulo8') ?>

    <?php // echo $form->field($model, 'Unidad8') ?>

    <?php // echo $form->field($model, 'Defecto8') ?>

    <?php // echo $form->field($model, 'Subdefecto8') ?>

    <?php // echo $form->field($model, 'Gravedad8') ?>

    <?php // echo $form->field($model, 'Capitulo9') ?>

    <?php // echo $form->field($model, 'Unidad9') ?>

    <?php // echo $form->field($model, 'Defecto9') ?>

    <?php // echo $form->field($model, 'Subdefecto9') ?>

    <?php // echo $form->field($model, 'Gravedad9') ?>

    <?php // echo $form->field($model, 'Capitulo10') ?>

    <?php // echo $form->field($model, 'Unidad10') ?>

    <?php // echo $form->field($model, 'Defecto10') ?>

    <?php // echo $form->field($model, 'Subdefecto10') ?>

    <?php // echo $form->field($model, 'Gravedad10') ?>

    <?php // echo $form->field($model, 'Capitulo11') ?>

    <?php // echo $form->field($model, 'Unidad11') ?>

    <?php // echo $form->field($model, 'Defecto11') ?>

    <?php // echo $form->field($model, 'Subdefecto11') ?>

    <?php // echo $form->field($model, 'Gravedad11') ?>

    <?php // echo $form->field($model, 'Capitulo12') ?>

    <?php // echo $form->field($model, 'Unidad12') ?>

    <?php // echo $form->field($model, 'Defecto12') ?>

    <?php // echo $form->field($model, 'Subdefecto12') ?>

    <?php // echo $form->field($model, 'Gravedad12') ?>

    <?php // echo $form->field($model, 'Capitulo13') ?>

    <?php // echo $form->field($model, 'Unidad13') ?>

    <?php // echo $form->field($model, 'Defecto13') ?>

    <?php // echo $form->field($model, 'Subdefecto13') ?>

    <?php // echo $form->field($model, 'Gravedad13') ?>

    <?php // echo $form->field($model, 'Capitulo14') ?>

    <?php // echo $form->field($model, 'Unidad14') ?>

    <?php // echo $form->field($model, 'Defecto14') ?>

    <?php // echo $form->field($model, 'Subdefecto14') ?>

    <?php // echo $form->field($model, 'Gravedad14') ?>

    <?php // echo $form->field($model, 'Capitulo15') ?>

    <?php // echo $form->field($model, 'Unidad15') ?>

    <?php // echo $form->field($model, 'Defecto15') ?>

    <?php // echo $form->field($model, 'Subdefecto15') ?>

    <?php // echo $form->field($model, 'Gravedad15') ?>

    <?php // echo $form->field($model, 'Capitulo16') ?>

    <?php // echo $form->field($model, 'Unidad16') ?>

    <?php // echo $form->field($model, 'Defecto16') ?>

    <?php // echo $form->field($model, 'Subdefecto16') ?>

    <?php // echo $form->field($model, 'Gravedad16') ?>

    <?php // echo $form->field($model, 'Capitulo17') ?>

    <?php // echo $form->field($model, 'Unidad17') ?>

    <?php // echo $form->field($model, 'Defecto17') ?>

    <?php // echo $form->field($model, 'Subdefecto17') ?>

    <?php // echo $form->field($model, 'Gravedad17') ?>

    <?php // echo $form->field($model, 'Capitulo18') ?>

    <?php // echo $form->field($model, 'Unidad18') ?>

    <?php // echo $form->field($model, 'Defecto18') ?>

    <?php // echo $form->field($model, 'Subdefecto18') ?>

    <?php // echo $form->field($model, 'Gravedad18') ?>

    <?php // echo $form->field($model, 'Capitulo19') ?>

    <?php // echo $form->field($model, 'Unidad19') ?>

    <?php // echo $form->field($model, 'Defecto19') ?>

    <?php // echo $form->field($model, 'Subdefecto19') ?>

    <?php // echo $form->field($model, 'Gravedad19') ?>

    <?php // echo $form->field($model, 'Capitulo20') ?>

    <?php // echo $form->field($model, 'Unidad20') ?>

    <?php // echo $form->field($model, 'Defecto20') ?>

    <?php // echo $form->field($model, 'Subdefecto20') ?>

    <?php // echo $form->field($model, 'Gravedad20') ?>

    <?php // echo $form->field($model, 'Capitulo21') ?>

    <?php // echo $form->field($model, 'Unidad21') ?>

    <?php // echo $form->field($model, 'Defecto21') ?>

    <?php // echo $form->field($model, 'Subdefecto21') ?>

    <?php // echo $form->field($model, 'Gravedad21') ?>

    <?php // echo $form->field($model, 'Capitulo22') ?>

    <?php // echo $form->field($model, 'Unidad22') ?>

    <?php // echo $form->field($model, 'Defecto22') ?>

    <?php // echo $form->field($model, 'Subdefecto22') ?>

    <?php // echo $form->field($model, 'Gravedad22') ?>

    <?php // echo $form->field($model, 'Capitulo23') ?>

    <?php // echo $form->field($model, 'Unidad23') ?>

    <?php // echo $form->field($model, 'Defecto23') ?>

    <?php // echo $form->field($model, 'Subdefecto23') ?>

    <?php // echo $form->field($model, 'Gravedad23') ?>

    <?php // echo $form->field($model, 'Capitulo24') ?>

    <?php // echo $form->field($model, 'Unidad24') ?>

    <?php // echo $form->field($model, 'Defecto24') ?>

    <?php // echo $form->field($model, 'Subdefecto24') ?>

    <?php // echo $form->field($model, 'Gravedad24') ?>

    <?php // echo $form->field($model, 'Capitulo25') ?>

    <?php // echo $form->field($model, 'Unidad25') ?>

    <?php // echo $form->field($model, 'Defecto25') ?>

    <?php // echo $form->field($model, 'Subdefecto25') ?>

    <?php // echo $form->field($model, 'Gravedad25') ?>

    <?php // echo $form->field($model, 'Capitulo26') ?>

    <?php // echo $form->field($model, 'Unidad26') ?>

    <?php // echo $form->field($model, 'Defecto26') ?>

    <?php // echo $form->field($model, 'Subdefecto26') ?>

    <?php // echo $form->field($model, 'Gravedad26') ?>

    <?php // echo $form->field($model, 'FrenoServicioFIE1') ?>

    <?php // echo $form->field($model, 'FrenoServicioFDE1') ?>

    <?php // echo $form->field($model, 'FrenoServicioFIE2') ?>

    <?php // echo $form->field($model, 'FrenoServicioFDE2') ?>

    <?php // echo $form->field($model, 'FrenoServicioFIE3') ?>

    <?php // echo $form->field($model, 'FrenoServicioFDE3') ?>

    <?php // echo $form->field($model, 'FrenoServicioFIE4') ?>

    <?php // echo $form->field($model, 'FrenoServicioFDE4') ?>

    <?php // echo $form->field($model, 'FrenoSocorroFIE1') ?>

    <?php // echo $form->field($model, 'FrenoSocorroFDE1') ?>

    <?php // echo $form->field($model, 'FrenoSocorroFIE2') ?>

    <?php // echo $form->field($model, 'FrenoSocorroFDE2') ?>

    <?php // echo $form->field($model, 'FrenoSocorroFIE3') ?>

    <?php // echo $form->field($model, 'FrenoSocorroFDE3') ?>

    <?php // echo $form->field($model, 'FrenoSocorroFIE4') ?>

    <?php // echo $form->field($model, 'FrenoSocorroFDE4') ?>

    <?php // echo $form->field($model, 'FrenoEstacionamientoFIE1') ?>

    <?php // echo $form->field($model, 'FrenoEstacionamientoFDE1') ?>

    <?php // echo $form->field($model, 'FrenoEstacionamientoFIE2') ?>

    <?php // echo $form->field($model, 'FrenoEstacionamientoFDE2') ?>

    <?php // echo $form->field($model, 'FrenoEstacionamientoFIE3') ?>

    <?php // echo $form->field($model, 'FrenoEstacionamientoFDE3') ?>

    <?php // echo $form->field($model, 'FrenoEstacionamientoFIE4') ?>

    <?php // echo $form->field($model, 'FrenoEstacionamientoFDE4') ?>

    <?php // echo $form->field($model, 'EficaciaServicio') ?>

    <?php // echo $form->field($model, 'EficaciaEstacionamiento') ?>

    <?php // echo $form->field($model, 'EficaciaSocorro') ?>

    <?php // echo $form->field($model, 'EmisionesOpacidad') ?>

    <?php // echo $form->field($model, 'EmisionesCORalenti') ?>

    <?php // echo $form->field($model, 'EmisionesCOAcelerado') ?>

    <?php // echo $form->field($model, 'EmisionesLambda') ?>

    <?php // echo $form->field($model, 'SingoAlinenacionE1') ?>

    <?php // echo $form->field($model, 'AlinenacionE1') ?>

    <?php // echo $form->field($model, 'SingoAlinenacionE2') ?>

    <?php // echo $form->field($model, 'AlinenacionE2') ?>

    <?php // echo $form->field($model, 'Decelerometro') ?>

    <?php // echo $form->field($model, 'VelocidadLimitador') ?>

    <?php // echo $form->field($model, 'Tara') ?>

    <?php // echo $form->field($model, 'MMA') ?>

    <?php // echo $form->field($model, 'MMARemolque') ?>

    <?php // echo $form->field($model, 'EmailPropietario') ?>

    <?php // echo $form->field($model, 'Categoria') ?>

    <?php // echo $form->field($model, 'Kilometros') ?>

    <?php // echo $form->field($model, 'Euro') ?>

    <?php // echo $form->field($model, 'Trazabilidad') ?>

    <?php // echo $form->field($model, 'NumeroSerieFrenometro') ?>

    <?php // echo $form->field($model, 'NumeroSerieEquipoHumos') ?>

    <?php // echo $form->field($model, 'NumeroSerieAlineadora') ?>

    <?php // echo $form->field($model, 'NumeroSerieVelocimetro') ?>

    <?php // echo $form->field($model, 'NumeroSerieDecelerometro') ?>

    <?php // echo $form->field($model, 'NumeroSerieTacometro') ?>

    <?php // echo $form->field($model, 'NumeroSerieSonometro') ?>

    <?php // echo $form->field($model, 'NumeroSerieDinamometro') ?>

    <?php // echo $form->field($model, 'NumeroSerieBascula') ?>

    <?php // echo $form->field($model, 'Seccion') ?>

    <?php // echo $form->field($model, 'd_diaInspeccion') ?>

    <?php // echo $form->field($model, 'HoraFactura') ?>

    <?php // echo $form->field($model, 'HoraInicio') ?>

    <?php // echo $form->field($model, 'HoraImpresionInforme') ?>

    <?php // echo $form->field($model, 'Hora1') ?>

    <?php // echo $form->field($model, 'Hora2') ?>

    <?php // echo $form->field($model, 'Hora3') ?>

    <?php // echo $form->field($model, 'Hora4') ?>

    <?php // echo $form->field($model, 'Hora5') ?>

    <?php // echo $form->field($model, 'Hora6') ?>

    <?php // echo $form->field($model, 'Hora7') ?>

    <?php // echo $form->field($model, 'Hora8') ?>

    <?php // echo $form->field($model, 'Hora9') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
