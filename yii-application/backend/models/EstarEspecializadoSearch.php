<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EstarEspecializado;

/**
 * EstarEspecializadoSearch represents the model behind the search form of `common\models\EstarEspecializado`.
 */
class EstarEspecializadoSearch extends EstarEspecializado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'idEspecialidad', 'apto', 'cualificadoComo'], 'integer'],
            [['fechaCualificacion', 'fechaVencimiento', 'fechaPrimeraCualificacion'], 'safe'],
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
        $query = EstarEspecializado::find();

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
            'idUser' => $this->idUser,
            'idEspecialidad' => $this->idEspecialidad,
            'fechaCualificacion' => $this->fechaCualificacion,
            'fechaVencimiento' => $this->fechaVencimiento,
            'fechaPrimeraCualificacion' => $this->fechaPrimeraCualificacion,
            'apto' => $this->apto,
            'cualificadoComo' => $this->cualificadoComo,
        ]);

        return $dataProvider;
    }
}
