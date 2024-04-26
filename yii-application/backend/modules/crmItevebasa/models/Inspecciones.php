<?php

namespace backend\modules\crmItevebasa\models;

use Yii;
use backend\modules\crmItevebasa\models\Municipio;
use backend\modules\crmItevebasa\models\Poblacion;

/**
 * This is the model class for table "inspecciones".
 *
 * @property string $Estacion
 * @property int $Anyo
 * @property int $InformeMecanica
 * @property string $FechaInspeccion
 * @property string $Matricula
 * @property string $Bastidor
 * @property string $FechaMatriculacion
 * @property string $Marca
 * @property string $TipoVehiculo
 * @property string $CodigoConstruccion
 * @property string $CodigoUtilizacion
 * @property string $ContrasenyaHomologacion
 * @property string $FechaProximaInspeccion
 * @property string $FechaUltimaDesfavorable
 * @property string $FechaPrimeraMatriculacion
 * @property string $CodigoPropietario
 * @property string $Reforma1
 * @property string $Reforma2
 * @property string $Reforma3
 * @property string $Reforma4
 * @property string $Reforma5
 * @property string $DNI
 * @property string $Nombre
 * @property string $Domicilio
 * @property string $Municipio
 * @property string $CodigoPostal
 * @property string $Telefono1
 * @property string $Telefono2
 * @property string $TipoMatricula
 * @property string $TipoInspeccion
 * @property string $FaseInspeccion
 * @property string $AntiguedadVehiculo
 * @property string $Tarifa
 * @property string $ConceptoSigno1
 * @property float $ConceptoImporte1
 * @property float $ConceptoIVA1
 * @property string $ConceptoSigno2
 * @property float $ConceptoImporte2
 * @property float $ConceptoIVA2
 * @property string $ConceptoSigno3
 * @property float $ConceptoImporte3
 * @property float $ConceptoIVA3
 * @property string $ConceptoSigno4
 * @property float $ConceptoImporte4
 * @property float $ConceptoIVA4
 * @property string $ConceptoSigno5
 * @property float $ConceptoImporte5
 * @property float $ConceptoIVA5
 * @property string $ConceptoSigno6
 * @property float $ConceptoImporte6
 * @property float $ConceptoIVA6
 * @property string $TipoCombustible
 * @property int $ResultadoInspeccion
 * @property string $NumeroFactura
 * @property string $FechaPagoTasas
 * @property string $Capitulo1
 * @property string $Unidad1
 * @property string $Defecto1
 * @property string $Subdefecto1
 * @property string $Gravedad1
 * @property string $Capitulo2
 * @property string $Unidad2
 * @property string $Defecto2
 * @property string $Subdefecto2
 * @property string $Gravedad2
 * @property string $Capitulo3
 * @property string $Unidad3
 * @property string $Defecto3
 * @property string $Subdefecto3
 * @property string $Gravedad3
 * @property string $Capitulo4
 * @property string $Unidad4
 * @property string $Defecto4
 * @property string $Subdefecto4
 * @property string $Gravedad4
 * @property string $Capitulo5
 * @property string $Unidad5
 * @property string $Defecto5
 * @property string $Subdefecto5
 * @property string $Gravedad5
 * @property string $Capitulo6
 * @property string $Unidad6
 * @property string $Defecto6
 * @property string $Subdefecto6
 * @property string $Gravedad6
 * @property string $Capitulo7
 * @property string $Unidad7
 * @property string $Defecto7
 * @property string $Subdefecto7
 * @property string $Gravedad7
 * @property string $Capitulo8
 * @property string $Unidad8
 * @property string $Defecto8
 * @property string $Subdefecto8
 * @property string $Gravedad8
 * @property string $Capitulo9
 * @property string $Unidad9
 * @property string $Defecto9
 * @property string $Subdefecto9
 * @property string $Gravedad9
 * @property string $Capitulo10
 * @property string $Unidad10
 * @property string $Defecto10
 * @property string $Subdefecto10
 * @property string $Gravedad10
 * @property string $Capitulo11
 * @property string $Unidad11
 * @property string $Defecto11
 * @property string $Subdefecto11
 * @property string $Gravedad11
 * @property string $Capitulo12
 * @property string $Unidad12
 * @property string $Defecto12
 * @property string $Subdefecto12
 * @property string $Gravedad12
 * @property string $Capitulo13
 * @property string $Unidad13
 * @property string $Defecto13
 * @property string $Subdefecto13
 * @property string $Gravedad13
 * @property string $Capitulo14
 * @property string $Unidad14
 * @property string $Defecto14
 * @property string $Subdefecto14
 * @property string $Gravedad14
 * @property string $Capitulo15
 * @property string $Unidad15
 * @property string $Defecto15
 * @property string $Subdefecto15
 * @property string $Gravedad15
 * @property string $Capitulo16
 * @property string $Unidad16
 * @property string $Defecto16
 * @property string $Subdefecto16
 * @property string $Gravedad16
 * @property string $Capitulo17
 * @property string $Unidad17
 * @property string $Defecto17
 * @property string $Subdefecto17
 * @property string $Gravedad17
 * @property string $Capitulo18
 * @property string $Unidad18
 * @property string $Defecto18
 * @property string $Subdefecto18
 * @property string $Gravedad18
 * @property string $Capitulo19
 * @property string $Unidad19
 * @property string $Defecto19
 * @property string $Subdefecto19
 * @property string $Gravedad19
 * @property string $Capitulo20
 * @property string $Unidad20
 * @property string $Defecto20
 * @property string $Subdefecto20
 * @property string $Gravedad20
 * @property string $Capitulo21
 * @property string $Unidad21
 * @property string $Defecto21
 * @property string $Subdefecto21
 * @property string $Gravedad21
 * @property string $Capitulo22
 * @property string $Unidad22
 * @property string $Defecto22
 * @property string $Subdefecto22
 * @property string $Gravedad22
 * @property string $Capitulo23
 * @property string $Unidad23
 * @property string $Defecto23
 * @property string $Subdefecto23
 * @property string $Gravedad23
 * @property string $Capitulo24
 * @property string $Unidad24
 * @property string $Defecto24
 * @property string $Subdefecto24
 * @property string $Gravedad24
 * @property string $Capitulo25
 * @property string $Unidad25
 * @property string $Defecto25
 * @property string $Subdefecto25
 * @property string $Gravedad25
 * @property string $Capitulo26
 * @property string $Unidad26
 * @property string $Defecto26
 * @property string $Subdefecto26
 * @property string $Gravedad26
 * @property float $FrenoServicioFIE1
 * @property float $FrenoServicioFDE1
 * @property float $FrenoServicioFIE2
 * @property float $FrenoServicioFDE2
 * @property float $FrenoServicioFIE3
 * @property float $FrenoServicioFDE3
 * @property float $FrenoServicioFIE4
 * @property float $FrenoServicioFDE4
 * @property float $FrenoSocorroFIE1
 * @property float $FrenoSocorroFDE1
 * @property float $FrenoSocorroFIE2
 * @property float $FrenoSocorroFDE2
 * @property float $FrenoSocorroFIE3
 * @property float $FrenoSocorroFDE3
 * @property float $FrenoSocorroFIE4
 * @property float $FrenoSocorroFDE4
 * @property float $FrenoEstacionamientoFIE1
 * @property float $FrenoEstacionamientoFDE1
 * @property float $FrenoEstacionamientoFIE2
 * @property float $FrenoEstacionamientoFDE2
 * @property float $FrenoEstacionamientoFIE3
 * @property float $FrenoEstacionamientoFDE3
 * @property float $FrenoEstacionamientoFIE4
 * @property float $FrenoEstacionamientoFDE4
 * @property float $EficaciaServicio
 * @property float $EficaciaEstacionamiento
 * @property float $EficaciaSocorro
 * @property float $EmisionesOpacidad
 * @property float $EmisionesCORalenti
 * @property float $EmisionesCOAcelerado
 * @property float $EmisionesLambda
 * @property string $SingoAlinenacionE1
 * @property float $AlinenacionE1
 * @property string $SingoAlinenacionE2
 * @property float $AlinenacionE2
 * @property float $Decelerometro
 * @property float $VelocidadLimitador
 * @property int $Tara
 * @property int $MMA
 * @property int $MMARemolque
 * @property string $EmailPropietario
 * @property string $Categoria
 * @property int $Kilometros
 * @property string $Euro
 * @property string $Trazabilidad
 * @property string $NumeroSerieFrenometro
 * @property string $NumeroSerieEquipoHumos
 * @property string $NumeroSerieAlineadora
 * @property string $NumeroSerieVelocimetro
 * @property string $NumeroSerieDecelerometro
 * @property string $NumeroSerieTacometro
 * @property string $NumeroSerieSonometro
 * @property string $NumeroSerieDinamometro
 * @property string $NumeroSerieBascula
 * @property string|null $Seccion
 * @property string|null $d_diaInspeccion
 * @property string|null $HoraFactura
 * @property string|null $HoraInicio
 * @property string|null $HoraImpresionInforme
 * @property string|null $Hora1
 * @property string|null $Hora2
 * @property string|null $Hora3
 * @property string|null $Hora4
 * @property string|null $Hora5
 * @property string|null $Hora6
 * @property string|null $Hora7
 * @property string|null $Hora8
 * @property string|null $Hora9
 *
 * @property Defectos[] $defectos
 */
class Inspecciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inspecciones';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbPentaho');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Estacion', 'Anyo', 'InformeMecanica', 'FechaInspeccion', 'Matricula', 'Bastidor', 'FechaMatriculacion', 'Marca', 'TipoVehiculo', 'CodigoConstruccion', 'CodigoUtilizacion', 'ContrasenyaHomologacion', 'FechaProximaInspeccion', 'FechaUltimaDesfavorable', 'FechaPrimeraMatriculacion', 'CodigoPropietario', 'Reforma1', 'Reforma2', 'Reforma3', 'Reforma4', 'Reforma5', 'DNI', 'Nombre', 'Domicilio', 'Municipio', 'CodigoPostal', 'Telefono1', 'Telefono2', 'TipoMatricula', 'TipoInspeccion', 'FaseInspeccion', 'AntiguedadVehiculo', 'Tarifa', 'ConceptoSigno1', 'ConceptoImporte1', 'ConceptoIVA1', 'ConceptoSigno2', 'ConceptoImporte2', 'ConceptoIVA2', 'ConceptoSigno3', 'ConceptoImporte3', 'ConceptoIVA3', 'ConceptoSigno4', 'ConceptoImporte4', 'ConceptoIVA4', 'ConceptoSigno5', 'ConceptoImporte5', 'ConceptoIVA5', 'ConceptoSigno6', 'ConceptoImporte6', 'ConceptoIVA6', 'TipoCombustible', 'ResultadoInspeccion', 'NumeroFactura', 'FechaPagoTasas', 'Capitulo1', 'Unidad1', 'Defecto1', 'Subdefecto1', 'Gravedad1', 'Capitulo2', 'Unidad2', 'Defecto2', 'Subdefecto2', 'Gravedad2', 'Capitulo3', 'Unidad3', 'Defecto3', 'Subdefecto3', 'Gravedad3', 'Capitulo4', 'Unidad4', 'Defecto4', 'Subdefecto4', 'Gravedad4', 'Capitulo5', 'Unidad5', 'Defecto5', 'Subdefecto5', 'Gravedad5', 'Capitulo6', 'Unidad6', 'Defecto6', 'Subdefecto6', 'Gravedad6', 'Capitulo7', 'Unidad7', 'Defecto7', 'Subdefecto7', 'Gravedad7', 'Capitulo8', 'Unidad8', 'Defecto8', 'Subdefecto8', 'Gravedad8', 'Capitulo9', 'Unidad9', 'Defecto9', 'Subdefecto9', 'Gravedad9', 'Capitulo10', 'Unidad10', 'Defecto10', 'Subdefecto10', 'Gravedad10', 'Capitulo11', 'Unidad11', 'Defecto11', 'Subdefecto11', 'Gravedad11', 'Capitulo12', 'Unidad12', 'Defecto12', 'Subdefecto12', 'Gravedad12', 'Capitulo13', 'Unidad13', 'Defecto13', 'Subdefecto13', 'Gravedad13', 'Capitulo14', 'Unidad14', 'Defecto14', 'Subdefecto14', 'Gravedad14', 'Capitulo15', 'Unidad15', 'Defecto15', 'Subdefecto15', 'Gravedad15', 'Capitulo16', 'Unidad16', 'Defecto16', 'Subdefecto16', 'Gravedad16', 'Capitulo17', 'Unidad17', 'Defecto17', 'Subdefecto17', 'Gravedad17', 'Capitulo18', 'Unidad18', 'Defecto18', 'Subdefecto18', 'Gravedad18', 'Capitulo19', 'Unidad19', 'Defecto19', 'Subdefecto19', 'Gravedad19', 'Capitulo20', 'Unidad20', 'Defecto20', 'Subdefecto20', 'Gravedad20', 'Capitulo21', 'Unidad21', 'Defecto21', 'Subdefecto21', 'Gravedad21', 'Capitulo22', 'Unidad22', 'Defecto22', 'Subdefecto22', 'Gravedad22', 'Capitulo23', 'Unidad23', 'Defecto23', 'Subdefecto23', 'Gravedad23', 'Capitulo24', 'Unidad24', 'Defecto24', 'Subdefecto24', 'Gravedad24', 'Capitulo25', 'Unidad25', 'Defecto25', 'Subdefecto25', 'Gravedad25', 'Capitulo26', 'Unidad26', 'Defecto26', 'Subdefecto26', 'Gravedad26', 'FrenoServicioFIE1', 'FrenoServicioFDE1', 'FrenoServicioFIE2', 'FrenoServicioFDE2', 'FrenoServicioFIE3', 'FrenoServicioFDE3', 'FrenoServicioFIE4', 'FrenoServicioFDE4', 'FrenoSocorroFIE1', 'FrenoSocorroFDE1', 'FrenoSocorroFIE2', 'FrenoSocorroFDE2', 'FrenoSocorroFIE3', 'FrenoSocorroFDE3', 'FrenoSocorroFIE4', 'FrenoSocorroFDE4', 'FrenoEstacionamientoFIE1', 'FrenoEstacionamientoFDE1', 'FrenoEstacionamientoFIE2', 'FrenoEstacionamientoFDE2', 'FrenoEstacionamientoFIE3', 'FrenoEstacionamientoFDE3', 'FrenoEstacionamientoFIE4', 'FrenoEstacionamientoFDE4', 'EficaciaServicio', 'EficaciaEstacionamiento', 'EficaciaSocorro', 'EmisionesOpacidad', 'EmisionesCORalenti', 'EmisionesCOAcelerado', 'EmisionesLambda', 'SingoAlinenacionE1', 'AlinenacionE1', 'SingoAlinenacionE2', 'AlinenacionE2', 'Decelerometro', 'VelocidadLimitador', 'Tara', 'MMA', 'MMARemolque', 'EmailPropietario', 'Categoria', 'Kilometros', 'Euro', 'Trazabilidad', 'NumeroSerieFrenometro', 'NumeroSerieEquipoHumos', 'NumeroSerieAlineadora', 'NumeroSerieVelocimetro', 'NumeroSerieDecelerometro', 'NumeroSerieTacometro', 'NumeroSerieSonometro', 'NumeroSerieDinamometro', 'NumeroSerieBascula'], 'required'],
            [['Anyo', 'InformeMecanica', 'ResultadoInspeccion', 'Tara', 'MMA', 'MMARemolque', 'Kilometros'], 'integer'],
            [['ConceptoImporte1', 'ConceptoIVA1', 'ConceptoImporte2', 'ConceptoIVA2', 'ConceptoImporte3', 'ConceptoIVA3', 'ConceptoImporte4', 'ConceptoIVA4', 'ConceptoImporte5', 'ConceptoIVA5', 'ConceptoImporte6', 'ConceptoIVA6', 'FrenoServicioFIE1', 'FrenoServicioFDE1', 'FrenoServicioFIE2', 'FrenoServicioFDE2', 'FrenoServicioFIE3', 'FrenoServicioFDE3', 'FrenoServicioFIE4', 'FrenoServicioFDE4', 'FrenoSocorroFIE1', 'FrenoSocorroFDE1', 'FrenoSocorroFIE2', 'FrenoSocorroFDE2', 'FrenoSocorroFIE3', 'FrenoSocorroFDE3', 'FrenoSocorroFIE4', 'FrenoSocorroFDE4', 'FrenoEstacionamientoFIE1', 'FrenoEstacionamientoFDE1', 'FrenoEstacionamientoFIE2', 'FrenoEstacionamientoFDE2', 'FrenoEstacionamientoFIE3', 'FrenoEstacionamientoFDE3', 'FrenoEstacionamientoFIE4', 'FrenoEstacionamientoFDE4', 'EficaciaServicio', 'EficaciaEstacionamiento', 'EficaciaSocorro', 'EmisionesOpacidad', 'EmisionesCORalenti', 'EmisionesCOAcelerado', 'EmisionesLambda', 'AlinenacionE1', 'AlinenacionE2', 'Decelerometro', 'VelocidadLimitador'], 'number'],
            [['Estacion'], 'string', 'max' => 400],
            [['FechaInspeccion', 'FechaMatriculacion', 'FechaProximaInspeccion', 'FechaUltimaDesfavorable', 'FechaPrimeraMatriculacion', 'FechaPagoTasas', 'd_diaInspeccion'], 'string', 'max' => 8],
            [['Matricula'], 'string', 'max' => 11],
            [['Bastidor'], 'string', 'max' => 18],
            [['Marca', 'TipoVehiculo', 'Nombre', 'Domicilio'], 'string', 'max' => 30],
            [['CodigoConstruccion', 'CodigoUtilizacion', 'Capitulo1', 'Unidad1', 'Defecto1', 'Subdefecto1', 'Capitulo2', 'Unidad2', 'Defecto2', 'Subdefecto2', 'Capitulo3', 'Unidad3', 'Defecto3', 'Subdefecto3', 'Capitulo4', 'Unidad4', 'Defecto4', 'Subdefecto4', 'Capitulo5', 'Unidad5', 'Defecto5', 'Subdefecto5', 'Capitulo6', 'Unidad6', 'Defecto6', 'Subdefecto6', 'Capitulo7', 'Unidad7', 'Defecto7', 'Subdefecto7', 'Capitulo8', 'Unidad8', 'Defecto8', 'Subdefecto8', 'Capitulo9', 'Unidad9', 'Defecto9', 'Subdefecto9', 'Capitulo10', 'Unidad10', 'Defecto10', 'Subdefecto10', 'Capitulo11', 'Unidad11', 'Defecto11', 'Subdefecto11', 'Capitulo12', 'Unidad12', 'Defecto12', 'Subdefecto12', 'Capitulo13', 'Unidad13', 'Defecto13', 'Subdefecto13', 'Capitulo14', 'Unidad14', 'Defecto14', 'Subdefecto14', 'Capitulo15', 'Unidad15', 'Defecto15', 'Subdefecto15', 'Capitulo16', 'Unidad16', 'Defecto16', 'Subdefecto16', 'Capitulo17', 'Unidad17', 'Defecto17', 'Subdefecto17', 'Capitulo18', 'Unidad18', 'Defecto18', 'Subdefecto18', 'Capitulo19', 'Unidad19', 'Defecto19', 'Subdefecto19', 'Capitulo20', 'Unidad20', 'Defecto20', 'Subdefecto20', 'Capitulo21', 'Unidad21', 'Defecto21', 'Subdefecto21', 'Capitulo22', 'Unidad22', 'Defecto22', 'Subdefecto22', 'Capitulo23', 'Unidad23', 'Defecto23', 'Subdefecto23', 'Capitulo24', 'Unidad24', 'Defecto24', 'Subdefecto24', 'Capitulo25', 'Unidad25', 'Defecto25', 'Subdefecto25', 'Capitulo26', 'Unidad26', 'Defecto26', 'Subdefecto26', 'Seccion'], 'string', 'max' => 2],
            [['ContrasenyaHomologacion'], 'string', 'max' => 28],
            [['CodigoPropietario', 'DNI', 'Euro'], 'string', 'max' => 9],
            [['Reforma1', 'Reforma2', 'Reforma3', 'Reforma4', 'Reforma5'], 'string', 'max' => 4],
            [['Municipio'], 'string', 'max' => 20],
            [['CodigoPostal'], 'string', 'max' => 5],
            [['Telefono1', 'Telefono2', 'NumeroFactura'], 'string', 'max' => 10],
            [['TipoMatricula', 'FaseInspeccion', 'Tarifa', 'ConceptoSigno1', 'ConceptoSigno2', 'ConceptoSigno3', 'ConceptoSigno4', 'ConceptoSigno5', 'ConceptoSigno6', 'TipoCombustible', 'Gravedad1', 'Gravedad2', 'Gravedad3', 'Gravedad4', 'Gravedad5', 'Gravedad6', 'Gravedad7', 'Gravedad8', 'Gravedad9', 'Gravedad10', 'Gravedad11', 'Gravedad12', 'Gravedad13', 'Gravedad14', 'Gravedad15', 'Gravedad16', 'Gravedad17', 'Gravedad18', 'Gravedad19', 'Gravedad20', 'Gravedad21', 'Gravedad22', 'Gravedad23', 'Gravedad24', 'Gravedad25', 'Gravedad26', 'SingoAlinenacionE1', 'SingoAlinenacionE2'], 'string', 'max' => 1],
            [['TipoInspeccion', 'AntiguedadVehiculo'], 'string', 'max' => 3],
            [['EmailPropietario'], 'string', 'max' => 80],
            [['Categoria'], 'string', 'max' => 7],
            [['Trazabilidad'], 'string', 'max' => 1600],
            [['NumeroSerieFrenometro', 'NumeroSerieEquipoHumos', 'NumeroSerieAlineadora', 'NumeroSerieVelocimetro', 'NumeroSerieDecelerometro', 'NumeroSerieTacometro', 'NumeroSerieSonometro', 'NumeroSerieDinamometro', 'NumeroSerieBascula'], 'string', 'max' => 15],
            [['HoraFactura', 'HoraInicio', 'HoraImpresionInforme', 'Hora1', 'Hora2', 'Hora3', 'Hora4', 'Hora5', 'Hora6', 'Hora7', 'Hora8', 'Hora9'], 'string', 'max' => 6],
            [['Estacion', 'Anyo', 'InformeMecanica'], 'unique', 'targetAttribute' => ['Estacion', 'Anyo', 'InformeMecanica']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Estacion' => 'Estacion',
            'Anyo' => 'Anyo',
            'InformeMecanica' => 'Informe Mecanica',
            'FechaInspeccion' => 'Fecha Inspeccion',
            'Matricula' => 'Matricula',
            'Bastidor' => 'Bastidor',
            'FechaMatriculacion' => 'Fecha Matriculacion',
            'Marca' => 'Marca',
            'TipoVehiculo' => 'Tipo Vehiculo',
            'CodigoConstruccion' => 'Codigo Construccion',
            'CodigoUtilizacion' => 'Codigo Utilizacion',
            'ContrasenyaHomologacion' => 'Contrasenya Homologacion',
            'FechaProximaInspeccion' => 'Fecha Proxima Inspeccion',
            'FechaUltimaDesfavorable' => 'Fecha Ultima Desfavorable',
            'FechaPrimeraMatriculacion' => 'Fecha Primera Matriculacion',
            'CodigoPropietario' => 'Codigo Propietario',
            'Reforma1' => 'Reforma1',
            'Reforma2' => 'Reforma2',
            'Reforma3' => 'Reforma3',
            'Reforma4' => 'Reforma4',
            'Reforma5' => 'Reforma5',
            'DNI' => 'Dni',
            'Nombre' => 'Nombre',
            'Domicilio' => 'Domicilio',
            'Municipio' => 'Municipio',
            'CodigoPostal' => 'Codigo Postal',
            'Telefono1' => 'Telefono1',
            'Telefono2' => 'Telefono2',
            'TipoMatricula' => 'Tipo Matricula',
            'TipoInspeccion' => 'Tipo Inspeccion',
            'FaseInspeccion' => 'Fase Inspeccion',
            'AntiguedadVehiculo' => 'Antiguedad Vehiculo',
            'Tarifa' => 'Tarifa',
            'ConceptoSigno1' => 'Concepto Signo1',
            'ConceptoImporte1' => 'Concepto Importe1',
            'ConceptoIVA1' => 'Concepto Iva1',
            'ConceptoSigno2' => 'Concepto Signo2',
            'ConceptoImporte2' => 'Concepto Importe2',
            'ConceptoIVA2' => 'Concepto Iva2',
            'ConceptoSigno3' => 'Concepto Signo3',
            'ConceptoImporte3' => 'Concepto Importe3',
            'ConceptoIVA3' => 'Concepto Iva3',
            'ConceptoSigno4' => 'Concepto Signo4',
            'ConceptoImporte4' => 'Concepto Importe4',
            'ConceptoIVA4' => 'Concepto Iva4',
            'ConceptoSigno5' => 'Concepto Signo5',
            'ConceptoImporte5' => 'Concepto Importe5',
            'ConceptoIVA5' => 'Concepto Iva5',
            'ConceptoSigno6' => 'Concepto Signo6',
            'ConceptoImporte6' => 'Concepto Importe6',
            'ConceptoIVA6' => 'Concepto Iva6',
            'TipoCombustible' => 'Tipo Combustible',
            'ResultadoInspeccion' => 'Resultado Inspeccion',
            'NumeroFactura' => 'Numero Factura',
            'FechaPagoTasas' => 'Fecha Pago Tasas',
            'Capitulo1' => 'Capitulo1',
            'Unidad1' => 'Unidad1',
            'Defecto1' => 'Defecto1',
            'Subdefecto1' => 'Subdefecto1',
            'Gravedad1' => 'Gravedad1',
            'Capitulo2' => 'Capitulo2',
            'Unidad2' => 'Unidad2',
            'Defecto2' => 'Defecto2',
            'Subdefecto2' => 'Subdefecto2',
            'Gravedad2' => 'Gravedad2',
            'Capitulo3' => 'Capitulo3',
            'Unidad3' => 'Unidad3',
            'Defecto3' => 'Defecto3',
            'Subdefecto3' => 'Subdefecto3',
            'Gravedad3' => 'Gravedad3',
            'Capitulo4' => 'Capitulo4',
            'Unidad4' => 'Unidad4',
            'Defecto4' => 'Defecto4',
            'Subdefecto4' => 'Subdefecto4',
            'Gravedad4' => 'Gravedad4',
            'Capitulo5' => 'Capitulo5',
            'Unidad5' => 'Unidad5',
            'Defecto5' => 'Defecto5',
            'Subdefecto5' => 'Subdefecto5',
            'Gravedad5' => 'Gravedad5',
            'Capitulo6' => 'Capitulo6',
            'Unidad6' => 'Unidad6',
            'Defecto6' => 'Defecto6',
            'Subdefecto6' => 'Subdefecto6',
            'Gravedad6' => 'Gravedad6',
            'Capitulo7' => 'Capitulo7',
            'Unidad7' => 'Unidad7',
            'Defecto7' => 'Defecto7',
            'Subdefecto7' => 'Subdefecto7',
            'Gravedad7' => 'Gravedad7',
            'Capitulo8' => 'Capitulo8',
            'Unidad8' => 'Unidad8',
            'Defecto8' => 'Defecto8',
            'Subdefecto8' => 'Subdefecto8',
            'Gravedad8' => 'Gravedad8',
            'Capitulo9' => 'Capitulo9',
            'Unidad9' => 'Unidad9',
            'Defecto9' => 'Defecto9',
            'Subdefecto9' => 'Subdefecto9',
            'Gravedad9' => 'Gravedad9',
            'Capitulo10' => 'Capitulo10',
            'Unidad10' => 'Unidad10',
            'Defecto10' => 'Defecto10',
            'Subdefecto10' => 'Subdefecto10',
            'Gravedad10' => 'Gravedad10',
            'Capitulo11' => 'Capitulo11',
            'Unidad11' => 'Unidad11',
            'Defecto11' => 'Defecto11',
            'Subdefecto11' => 'Subdefecto11',
            'Gravedad11' => 'Gravedad11',
            'Capitulo12' => 'Capitulo12',
            'Unidad12' => 'Unidad12',
            'Defecto12' => 'Defecto12',
            'Subdefecto12' => 'Subdefecto12',
            'Gravedad12' => 'Gravedad12',
            'Capitulo13' => 'Capitulo13',
            'Unidad13' => 'Unidad13',
            'Defecto13' => 'Defecto13',
            'Subdefecto13' => 'Subdefecto13',
            'Gravedad13' => 'Gravedad13',
            'Capitulo14' => 'Capitulo14',
            'Unidad14' => 'Unidad14',
            'Defecto14' => 'Defecto14',
            'Subdefecto14' => 'Subdefecto14',
            'Gravedad14' => 'Gravedad14',
            'Capitulo15' => 'Capitulo15',
            'Unidad15' => 'Unidad15',
            'Defecto15' => 'Defecto15',
            'Subdefecto15' => 'Subdefecto15',
            'Gravedad15' => 'Gravedad15',
            'Capitulo16' => 'Capitulo16',
            'Unidad16' => 'Unidad16',
            'Defecto16' => 'Defecto16',
            'Subdefecto16' => 'Subdefecto16',
            'Gravedad16' => 'Gravedad16',
            'Capitulo17' => 'Capitulo17',
            'Unidad17' => 'Unidad17',
            'Defecto17' => 'Defecto17',
            'Subdefecto17' => 'Subdefecto17',
            'Gravedad17' => 'Gravedad17',
            'Capitulo18' => 'Capitulo18',
            'Unidad18' => 'Unidad18',
            'Defecto18' => 'Defecto18',
            'Subdefecto18' => 'Subdefecto18',
            'Gravedad18' => 'Gravedad18',
            'Capitulo19' => 'Capitulo19',
            'Unidad19' => 'Unidad19',
            'Defecto19' => 'Defecto19',
            'Subdefecto19' => 'Subdefecto19',
            'Gravedad19' => 'Gravedad19',
            'Capitulo20' => 'Capitulo20',
            'Unidad20' => 'Unidad20',
            'Defecto20' => 'Defecto20',
            'Subdefecto20' => 'Subdefecto20',
            'Gravedad20' => 'Gravedad20',
            'Capitulo21' => 'Capitulo21',
            'Unidad21' => 'Unidad21',
            'Defecto21' => 'Defecto21',
            'Subdefecto21' => 'Subdefecto21',
            'Gravedad21' => 'Gravedad21',
            'Capitulo22' => 'Capitulo22',
            'Unidad22' => 'Unidad22',
            'Defecto22' => 'Defecto22',
            'Subdefecto22' => 'Subdefecto22',
            'Gravedad22' => 'Gravedad22',
            'Capitulo23' => 'Capitulo23',
            'Unidad23' => 'Unidad23',
            'Defecto23' => 'Defecto23',
            'Subdefecto23' => 'Subdefecto23',
            'Gravedad23' => 'Gravedad23',
            'Capitulo24' => 'Capitulo24',
            'Unidad24' => 'Unidad24',
            'Defecto24' => 'Defecto24',
            'Subdefecto24' => 'Subdefecto24',
            'Gravedad24' => 'Gravedad24',
            'Capitulo25' => 'Capitulo25',
            'Unidad25' => 'Unidad25',
            'Defecto25' => 'Defecto25',
            'Subdefecto25' => 'Subdefecto25',
            'Gravedad25' => 'Gravedad25',
            'Capitulo26' => 'Capitulo26',
            'Unidad26' => 'Unidad26',
            'Defecto26' => 'Defecto26',
            'Subdefecto26' => 'Subdefecto26',
            'Gravedad26' => 'Gravedad26',
            'FrenoServicioFIE1' => 'Freno Servicio Fie1',
            'FrenoServicioFDE1' => 'Freno Servicio Fde1',
            'FrenoServicioFIE2' => 'Freno Servicio Fie2',
            'FrenoServicioFDE2' => 'Freno Servicio Fde2',
            'FrenoServicioFIE3' => 'Freno Servicio Fie3',
            'FrenoServicioFDE3' => 'Freno Servicio Fde3',
            'FrenoServicioFIE4' => 'Freno Servicio Fie4',
            'FrenoServicioFDE4' => 'Freno Servicio Fde4',
            'FrenoSocorroFIE1' => 'Freno Socorro Fie1',
            'FrenoSocorroFDE1' => 'Freno Socorro Fde1',
            'FrenoSocorroFIE2' => 'Freno Socorro Fie2',
            'FrenoSocorroFDE2' => 'Freno Socorro Fde2',
            'FrenoSocorroFIE3' => 'Freno Socorro Fie3',
            'FrenoSocorroFDE3' => 'Freno Socorro Fde3',
            'FrenoSocorroFIE4' => 'Freno Socorro Fie4',
            'FrenoSocorroFDE4' => 'Freno Socorro Fde4',
            'FrenoEstacionamientoFIE1' => 'Freno Estacionamiento Fie1',
            'FrenoEstacionamientoFDE1' => 'Freno Estacionamiento Fde1',
            'FrenoEstacionamientoFIE2' => 'Freno Estacionamiento Fie2',
            'FrenoEstacionamientoFDE2' => 'Freno Estacionamiento Fde2',
            'FrenoEstacionamientoFIE3' => 'Freno Estacionamiento Fie3',
            'FrenoEstacionamientoFDE3' => 'Freno Estacionamiento Fde3',
            'FrenoEstacionamientoFIE4' => 'Freno Estacionamiento Fie4',
            'FrenoEstacionamientoFDE4' => 'Freno Estacionamiento Fde4',
            'EficaciaServicio' => 'Eficacia Servicio',
            'EficaciaEstacionamiento' => 'Eficacia Estacionamiento',
            'EficaciaSocorro' => 'Eficacia Socorro',
            'EmisionesOpacidad' => 'Emisiones Opacidad',
            'EmisionesCORalenti' => 'Emisiones Co Ralenti',
            'EmisionesCOAcelerado' => 'Emisiones Co Acelerado',
            'EmisionesLambda' => 'Emisiones Lambda',
            'SingoAlinenacionE1' => 'Singo Alinenacion E1',
            'AlinenacionE1' => 'Alinenacion E1',
            'SingoAlinenacionE2' => 'Singo Alinenacion E2',
            'AlinenacionE2' => 'Alinenacion E2',
            'Decelerometro' => 'Decelerometro',
            'VelocidadLimitador' => 'Velocidad Limitador',
            'Tara' => 'Tara',
            'MMA' => 'Mma',
            'MMARemolque' => 'Mma Remolque',
            'EmailPropietario' => 'Email Propietario',
            'Categoria' => 'Categoria',
            'Kilometros' => 'Kilometros',
            'Euro' => 'Euro',
            'Trazabilidad' => 'Trazabilidad',
            'NumeroSerieFrenometro' => 'Numero Serie Frenometro',
            'NumeroSerieEquipoHumos' => 'Numero Serie Equipo Humos',
            'NumeroSerieAlineadora' => 'Numero Serie Alineadora',
            'NumeroSerieVelocimetro' => 'Numero Serie Velocimetro',
            'NumeroSerieDecelerometro' => 'Numero Serie Decelerometro',
            'NumeroSerieTacometro' => 'Numero Serie Tacometro',
            'NumeroSerieSonometro' => 'Numero Serie Sonometro',
            'NumeroSerieDinamometro' => 'Numero Serie Dinamometro',
            'NumeroSerieBascula' => 'Numero Serie Bascula',
            'Seccion' => 'Seccion',
            'd_diaInspeccion' => 'D Dia Inspeccion',
            'HoraFactura' => 'Hora Factura',
            'HoraInicio' => 'Hora Inicio',
            'HoraImpresionInforme' => 'Hora Impresion Informe',
            'Hora1' => 'Hora1',
            'Hora2' => 'Hora2',
            'Hora3' => 'Hora3',
            'Hora4' => 'Hora4',
            'Hora5' => 'Hora5',
            'Hora6' => 'Hora6',
            'Hora7' => 'Hora7',
            'Hora8' => 'Hora8',
            'Hora9' => 'Hora9',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefectos()
    {
        return $this->hasMany(Defectos::className(), ['Estacion' => 'Estacion', 'Anyo' => 'Anyo', 'InformeMecanica' => 'InformeMecanica']);
    }

	public function getPoblacion ()
	{
		return $this->hasOne(Poblacion::className(), ['codigoPostal' => 'codigoPostal']);
	}

	public function getMunicipio ()
	{
		return $this->hasOne(Municipios::className(), ['codigoMunicipio' => 'codigoMunicipio'])->viaTable('d_codigosPostales', ['codigoPostal' => 'CodigoPostal']);
	}
}
