<?php

namespace backend\modules\crmItevebasa\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\crmItevebasa\models\Inspecciones;

/**
 * InspeccionesSearch represents the model behind the search form of `backend\modules\crmItevebasa\models\Inspecciones`.
 */
class InspeccionesSearch extends Inspecciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Estacion', 'FechaInspeccion', 'Matricula', 'Bastidor', 'FechaMatriculacion', 'Marca', 'TipoVehiculo', 'CodigoConstruccion', 'CodigoUtilizacion', 'ContrasenyaHomologacion', 'FechaProximaInspeccion', 'FechaUltimaDesfavorable', 'FechaPrimeraMatriculacion', 'CodigoPropietario', 'Reforma1', 'Reforma2', 'Reforma3', 'Reforma4', 'Reforma5', 'DNI', 'Nombre', 'Domicilio', 'Municipio', 'CodigoPostal', 'Telefono1', 'Telefono2', 'TipoMatricula', 'TipoInspeccion', 'FaseInspeccion', 'AntiguedadVehiculo', 'Tarifa', 'ConceptoSigno1', 'ConceptoSigno2', 'ConceptoSigno3', 'ConceptoSigno4', 'ConceptoSigno5', 'ConceptoSigno6', 'TipoCombustible', 'NumeroFactura', 'FechaPagoTasas', 'Capitulo1', 'Unidad1', 'Defecto1', 'Subdefecto1', 'Gravedad1', 'Capitulo2', 'Unidad2', 'Defecto2', 'Subdefecto2', 'Gravedad2', 'Capitulo3', 'Unidad3', 'Defecto3', 'Subdefecto3', 'Gravedad3', 'Capitulo4', 'Unidad4', 'Defecto4', 'Subdefecto4', 'Gravedad4', 'Capitulo5', 'Unidad5', 'Defecto5', 'Subdefecto5', 'Gravedad5', 'Capitulo6', 'Unidad6', 'Defecto6', 'Subdefecto6', 'Gravedad6', 'Capitulo7', 'Unidad7', 'Defecto7', 'Subdefecto7', 'Gravedad7', 'Capitulo8', 'Unidad8', 'Defecto8', 'Subdefecto8', 'Gravedad8', 'Capitulo9', 'Unidad9', 'Defecto9', 'Subdefecto9', 'Gravedad9', 'Capitulo10', 'Unidad10', 'Defecto10', 'Subdefecto10', 'Gravedad10', 'Capitulo11', 'Unidad11', 'Defecto11', 'Subdefecto11', 'Gravedad11', 'Capitulo12', 'Unidad12', 'Defecto12', 'Subdefecto12', 'Gravedad12', 'Capitulo13', 'Unidad13', 'Defecto13', 'Subdefecto13', 'Gravedad13', 'Capitulo14', 'Unidad14', 'Defecto14', 'Subdefecto14', 'Gravedad14', 'Capitulo15', 'Unidad15', 'Defecto15', 'Subdefecto15', 'Gravedad15', 'Capitulo16', 'Unidad16', 'Defecto16', 'Subdefecto16', 'Gravedad16', 'Capitulo17', 'Unidad17', 'Defecto17', 'Subdefecto17', 'Gravedad17', 'Capitulo18', 'Unidad18', 'Defecto18', 'Subdefecto18', 'Gravedad18', 'Capitulo19', 'Unidad19', 'Defecto19', 'Subdefecto19', 'Gravedad19', 'Capitulo20', 'Unidad20', 'Defecto20', 'Subdefecto20', 'Gravedad20', 'Capitulo21', 'Unidad21', 'Defecto21', 'Subdefecto21', 'Gravedad21', 'Capitulo22', 'Unidad22', 'Defecto22', 'Subdefecto22', 'Gravedad22', 'Capitulo23', 'Unidad23', 'Defecto23', 'Subdefecto23', 'Gravedad23', 'Capitulo24', 'Unidad24', 'Defecto24', 'Subdefecto24', 'Gravedad24', 'Capitulo25', 'Unidad25', 'Defecto25', 'Subdefecto25', 'Gravedad25', 'Capitulo26', 'Unidad26', 'Defecto26', 'Subdefecto26', 'Gravedad26', 'SingoAlinenacionE1', 'SingoAlinenacionE2', 'EmailPropietario', 'Categoria', 'Euro', 'Trazabilidad', 'NumeroSerieFrenometro', 'NumeroSerieEquipoHumos', 'NumeroSerieAlineadora', 'NumeroSerieVelocimetro', 'NumeroSerieDecelerometro', 'NumeroSerieTacometro', 'NumeroSerieSonometro', 'NumeroSerieDinamometro', 'NumeroSerieBascula', 'Seccion', 'd_diaInspeccion', 'HoraFactura', 'HoraInicio', 'HoraImpresionInforme', 'Hora1', 'Hora2', 'Hora3', 'Hora4', 'Hora5', 'Hora6', 'Hora7', 'Hora8', 'Hora9'], 'safe'],
            [['Anyo', 'InformeMecanica', 'ResultadoInspeccion', 'Tara', 'MMA', 'MMARemolque', 'Kilometros'], 'integer'],
            [['ConceptoImporte1', 'ConceptoIVA1', 'ConceptoImporte2', 'ConceptoIVA2', 'ConceptoImporte3', 'ConceptoIVA3', 'ConceptoImporte4', 'ConceptoIVA4', 'ConceptoImporte5', 'ConceptoIVA5', 'ConceptoImporte6', 'ConceptoIVA6', 'FrenoServicioFIE1', 'FrenoServicioFDE1', 'FrenoServicioFIE2', 'FrenoServicioFDE2', 'FrenoServicioFIE3', 'FrenoServicioFDE3', 'FrenoServicioFIE4', 'FrenoServicioFDE4', 'FrenoSocorroFIE1', 'FrenoSocorroFDE1', 'FrenoSocorroFIE2', 'FrenoSocorroFDE2', 'FrenoSocorroFIE3', 'FrenoSocorroFDE3', 'FrenoSocorroFIE4', 'FrenoSocorroFDE4', 'FrenoEstacionamientoFIE1', 'FrenoEstacionamientoFDE1', 'FrenoEstacionamientoFIE2', 'FrenoEstacionamientoFDE2', 'FrenoEstacionamientoFIE3', 'FrenoEstacionamientoFDE3', 'FrenoEstacionamientoFIE4', 'FrenoEstacionamientoFDE4', 'EficaciaServicio', 'EficaciaEstacionamiento', 'EficaciaSocorro', 'EmisionesOpacidad', 'EmisionesCORalenti', 'EmisionesCOAcelerado', 'EmisionesLambda', 'AlinenacionE1', 'AlinenacionE2', 'Decelerometro', 'VelocidadLimitador'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Inspecciones::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Anyo' => $this->Anyo,
            'InformeMecanica' => $this->InformeMecanica,
            'ConceptoImporte1' => $this->ConceptoImporte1,
            'ConceptoIVA1' => $this->ConceptoIVA1,
            'ConceptoImporte2' => $this->ConceptoImporte2,
            'ConceptoIVA2' => $this->ConceptoIVA2,
            'ConceptoImporte3' => $this->ConceptoImporte3,
            'ConceptoIVA3' => $this->ConceptoIVA3,
            'ConceptoImporte4' => $this->ConceptoImporte4,
            'ConceptoIVA4' => $this->ConceptoIVA4,
            'ConceptoImporte5' => $this->ConceptoImporte5,
            'ConceptoIVA5' => $this->ConceptoIVA5,
            'ConceptoImporte6' => $this->ConceptoImporte6,
            'ConceptoIVA6' => $this->ConceptoIVA6,
            'ResultadoInspeccion' => $this->ResultadoInspeccion,
            'FrenoServicioFIE1' => $this->FrenoServicioFIE1,
            'FrenoServicioFDE1' => $this->FrenoServicioFDE1,
            'FrenoServicioFIE2' => $this->FrenoServicioFIE2,
            'FrenoServicioFDE2' => $this->FrenoServicioFDE2,
            'FrenoServicioFIE3' => $this->FrenoServicioFIE3,
            'FrenoServicioFDE3' => $this->FrenoServicioFDE3,
            'FrenoServicioFIE4' => $this->FrenoServicioFIE4,
            'FrenoServicioFDE4' => $this->FrenoServicioFDE4,
            'FrenoSocorroFIE1' => $this->FrenoSocorroFIE1,
            'FrenoSocorroFDE1' => $this->FrenoSocorroFDE1,
            'FrenoSocorroFIE2' => $this->FrenoSocorroFIE2,
            'FrenoSocorroFDE2' => $this->FrenoSocorroFDE2,
            'FrenoSocorroFIE3' => $this->FrenoSocorroFIE3,
            'FrenoSocorroFDE3' => $this->FrenoSocorroFDE3,
            'FrenoSocorroFIE4' => $this->FrenoSocorroFIE4,
            'FrenoSocorroFDE4' => $this->FrenoSocorroFDE4,
            'FrenoEstacionamientoFIE1' => $this->FrenoEstacionamientoFIE1,
            'FrenoEstacionamientoFDE1' => $this->FrenoEstacionamientoFDE1,
            'FrenoEstacionamientoFIE2' => $this->FrenoEstacionamientoFIE2,
            'FrenoEstacionamientoFDE2' => $this->FrenoEstacionamientoFDE2,
            'FrenoEstacionamientoFIE3' => $this->FrenoEstacionamientoFIE3,
            'FrenoEstacionamientoFDE3' => $this->FrenoEstacionamientoFDE3,
            'FrenoEstacionamientoFIE4' => $this->FrenoEstacionamientoFIE4,
            'FrenoEstacionamientoFDE4' => $this->FrenoEstacionamientoFDE4,
            'EficaciaServicio' => $this->EficaciaServicio,
            'EficaciaEstacionamiento' => $this->EficaciaEstacionamiento,
            'EficaciaSocorro' => $this->EficaciaSocorro,
            'EmisionesOpacidad' => $this->EmisionesOpacidad,
            'EmisionesCORalenti' => $this->EmisionesCORalenti,
            'EmisionesCOAcelerado' => $this->EmisionesCOAcelerado,
            'EmisionesLambda' => $this->EmisionesLambda,
            'AlinenacionE1' => $this->AlinenacionE1,
            'AlinenacionE2' => $this->AlinenacionE2,
            'Decelerometro' => $this->Decelerometro,
            'VelocidadLimitador' => $this->VelocidadLimitador,
            'Tara' => $this->Tara,
            'MMA' => $this->MMA,
            'MMARemolque' => $this->MMARemolque,
            'Kilometros' => $this->Kilometros,
        ]);

        $query->andFilterWhere(['like', 'Estacion', $this->Estacion])
            ->andFilterWhere(['like', 'FechaInspeccion', $this->FechaInspeccion])
            ->andFilterWhere(['like', 'Matricula', $this->Matricula])
            ->andFilterWhere(['like', 'Bastidor', $this->Bastidor])
            ->andFilterWhere(['like', 'FechaMatriculacion', $this->FechaMatriculacion])
            ->andFilterWhere(['like', 'Marca', $this->Marca])
            ->andFilterWhere(['like', 'TipoVehiculo', $this->TipoVehiculo])
            ->andFilterWhere(['like', 'CodigoConstruccion', $this->CodigoConstruccion])
            ->andFilterWhere(['like', 'CodigoUtilizacion', $this->CodigoUtilizacion])
            ->andFilterWhere(['like', 'ContrasenyaHomologacion', $this->ContrasenyaHomologacion])
            ->andFilterWhere(['like', 'FechaProximaInspeccion', $this->FechaProximaInspeccion])
            ->andFilterWhere(['like', 'FechaUltimaDesfavorable', $this->FechaUltimaDesfavorable])
            ->andFilterWhere(['like', 'FechaPrimeraMatriculacion', $this->FechaPrimeraMatriculacion])
            ->andFilterWhere(['like', 'CodigoPropietario', $this->CodigoPropietario])
            ->andFilterWhere(['like', 'Reforma1', $this->Reforma1])
            ->andFilterWhere(['like', 'Reforma2', $this->Reforma2])
            ->andFilterWhere(['like', 'Reforma3', $this->Reforma3])
            ->andFilterWhere(['like', 'Reforma4', $this->Reforma4])
            ->andFilterWhere(['like', 'Reforma5', $this->Reforma5])
            ->andFilterWhere(['like', 'DNI', $this->DNI])
            ->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Domicilio', $this->Domicilio])
            ->andFilterWhere(['like', 'Municipio', $this->Municipio])
            ->andFilterWhere(['like', 'CodigoPostal', $this->CodigoPostal])
            ->andFilterWhere(['like', 'Telefono1', $this->Telefono1])
            ->andFilterWhere(['like', 'Telefono2', $this->Telefono2])
            ->andFilterWhere(['like', 'TipoMatricula', $this->TipoMatricula])
            ->andFilterWhere(['like', 'TipoInspeccion', $this->TipoInspeccion])
            ->andFilterWhere(['like', 'FaseInspeccion', $this->FaseInspeccion])
            ->andFilterWhere(['like', 'AntiguedadVehiculo', $this->AntiguedadVehiculo])
            ->andFilterWhere(['like', 'Tarifa', $this->Tarifa])
            ->andFilterWhere(['like', 'ConceptoSigno1', $this->ConceptoSigno1])
            ->andFilterWhere(['like', 'ConceptoSigno2', $this->ConceptoSigno2])
            ->andFilterWhere(['like', 'ConceptoSigno3', $this->ConceptoSigno3])
            ->andFilterWhere(['like', 'ConceptoSigno4', $this->ConceptoSigno4])
            ->andFilterWhere(['like', 'ConceptoSigno5', $this->ConceptoSigno5])
            ->andFilterWhere(['like', 'ConceptoSigno6', $this->ConceptoSigno6])
            ->andFilterWhere(['like', 'TipoCombustible', $this->TipoCombustible])
            ->andFilterWhere(['like', 'NumeroFactura', $this->NumeroFactura])
            ->andFilterWhere(['like', 'FechaPagoTasas', $this->FechaPagoTasas])
            ->andFilterWhere(['like', 'Capitulo1', $this->Capitulo1])
            ->andFilterWhere(['like', 'Unidad1', $this->Unidad1])
            ->andFilterWhere(['like', 'Defecto1', $this->Defecto1])
            ->andFilterWhere(['like', 'Subdefecto1', $this->Subdefecto1])
            ->andFilterWhere(['like', 'Gravedad1', $this->Gravedad1])
            ->andFilterWhere(['like', 'Capitulo2', $this->Capitulo2])
            ->andFilterWhere(['like', 'Unidad2', $this->Unidad2])
            ->andFilterWhere(['like', 'Defecto2', $this->Defecto2])
            ->andFilterWhere(['like', 'Subdefecto2', $this->Subdefecto2])
            ->andFilterWhere(['like', 'Gravedad2', $this->Gravedad2])
            ->andFilterWhere(['like', 'Capitulo3', $this->Capitulo3])
            ->andFilterWhere(['like', 'Unidad3', $this->Unidad3])
            ->andFilterWhere(['like', 'Defecto3', $this->Defecto3])
            ->andFilterWhere(['like', 'Subdefecto3', $this->Subdefecto3])
            ->andFilterWhere(['like', 'Gravedad3', $this->Gravedad3])
            ->andFilterWhere(['like', 'Capitulo4', $this->Capitulo4])
            ->andFilterWhere(['like', 'Unidad4', $this->Unidad4])
            ->andFilterWhere(['like', 'Defecto4', $this->Defecto4])
            ->andFilterWhere(['like', 'Subdefecto4', $this->Subdefecto4])
            ->andFilterWhere(['like', 'Gravedad4', $this->Gravedad4])
            ->andFilterWhere(['like', 'Capitulo5', $this->Capitulo5])
            ->andFilterWhere(['like', 'Unidad5', $this->Unidad5])
            ->andFilterWhere(['like', 'Defecto5', $this->Defecto5])
            ->andFilterWhere(['like', 'Subdefecto5', $this->Subdefecto5])
            ->andFilterWhere(['like', 'Gravedad5', $this->Gravedad5])
            ->andFilterWhere(['like', 'Capitulo6', $this->Capitulo6])
            ->andFilterWhere(['like', 'Unidad6', $this->Unidad6])
            ->andFilterWhere(['like', 'Defecto6', $this->Defecto6])
            ->andFilterWhere(['like', 'Subdefecto6', $this->Subdefecto6])
            ->andFilterWhere(['like', 'Gravedad6', $this->Gravedad6])
            ->andFilterWhere(['like', 'Capitulo7', $this->Capitulo7])
            ->andFilterWhere(['like', 'Unidad7', $this->Unidad7])
            ->andFilterWhere(['like', 'Defecto7', $this->Defecto7])
            ->andFilterWhere(['like', 'Subdefecto7', $this->Subdefecto7])
            ->andFilterWhere(['like', 'Gravedad7', $this->Gravedad7])
            ->andFilterWhere(['like', 'Capitulo8', $this->Capitulo8])
            ->andFilterWhere(['like', 'Unidad8', $this->Unidad8])
            ->andFilterWhere(['like', 'Defecto8', $this->Defecto8])
            ->andFilterWhere(['like', 'Subdefecto8', $this->Subdefecto8])
            ->andFilterWhere(['like', 'Gravedad8', $this->Gravedad8])
            ->andFilterWhere(['like', 'Capitulo9', $this->Capitulo9])
            ->andFilterWhere(['like', 'Unidad9', $this->Unidad9])
            ->andFilterWhere(['like', 'Defecto9', $this->Defecto9])
            ->andFilterWhere(['like', 'Subdefecto9', $this->Subdefecto9])
            ->andFilterWhere(['like', 'Gravedad9', $this->Gravedad9])
            ->andFilterWhere(['like', 'Capitulo10', $this->Capitulo10])
            ->andFilterWhere(['like', 'Unidad10', $this->Unidad10])
            ->andFilterWhere(['like', 'Defecto10', $this->Defecto10])
            ->andFilterWhere(['like', 'Subdefecto10', $this->Subdefecto10])
            ->andFilterWhere(['like', 'Gravedad10', $this->Gravedad10])
            ->andFilterWhere(['like', 'Capitulo11', $this->Capitulo11])
            ->andFilterWhere(['like', 'Unidad11', $this->Unidad11])
            ->andFilterWhere(['like', 'Defecto11', $this->Defecto11])
            ->andFilterWhere(['like', 'Subdefecto11', $this->Subdefecto11])
            ->andFilterWhere(['like', 'Gravedad11', $this->Gravedad11])
            ->andFilterWhere(['like', 'Capitulo12', $this->Capitulo12])
            ->andFilterWhere(['like', 'Unidad12', $this->Unidad12])
            ->andFilterWhere(['like', 'Defecto12', $this->Defecto12])
            ->andFilterWhere(['like', 'Subdefecto12', $this->Subdefecto12])
            ->andFilterWhere(['like', 'Gravedad12', $this->Gravedad12])
            ->andFilterWhere(['like', 'Capitulo13', $this->Capitulo13])
            ->andFilterWhere(['like', 'Unidad13', $this->Unidad13])
            ->andFilterWhere(['like', 'Defecto13', $this->Defecto13])
            ->andFilterWhere(['like', 'Subdefecto13', $this->Subdefecto13])
            ->andFilterWhere(['like', 'Gravedad13', $this->Gravedad13])
            ->andFilterWhere(['like', 'Capitulo14', $this->Capitulo14])
            ->andFilterWhere(['like', 'Unidad14', $this->Unidad14])
            ->andFilterWhere(['like', 'Defecto14', $this->Defecto14])
            ->andFilterWhere(['like', 'Subdefecto14', $this->Subdefecto14])
            ->andFilterWhere(['like', 'Gravedad14', $this->Gravedad14])
            ->andFilterWhere(['like', 'Capitulo15', $this->Capitulo15])
            ->andFilterWhere(['like', 'Unidad15', $this->Unidad15])
            ->andFilterWhere(['like', 'Defecto15', $this->Defecto15])
            ->andFilterWhere(['like', 'Subdefecto15', $this->Subdefecto15])
            ->andFilterWhere(['like', 'Gravedad15', $this->Gravedad15])
            ->andFilterWhere(['like', 'Capitulo16', $this->Capitulo16])
            ->andFilterWhere(['like', 'Unidad16', $this->Unidad16])
            ->andFilterWhere(['like', 'Defecto16', $this->Defecto16])
            ->andFilterWhere(['like', 'Subdefecto16', $this->Subdefecto16])
            ->andFilterWhere(['like', 'Gravedad16', $this->Gravedad16])
            ->andFilterWhere(['like', 'Capitulo17', $this->Capitulo17])
            ->andFilterWhere(['like', 'Unidad17', $this->Unidad17])
            ->andFilterWhere(['like', 'Defecto17', $this->Defecto17])
            ->andFilterWhere(['like', 'Subdefecto17', $this->Subdefecto17])
            ->andFilterWhere(['like', 'Gravedad17', $this->Gravedad17])
            ->andFilterWhere(['like', 'Capitulo18', $this->Capitulo18])
            ->andFilterWhere(['like', 'Unidad18', $this->Unidad18])
            ->andFilterWhere(['like', 'Defecto18', $this->Defecto18])
            ->andFilterWhere(['like', 'Subdefecto18', $this->Subdefecto18])
            ->andFilterWhere(['like', 'Gravedad18', $this->Gravedad18])
            ->andFilterWhere(['like', 'Capitulo19', $this->Capitulo19])
            ->andFilterWhere(['like', 'Unidad19', $this->Unidad19])
            ->andFilterWhere(['like', 'Defecto19', $this->Defecto19])
            ->andFilterWhere(['like', 'Subdefecto19', $this->Subdefecto19])
            ->andFilterWhere(['like', 'Gravedad19', $this->Gravedad19])
            ->andFilterWhere(['like', 'Capitulo20', $this->Capitulo20])
            ->andFilterWhere(['like', 'Unidad20', $this->Unidad20])
            ->andFilterWhere(['like', 'Defecto20', $this->Defecto20])
            ->andFilterWhere(['like', 'Subdefecto20', $this->Subdefecto20])
            ->andFilterWhere(['like', 'Gravedad20', $this->Gravedad20])
            ->andFilterWhere(['like', 'Capitulo21', $this->Capitulo21])
            ->andFilterWhere(['like', 'Unidad21', $this->Unidad21])
            ->andFilterWhere(['like', 'Defecto21', $this->Defecto21])
            ->andFilterWhere(['like', 'Subdefecto21', $this->Subdefecto21])
            ->andFilterWhere(['like', 'Gravedad21', $this->Gravedad21])
            ->andFilterWhere(['like', 'Capitulo22', $this->Capitulo22])
            ->andFilterWhere(['like', 'Unidad22', $this->Unidad22])
            ->andFilterWhere(['like', 'Defecto22', $this->Defecto22])
            ->andFilterWhere(['like', 'Subdefecto22', $this->Subdefecto22])
            ->andFilterWhere(['like', 'Gravedad22', $this->Gravedad22])
            ->andFilterWhere(['like', 'Capitulo23', $this->Capitulo23])
            ->andFilterWhere(['like', 'Unidad23', $this->Unidad23])
            ->andFilterWhere(['like', 'Defecto23', $this->Defecto23])
            ->andFilterWhere(['like', 'Subdefecto23', $this->Subdefecto23])
            ->andFilterWhere(['like', 'Gravedad23', $this->Gravedad23])
            ->andFilterWhere(['like', 'Capitulo24', $this->Capitulo24])
            ->andFilterWhere(['like', 'Unidad24', $this->Unidad24])
            ->andFilterWhere(['like', 'Defecto24', $this->Defecto24])
            ->andFilterWhere(['like', 'Subdefecto24', $this->Subdefecto24])
            ->andFilterWhere(['like', 'Gravedad24', $this->Gravedad24])
            ->andFilterWhere(['like', 'Capitulo25', $this->Capitulo25])
            ->andFilterWhere(['like', 'Unidad25', $this->Unidad25])
            ->andFilterWhere(['like', 'Defecto25', $this->Defecto25])
            ->andFilterWhere(['like', 'Subdefecto25', $this->Subdefecto25])
            ->andFilterWhere(['like', 'Gravedad25', $this->Gravedad25])
            ->andFilterWhere(['like', 'Capitulo26', $this->Capitulo26])
            ->andFilterWhere(['like', 'Unidad26', $this->Unidad26])
            ->andFilterWhere(['like', 'Defecto26', $this->Defecto26])
            ->andFilterWhere(['like', 'Subdefecto26', $this->Subdefecto26])
            ->andFilterWhere(['like', 'Gravedad26', $this->Gravedad26])
            ->andFilterWhere(['like', 'SingoAlinenacionE1', $this->SingoAlinenacionE1])
            ->andFilterWhere(['like', 'SingoAlinenacionE2', $this->SingoAlinenacionE2])
            ->andFilterWhere(['like', 'EmailPropietario', $this->EmailPropietario])
            ->andFilterWhere(['like', 'Categoria', $this->Categoria])
            ->andFilterWhere(['like', 'Euro', $this->Euro])
            ->andFilterWhere(['like', 'Trazabilidad', $this->Trazabilidad])
            ->andFilterWhere(['like', 'NumeroSerieFrenometro', $this->NumeroSerieFrenometro])
            ->andFilterWhere(['like', 'NumeroSerieEquipoHumos', $this->NumeroSerieEquipoHumos])
            ->andFilterWhere(['like', 'NumeroSerieAlineadora', $this->NumeroSerieAlineadora])
            ->andFilterWhere(['like', 'NumeroSerieVelocimetro', $this->NumeroSerieVelocimetro])
            ->andFilterWhere(['like', 'NumeroSerieDecelerometro', $this->NumeroSerieDecelerometro])
            ->andFilterWhere(['like', 'NumeroSerieTacometro', $this->NumeroSerieTacometro])
            ->andFilterWhere(['like', 'NumeroSerieSonometro', $this->NumeroSerieSonometro])
            ->andFilterWhere(['like', 'NumeroSerieDinamometro', $this->NumeroSerieDinamometro])
            ->andFilterWhere(['like', 'NumeroSerieBascula', $this->NumeroSerieBascula])
            ->andFilterWhere(['like', 'Seccion', $this->Seccion])
            ->andFilterWhere(['like', 'd_diaInspeccion', $this->d_diaInspeccion])
            ->andFilterWhere(['like', 'HoraFactura', $this->HoraFactura])
            ->andFilterWhere(['like', 'HoraInicio', $this->HoraInicio])
            ->andFilterWhere(['like', 'HoraImpresionInforme', $this->HoraImpresionInforme])
            ->andFilterWhere(['like', 'Hora1', $this->Hora1])
            ->andFilterWhere(['like', 'Hora2', $this->Hora2])
            ->andFilterWhere(['like', 'Hora3', $this->Hora3])
            ->andFilterWhere(['like', 'Hora4', $this->Hora4])
            ->andFilterWhere(['like', 'Hora5', $this->Hora5])
            ->andFilterWhere(['like', 'Hora6', $this->Hora6])
            ->andFilterWhere(['like', 'Hora7', $this->Hora7])
            ->andFilterWhere(['like', 'Hora8', $this->Hora8])
            ->andFilterWhere(['like', 'Hora9', $this->Hora9]);

        return $dataProvider;
    }
}
