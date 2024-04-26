<?php

namespace backend\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use backend\models\SeguimientoRiesgosImparcialidad;

/**
 * SeguimientoRiesgosImparcialidadSearch represents the model behind the search form of `backend\models\SeguimientoRiesgosImparcialidad`.
 */
class SeguimientoRiesgosImparcialidadSearch extends SeguimientoRiesgosImparcialidad
{
	public $anyo;
	//public $propietarioNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'riesgoId','nivelRiesgoId','validado'], 'integer'],
            [['matricula', 'fecha', 'servicio', 'usuarioNombre', 'propietarioNombre','estacion', 'anyo'], 'safe'],
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
	
	public function attributeLabels()
    {
        return [
            'propietarioNombre' => 'Propietario',
        ];
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
    	$usuario = User::findIdentity(Yii::$app->user->identity->id);
    	
    	$estaciones = ArrayHelper::getColumn($usuario->codigoEstacions,'codigo');
		
		$query = SeguimientoRiesgosImparcialidad::find()->where(['in', 'estacion', $estaciones])
			->where('year(fecha) >= 2021 or (year(fecha) < 2021 and validado = true)')->orWhere(['estacion' => null]);

		$query = $query->joinWith('usuario u')->joinWith('nivelRiesgo n')->joinWith('propietario p');
		
        // add conditions that should always apply here


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
			
			print_r($this->getErrors());
            return $dataProvider;
        }

        $query->andFilterWhere(['nivelRiesgoId' =>  $this->nivelRiesgoId]);
		$query->andFilterWhere(['riesgoId' =>  $this->riesgoId]);
		$query->andFilterWhere(['validado' =>  $this->validado]);
		$query->andFilterWhere(['year(fecha)' =>  $this->anyo]);
		      
        $query->andFilterWhere(['like', 'seguimientoRiesgosImparcialidad.matricula', $this->matricula])
		 	  ->andFilterWhere(['like', 'concat(u.nombre," ", u.apellidos)', $this->usuarioNombre]);
		if ($this->propietarioNombre <> null)
			$query->andFilterWhere(['like', 'propietarioNombre', $this->propietarioNombre]);
		else	
			$query->andFilterWhere(['like', 'concat(p.nombre," ", p.apellidos)', $this->propietarioNombre]);
		$query->andFilterWhere(['like', 'n.descripcion', $this->nivelRiesgoDescripcion])
            ->andFilterWhere(['like', 'servicio', $this->servicio])
			->andFilterWhere(['like', 'estacion', $this->estacion]);
//echo 'SQL: '.$query->createCommand()->getRawSql();
//die($this->nivelRiesgoId);
        return $dataProvider;
    }
}
