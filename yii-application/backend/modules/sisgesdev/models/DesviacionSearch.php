<?php

namespace backend\modules\sisgesdev\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sisgesdev\models\Desviacion;

/**
 * DesviacionSearch represents the model behind the search form of `backend\modules\sisgesdev\models\Desviacion`.
 */
class DesviacionSearch extends Desviacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'departamento', 'tipoDesviacion', 'origen', 'responsable', 'validadoPor'], 'integer'],
            [['numero', 'fecha', 'descripcion', 'fechaCierre', 'fechaValidacion', 'fechaLimite'], 'safe'],
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
        $query = Desviacion::find();
		
		
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
            'id' => $this->id,
            'fecha' => $this->fecha,
            'departamento' => $this->departamento,
            'tipoDesviacion' => $this->tipoDesviacion,
            'origen' => $this->origen,
            'responsable' => $this->responsable,
            'fechaCierre' => $this->fechaCierre,
            'validadoPor' => $this->validadoPor,
            'fechaValidacion' => $this->fechaValidacion,
            'fechaLimite' => $this->fechaLimite,
        ]);

        $query->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
