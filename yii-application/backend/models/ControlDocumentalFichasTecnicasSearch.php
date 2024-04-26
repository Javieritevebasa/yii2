<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ControlDocumentalFichasTecnicas;

/**
 * ControlDocumentalFichasTecnicasSearch represents the model behind the search form of `backend\models\ControlDocumentalFichasTecnicas`.
 */
class ControlDocumentalFichasTecnicasSearch extends ControlDocumentalFichasTecnicas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FICHATECNICA_MATRICULA', 'FICHATECNICA_NUMEROCERTIFICADO', 'FICHATECNICA_VIN', 'ESTADO_NOMBRE', 'INGENIERO_NOMBRE', 'FICHATECNICA_FECHAEMISION', 'FICHATECNICA_INICIO', 'ESTACIONITV_CODIGO','SERVICIO_NOMBRE', 'FICHATECNICA_MARCA'], 'safe'],
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
        $query = ControlDocumentalFichasTecnicas::find();

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
            'FICHATECNICA_FECHAEMISION' => $this->FICHATECNICA_FECHAEMISION,
        ]);
		/* $query->andFilterWhere([
            'FICHATECNICA_INICIO' => $this->FICHATECNICA_FECHAEMISION,
        ]);*/

        $query->andFilterWhere(['like', 'FICHATECNICA_MATRICULA', $this->FICHATECNICA_MATRICULA])
            ->andFilterWhere(['like', 'FICHATECNICA_NUMEROCERTIFICADO', $this->FICHATECNICA_NUMEROCERTIFICADO])
            ->andFilterWhere(['like', 'FICHATECNICA_VIN', $this->FICHATECNICA_VIN])
            ->andFilterWhere(['like', 'ESTADO_NOMBRE', $this->ESTADO_NOMBRE])
			->andFilterWhere(['like', 'ESTACIONITV_CODIGO', $this->ESTACIONITV_CODIGO])
            ->andFilterWhere(['like', 'INGENIERO_NOMBRE', $this->INGENIERO_NOMBRE])
            ->andFilterWhere(['like', 'SERVICIO_NOMBRE', $this->SERVICIO_NOMBRE])
            ->andFilterWhere(['like', 'FICHATECNICA_MARCA', $this->FICHATECNICA_MARCA]);

        return $dataProvider;
    }
}
