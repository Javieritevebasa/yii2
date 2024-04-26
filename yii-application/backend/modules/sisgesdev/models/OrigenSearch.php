<?php

namespace backend\modules\sisgesdev\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sisgesdev\models\Origen;

/**
 * OrigenSearch represents the model behind the search form of `backend\modules\sisgesdev\models\Origen`.
 */
class OrigenSearch extends Origen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tipoOrigen', 'creadoPor', 'validadoPor'], 'integer'],
            [['numeroExpediente', 'fecha', 'fechaLimite', 'descripcion', 'fechaValidacion'], 'safe'],
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
        $query = Origen::find();

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
            'tipoOrigen' => $this->tipoOrigen,
            'fecha' => $this->fecha,
            'fechaLimite' => $this->fechaLimite,
            'creadoPor' => $this->creadoPor,
            'validadoPor' => $this->validadoPor,
            'fechaValidacion' => $this->fechaValidacion,
        ]);

        $query->andFilterWhere(['like', 'numeroExpediente', $this->numeroExpediente])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
